<?php

namespace App\SkyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Star
 *
 * @ORM\Table(name="star")
 * @ORM\Entity(repositoryClass="App\SkyBundle\Repository\StarRepository")
 */
class Star
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"basic"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string")
     * @Groups({"basic"})
     */
    private $name;

    /**
     * @var Galaxy
     *
     * @ORM\ManyToOne(targetEntity="App\SkyBundle\Entity\Galaxy", inversedBy="stars")
     * @ORM\JoinColumn(name="galaxy_id", referencedColumnName="id", nullable=true)
     */
    private $galaxy;

    /**
     * @var int
     *
     * @ORM\Column(name="radius", type="integer", nullable=true)
     * @Groups({"basic"})
     */
    private $radius;

    /**
     * @var integer
     *
     * @ORM\Column(name="temperature", type="integer", nullable=true)
     * @Groups({"basic"})
     */
    private $temperature;

    /**
     * @var integer
     *
     * @ORM\Column(name="rotation_frequency", type="integer", nullable=true)
     * @Groups({"basic"})
     */
    private $rotationFrequency;

    /**
     * @ORM\ManyToMany(targetEntity="App\SkyBundle\Entity\Element", inversedBy="stars")
     * @ORM\JoinTable(name="star_elements",
     *      joinColumns={@ORM\JoinColumn(name="star_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="element_id", referencedColumnName="id")}
     *      )
     */
    private $elements;

    /**
     * @var integer
     *
     * @Groups({"basic"})
     */
    private $volume;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return Galaxy
     */
    public function getGalaxy()
    {
        return $this->galaxy;
    }

    /**
     * @param Galaxy $galaxy
     */
    public function setGalaxy(Galaxy $galaxy): void
    {
        $this->galaxy = $galaxy;
    }

    /**
     * @return int
     */
    public function getRadius()
    {
        return $this->radius;
    }

    /**
     * @param int $radius
     */
    public function setRadius($radius): void
    {
        $this->radius = $radius;
    }

    /**
     * @return int
     */
    public function getTemperature()
    {
        return $this->temperature;
    }

    /**
     * @param int $temperature
     */
    public function setTemperature($temperature): void
    {
        $this->temperature = $temperature;
    }

    /**
     * @return int
     */
    public function getRotationFrequency()
    {
        return $this->rotationFrequency;
    }

    /**
     * @param int $rotationFrequency
     */
    public function setRotationFrequency($rotationFrequency): void
    {
        $this->rotationFrequency = $rotationFrequency;
    }

    /**
     * @return mixed
     */
    public function getElements()
    {
        return $this->elements;
    }

    /**
     * @param mixed $elements
     */
    public function setElements($elements): void
    {
        $this->elements = $elements;
    }

    /**
     * @return int
     */
    public function getVolume()
    {
        return 4/3 * pi() * pow($this->radius, 3);
    }
}
