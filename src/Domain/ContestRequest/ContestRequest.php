<?php

namespace App\Domain\ContestRequest;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="contest_requests")
 */
final class ContestRequest
{
    /**
     * @ORM\Id
     * @ORM\Column(type="bigint")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", name="first_name")
     */
    private $firstName;

    /**
     * @ORM\Column(type="string")
     */
    private $phoneNumber;

    /**
     * @ORM\Column(name="city_id", type="guid")
     */
    private $cityId;

    /**
     * @ORM\Column(type="string", name="sticker_code")
     */
    private $stickerCode;

    /**
     * @ORM\Column(type="boolean", name="is_active")
     */
    private $isActive;

    /**
     * @ORM\Column(type="datetime", name="created_at", options={"default": "CURRENT_TIMESTAMP"})
     */
    private $createdAt;

    public function getId()
    {
        return $this->id;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setFirstName(string $value): self
    {
        $this->firstName = $value;

        return $this;
    }

    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $value): self
    {
        $this->phoneNumber = $value;

        return $this;
    }

    public function getCityId(): string
    {
        return $this->cityId;
    }

    public function setCityId(string $value): self
    {
        $this->cityId = $value;

        return $this;
    }

    public function getStickerCode()
    {
        return $this->stickerCode;
    }

    public function setStickerCode(string $value): self
    {
        $this->stickerCode = $value;

        return $this;
    }

    public function getIsActive()
    {
        return $this->isActive;
    }

    public function setIsActive(bool $value): self
    {
        $this->isActive = $value;

        return $this;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCreatedAt($value): self
    {
        $this->createdAt = $value;

        return $this;
    }
}
