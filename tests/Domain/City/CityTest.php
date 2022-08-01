<?php
declare(strict_types=1);

namespace Tests\Domain\City;

use App\Domain\ContestRequest\ContestRequest;
use App\Domain\ContestRequest\ContestRequestRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use PHPUnit\Framework\TestCase;
use Slim\Factory\AppFactory;

class CityTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        /** @var EntityManager $em */
        $em = AppFactory::create()
            ->getContainer()
            ->get(EntityManagerInterface::class);

        $em->beginTransaction();
    }

    public function test()
    {
        $contestRequest = new ContestRequest();
        $contestRequest->setFirstName('Michael Scott');
        $contestRequest->setIsActive(true);
        $contestRequest->setStickerCode('F23RD1');
        $contestRequest->setPhoneNumber('87777777777');
        $contestRequest->setCityId('8bb12224-0c22-11e9-a897-2cfda17020d1');

        $contestRequestRepository = $this->createMock(ContestRequestRepository::class);
        $contestRequestRepository->expects($this->any())
            ->method('find')
            ->willReturn($contestRequest);

        $objectManager = $this->createMock(ObjectManager::class);
        $objectManager->expects($this->any())
            ->method('getRepository')
            ->willReturn($contestRequestRepository);
    }
}
