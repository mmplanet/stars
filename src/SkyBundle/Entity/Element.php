<?php

namespace App\SkyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Element
 *
 * @ORM\Table(name="element")
 * @ORM\Entity(repositoryClass="App\SkyBundle\Repository\ElementRepository")
 */
class Element
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string")
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="appearance", type="string", nullable=true)
     */
    private $appearance;

    /**
     * @var float
     *
     * @ORM\Column(name="atomic_mass", type="float", nullable=true)
     */
    private $atomicMass;

    /**
     * @var float
     *
     * @ORM\Column(name="boil", type="float", nullable=true)
     */
    private $boil;

    /**
     * @var string
     *
     * @ORM\Column(name="category", type="string", nullable=true)
     */
    private $category;

    /**
     * @var float
     *
     * @ORM\Column(name="density", type="float", nullable=true)
     */
    private $density;

    /**
     * @var float
     *
     * @ORM\Column(name="melt", type="float", nullable=true)
     */
    private $melt;

    /**
     * @var int
     *
     * @ORM\Column(name="number", type="integer", nullable=true)
     */
    private $number;

    /**
     * @var int
     *
     * @ORM\Column(name="period", type="integer", nullable=true)
     */
    private $period;

    /**
     * @var int
     *
     * @ORM\Column(name="`group`", type="integer", nullable=true)
     */
    private $group;

    /**
     * @var string
     *
     * @ORM\Column(name="phase", type="string", nullable=true)
     */
    private $phase;

    /**
     * @var string
     *
     * @ORM\Column(name="symbol", type="string", length="3")
     */
    private $symbol;

    /**
     * @var
     *  @ORM\ManyToMany(targetEntity="App\SkyBundle\Entity\Star", mappedBy="elements")
     */
    private $stars;

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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getAppearance()
    {
        return $this->appearance;
    }

    /**
     * @param string $appearance
     */
    public function setAppearance($appearance): void
    {
        $this->appearance = $appearance;
    }

    /**
     * @return float
     */
    public function getAtomicMass()
    {
        return $this->atomicMass;
    }

    /**
     * @param float $atomicMass
     */
    public function setAtomicMass($atomicMass): void
    {
        $this->atomicMass = $atomicMass;
    }

    /**
     * @return float
     */
    public function getBoil()
    {
        return $this->boil;
    }

    /**
     * @param float $boil
     */
    public function setBoil($boil): void
    {
        $this->boil = $boil;
    }

    /**
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param string $category
     */
    public function setCategory($category): void
    {
        $this->category = $category;
    }

    /**
     * @return float
     */
    public function getDensity()
    {
        return $this->density;
    }

    /**
     * @param float $density
     */
    public function setDensity($density): void
    {
        $this->density = $density;
    }

    /**
     * @return float
     */
    public function getMelt()
    {
        return $this->melt;
    }

    /**
     * @param float $melt
     */
    public function setMelt($melt): void
    {
        $this->melt = $melt;
    }

    /**
     * @return int
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param int $number
     */
    public function setNumber($number): void
    {
        $this->number = $number;
    }

    /**
     * @return int
     */
    public function getPeriod()
    {
        return $this->period;
    }

    /**
     * @param int $period
     */
    public function setPeriod($period): void
    {
        $this->period = $period;
    }

    /**
     * @return int
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * @param int $group
     */
    public function setGroup($group): void
    {
        $this->group = $group;
    }

    /**
     * @return string
     */
    public function getPhase()
    {
        return $this->phase;
    }

    /**
     * @param string $phase
     */
    public function setPhase($phase): void
    {
        $this->phase = $phase;
    }

    /**
     * @return string
     */
    public function getSymbol(): string
    {
        return $this->symbol;
    }

    /**
     * @param string $symbol
     */
    public function setSymbol(string $symbol): void
    {
        $this->symbol = $symbol;
    }

    /**
     * @return mixed
     */
    public function getStars()
    {
        return $this->stars;
    }

    /**
     * @param mixed $stars
     */
    public function setStars($stars): void
    {
        $this->stars = $stars;
    }
}
