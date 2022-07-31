<?php

namespace App\Domain\City;

use Doctrine\ORM\Mapping as ORM;
use App\Domain\City\CityRepository;

/**
 * @ORM\Entity(repositoryClass="CityRepository")
 * @ORM\Table(name="cities")
 */
final class City
{
    /**
     * @ORM\Id
     * @ORM\Column(type="guid")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }
}