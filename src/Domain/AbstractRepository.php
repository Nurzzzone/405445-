<?php

namespace App\Domain;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\QueryBuilder;

class AbstractRepository extends EntityRepository
{
    private $queryBuilder;

    public function __construct(EntityManagerInterface $em, ClassMetadata $class)
    {
        parent::__construct($em, $class);
    }

    protected function getQueryBuilder(): QueryBuilder
    {
        if (is_null($this->queryBuilder)) {
            return $this->createQueryBuilder('a');
        }

        return $this->queryBuilder;
    }
}


