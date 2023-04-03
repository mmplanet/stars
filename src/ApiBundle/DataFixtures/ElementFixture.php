<?php

namespace App\ApiBundle\DataFixtures;

use App\SkyBundle\Entity\Element;
use App\SkyBundle\Entity\Galaxy;
use App\SkyBundle\Entity\Star;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use GuzzleHttp\Client;

class ElementFixture extends Fixture
{
    const ELEMENTS_ENDPOINT = 'https://raw.githubusercontent.com/Bowserinator/Periodic-Table-JSON/master/PeriodicTableJSON.json';

    public function load(ObjectManager $manager)
    {

        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'https://github.com',
            // You can set any number of default request options.
            'timeout' => 2.0,
        ]);

        $elementsText = $client->get(self::ELEMENTS_ENDPOINT)->getBody()->getContents();
        $elements = json_decode($elementsText, true);

        if (count($elements['elements']) > 0) {
            foreach ($elements['elements'] as $element) {
                $dbElement = new Element();
                $dbElement->setName($element['name']);
                $dbElement->setAppearance($element['appearance']);
                $dbElement->setAtomicMass($element['atomic_mass']);
                $dbElement->setBoil($element['boil']);
                $dbElement->setCategory($element['category']);
                $dbElement->setDensity($element['density']);
                $dbElement->setMelt($element['melt']);
                $dbElement->setNumber($element['number']);
                $dbElement->setPeriod($element['period']);
                $dbElement->setGroup($element['group']);
                $dbElement->setPhase($element['phase']);
                $dbElement->setSymbol($element['symbol']);
                $manager->persist($dbElement);
            }
        }
        $manager->flush();
    }
}
