<?php

namespace App\Domain\StickerCode;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="StickerCodeRepository", readOnly=true)
 * @ORM\Table(name="sticker_codes", uniqueConstraints=
 *     {@ORM\UniqueConstraint(columns={"code"})})
 */
final class StickerCode
{
    /**
     * @ORM\Id
     * @ORM\Column(type="bigint")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="bigint", unique=true)
     */
    private $code;

    public function getId(): int
    {
        return $this->id;
    }

    public function getCode(): int
    {
        return $this->code;
    }
}