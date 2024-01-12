<?php

namespace App\DataFixtures;

use App\Entity\Region;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class RegionFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $regions = [
            "kayes",
            "koulikoro",
            "segou",
            "mopti",
            "tombouctou"
        ];
        foreach ($regions as $name){
            $region = new Region();
            $region->setName($name);
            $manager->persist($region);
            $this->addReference('REGION_'.strtoupper($name), $region);

        }
        // 

        $manager->flush();
    }
}
