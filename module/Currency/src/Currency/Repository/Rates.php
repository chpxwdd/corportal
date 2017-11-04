<?php

namespace Currency\Repository;

use Doctrine\ORM\EntityRepository;

class Rates extends EntityRepository
{

    public function findOneByDate($abbr, $date)
    {
	$datetime = new \DateTime($date);

	$qb = $this->_em
		->getRepository($this->getEntityName())
		->createQueryBuilder("sc");

	$andX = $qb->expr()->andX();
	$andX->add("sc.abbr = '" . $abbr . "'")
		->add("sc.date = '" . $datetime->format("Y-m-d") . "'");

	return $qb->select("sc")
			->where($andX)
			->getQuery();
    }

}
