<?php

namespace App\Domain\StickerCode;

use App\Domain\AbstractRepository;

class StickerCodeRepository extends AbstractRepository
{
    public function isValidStickerCode(string $stickerCode)
    {
        $qb = $this->createQueryBuilder('qb');

        return $qb
            ->add('where', $qb->expr()->andX($qb->expr()->exists(
                $this->createQueryBuilder('sqb')->andWhere('sqb.code = :stickerCode')->getDQL()
            )))
            ->setParameter('stickerCode', $stickerCode)
            ->getQuery()
            ->getResult();
    }
}
