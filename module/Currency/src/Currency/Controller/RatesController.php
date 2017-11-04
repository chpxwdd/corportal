<?php

namespace Currency\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel;
use Currency\Entity\Library;
use Currency\Entity\Rates;
use Currency\Form\Rates\Filter;

class RatesController extends AbstractActionController
{

    /**
     * 
     * @return \Zend\View\Model\ViewModel
     */
    public function indexAction()
    {

        $placeholder = $this->getServiceLocator()->get('viewhelpermanager')->get('placeholder');
        $placeholder->getContainer('title')->set('dashboard');
        $placeholder->getContainer('lead')->set('currency parsers');

        $viewmodel = new ViewModel();

        return $viewmodel;
    }

    /**
     * 
     * @return ViewModel
     */
    public function viewAction()
    {

        $placeholder = $this->getServiceLocator()->get('viewhelpermanager')->get('placeholder');
        $placeholder->getContainer('title')->set('currency');
        $placeholder->getContainer('lead')->set('from www.exhangerates.com');

        $om = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
        $viewmodel = new ViewModel();
        $viewmodel->setVariable("form", new Filter($om->getRepository("\Currency\Entity\Library")));

        return $viewmodel;
    }

    /**
     * 
     * @return ViewModel
     */
    public function parseAction()
    {
        include "simple_html_parser/simple_html_dom.php";

        $toAbbr = $this->params()->fromPost("tid");
        $fromAbbrs = explode("|", $this->params()->fromPost("fids"));
        $startDate = explode(".", $this->params()->fromPost("dos"));
        $endDate = explode(".", $this->params()->fromPost("doe"));

        $dos = $startDate[1] . "-" . $startDate[0] . "-" . $startDate[2];
        $doe = $endDate[1] . "-" . $endDate[0] . "-" . $endDate[2];

        $om = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
        $library = $om->getRepository("\Currency\Entity\Library");
        $ratesRepo = $om->getRepository("\Currency\Entity\Rates");

        $currencyTo = $library->findOneByAbbr($toAbbr);
        $tid = $currencyTo->getCode();

        $rates = array();
        $arrCurrencyFrom = array();
        foreach ($fromAbbrs as $fromAbbr)
        {
            $currencyFrom = $arrCurrencyFrom[] = $library->findOneByAbbr($fromAbbr);
            $fid = $currencyFrom->getCode();

            $url = "http://www.exchangerate.com/past_rates.html?currency=$tid&cid=$fid&date_from=$dos&date_to=$doe&action=Generate+Chart&continent=Europe";
            $html = file_get_html($url);
            $tables = $html->find("table.rates_table table tbody");
            $table = str_get_html($tables[0]);
            $rows = $table->find("tr");
            unset($rows[0]);

            foreach ($rows as $row)
            {
                $date = new \DateTime(substr($row->find("td font", 0)->innertext, 6));
                $rates[$date->format("d.m.Y")][$fromAbbr] = $row->find("td", 2)->plaintext;
            }
        }

        $viewmodel = new ViewModel();
        $viewmodel->setVariable("rates", $rates);
        $viewmodel->setVariable("currencyTo", $currencyTo);
        $viewmodel->setVariable("arrCurrencyFrom", $arrCurrencyFrom);
        $viewmodel->setVariable("ratesRepo", $ratesRepo);

        $viewmodel->setTerminal(TRUE);
        return $viewmodel;
    }

    /**
     * 
     * @return ViewModel
     */
    public function saveAction()
    {

        $grid = json_decode($this->params()->fromPost('grid'));
        if (null === $grid)
        {
            return null;
        }

        // Check in database each row 
        $om = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
        $repository = $om->getRepository("\Currency\Entity\Rates");

        $log = new \stdClass();
        foreach ($grid as $row)
        {
            $arr = explode('.', $row->date);
            $date = (string) $arr[2] . "/" . $arr[1] . "/" . $arr[0];
            $rate = new Rates();
            $findRate = $repository->findOneByDate($row->abbr, $date);

            if (count($findRate->getResult()) > 0)
            {
                $rate = $findRate->getSingleResult();
            }
            $rate->setAbbr($row->abbr);
            $rate->setDate($date);
            $iterateRates = $row->rates;
            foreach ($iterateRates as $item)
            {
                switch ($item->abbr)
                {
                    case 'USD':
                        $rate->setUsd($item->value);
                        break;
                    case 'EUR':
                        $rate->setEur($item->value);
                        break;
                    default:
                        break;
                }
            }
            print $rate->getId() . " save success\n";
            $om->persist($rate);
        }
        $om->flush();
        $om->clear();

        $viewmodel = new ViewModel();

        $viewmodel->setTerminal(TRUE);
        return $viewmodel;
    }

}
