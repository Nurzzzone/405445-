<?php

namespace App\Domain\ContestRequest;

use App\Domain\AbstractRepository;
use Carbon\CarbonImmutable;
use Doctrine\ORM\QueryBuilder;

final class ContestRequestRepository extends AbstractRepository
{
    public const STICKER_CODE_PER_PHONE_NUMBER = 12;

    public function getCurrentWeekCountFor(string $phoneNumber): int
    {
        $carbon = CarbonImmutable::now();

        return $this
            ->getQueryBuilder()
            ->andWhere('a.isActive = 1')
            ->andWhere('a.phoneNumber = :phoneNumber')
            ->setParameter('phoneNumber', $phoneNumber)
            ->andWhere('a.createdAt BETWEEN :startOfWeek AND :endOfWeek')
            ->setParameter('startOfWeek', $carbon->startOfWeek()->toDateTimeString())
            ->setParameter('endOfWeek', $carbon->endOfWeek()->toDateTimeString())
            ->select('COUNT(a.id)')
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function isAlreadyRegistered(string $phoneNumber, string $stickerCode): bool
    {
        $qb = $this->createQueryBuilder('qb');

        return (bool) $qb->add('where', $qb->expr()->andX(
            $qb->expr()->exists(
                $this->createQueryBuilder('sqb')
                    ->andWhere('sqb.phoneNumber = :phoneNumber')
                    ->andWhere('sqb.stickerCode = :stickerCode')
            )
        ))
        ->setParameter('phoneNumber', $phoneNumber)
        ->setParameter('stickerCode', $stickerCode)
        ->getQuery()
        ->getResult();
    }

    public function insertContestRequest(array $requestBody): void
    {
        $contestRequest = new ContestRequest();
        $contestRequest->setFirstName($requestBody['first_name']);
        $contestRequest->setPhoneNumber($requestBody['phone_number']);
        $contestRequest->setStickerCode($requestBody['sticker_code']);
        $contestRequest->setCityId($requestBody['city_id']);
        $contestRequest->setIsActive(true);
        $contestRequest->setCreatedAt(CarbonImmutable::now());

        $em = $this->getEntityManager();
        $em->persist($contestRequest);
        $em->flush();
    }
}
