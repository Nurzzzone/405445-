<?php

namespace App\Domain\StickerCode;

use Doctrine\ORM\Mapping as ORM;
use App\Domain\StickerCode\StickerCodeRepository;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="StickerCodeRepository", readOnly=true)
 * @ORM\Table(name="sticker_codes")
 */
final class StickerCode
{
    /**
     * @ORM\Id
     * @ORM\Column(type="bigint")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups("main")
     */
    private int $id;

    /**
     * @ORM\Column(type="bigint")
     * @Groups("main")
     */
    private int $code;

    public function getId(): int
    {
        return $this->id;
    }

    public function getCode(): int
    {
        return $this->code;
    }
}