<?php

namespace App\DataFixtures;

use App\Entity\Bootle;
use App\Entity\Storage;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
;

class BootleFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
         $bootle = new Bootle();
         $bootle->setName('Chalie');
         $bootle->setYear(DateTime::createFromFormat('Y', 1935));
         $bootle->setRegion($this->getReference('REGION_KAYES'));
         $bootle->setType($this->getReference('TYPE_BLANC'));
         $bootle->setStorage($this->getReference('STORAGE_STORAGE1'));
        $manager->persist($bootle);
        $bootle = new Bootle();
        $bootle->setName('jus');
        $bootle->setYear(DateTime::createFromFormat('Y', 2010));
        $bootle->setRegion($this->getReference('REGION_MOPTI'));
        $bootle->setType($this->getReference('TYPE_ROUGE'));
        $bootle->setStorage($this->getReference('STORAGE_STORAGE3'));
       $manager->persist($bootle);
       $bootle = new Bootle();
        $bootle->setName('coca');
        $bootle->setYear(DateTime::createFromFormat('Y', 2015));
        $bootle->setRegion($this->getReference('REGION_TOMBOUCTOU'));
        $bootle->setType($this->getReference('TYPE_BLANC'));
        $bootle->setStorage($this->getReference('STORAGE_STORAGE1'));
       $manager->persist($bootle);
        $manager->flush();
    }
    public function getDependencies() : array
    {
        return [
            RegionFixtures::class,
            StorageFixtures::class,
            TypeFixtures::class,
        ];
    }
}
