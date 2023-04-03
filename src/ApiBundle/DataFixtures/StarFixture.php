<?php

namespace App\ApiBundle\DataFixtures;

use App\SkyBundle\Entity\Element;
use App\SkyBundle\Entity\Galaxy;
use App\SkyBundle\Entity\Star;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class StarFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 130; $i++) {
            $star = new Star();
            $star->setName('Star ' . $i);
            $star->setTemperature(rand(100, 19999999));
            $star->setRadius(rand(100, 10000000));
            $star->setRotationFrequency(rand(20, 3000));

            $elements = $manager->getRepository(Element::class)->findAll();
            $starElements = [];
            $elementKeys = array_rand($elements, rand(2, count($elements)));
            for ($j = 0; $j < count($elementKeys); $j++) {
                $starElements[] = $elements[$elementKeys[$j]];
            }
            $star->setElements($starElements);

            $galaxies = $manager->getRepository(Galaxy::class)->findAll();
            $galaxy = $galaxies[array_rand($galaxies)];
            $star->setGalaxy($galaxy);

            $manager->persist($star);
        }

        $manager->flush();
    }
}
