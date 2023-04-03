<?php

namespace App\ApiBundle\DataFixtures;

use App\SkyBundle\Entity\Galaxy;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class GalaxyFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 5; $i++) {
            $galaxy = new Galaxy();
            $galaxy->setName('Galaxy ' . $i);
            $manager->persist($galaxy);
        }

        $manager->flush();
    }
}
