<?php

namespace App\DataFixtures;

use App\Entity\Type;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
;

class TypeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $types = [
            "blanc",
            "jaune",
            "rouge",
            "vert",
            "bordeaux"
        ];
        foreach ($types as $first){
            $type = new Type ();
            $type->setName($first);
            $manager->persist($type);
            $this->addReference('TYPE_'.strtoupper($first), $type);
        }
        

        $manager->flush();
    }
}
