<?php

namespace Currency\Repository;

use Doctrine\ORM\EntityRepository;

class Library extends EntityRepository
{

    /**
     * 
     * @param string $abbr
     * @return \Doctrine\ORM\AbstractQuery
     */
    public function findOneByAbbr($abbr)
    {
	$qb = $this->_em->getRepository($this->getEntityName())->createQueryBuilder("scl");

	return $qb->select("scl")
			->where("scl.abbr = '$abbr'")
			->getQuery()
			->getSingleResult();
    }

    /**
     * 
     * @param string $code
     * @return \Doctrine\ORM\AbstractQuery
     */
    public function findOneByCode($code)
    {
	$qb = $this->_em->getRepository($this->getEntityName())->createQueryBuilder("scl");
	return $qb->select("scl")
			->where("scl.code = '$code'")
			->getQuery()
			->getSingleResult();
    }

    /**
     * 
     * @param int|array $state
     * @return \Doctrine\ORM\AbstractQuery
     * 
     * 
     */
    public function findByState($state)
    {
	$qb = $this->_em->getRepository($this->getEntityName())->createQueryBuilder("scl");
	$qb->select("scl");
	if (is_array($state))
	{
	    $orX = $qb->expr()->orX();
	    foreach ($state as $val)
	    {
		$orX->add("scl.state = $val");
	    }
	    $qb->where($orX);
	}
	else
	{
	    $qb->where("scl.state = $state");
	}
	return $qb->getQuery()->getResult();
    }

}
