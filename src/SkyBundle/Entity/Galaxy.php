<?php

namespace App\SkyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Galaxy
 *
 * @ORM\Table(name="galaxy")
 * @ORM\Entity(repositoryClass="App\SkyBundle\Repository\GalaxyRepository")
 */
class Galaxy
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
     * @ORM\OneToMany(targetEntity="App\SkyBundle\Entity\Star", mappedBy="galaxy")
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
