<?php

namespace App\DataFixtures;

use App\Entity\Storage;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
;

class StorageFixtures extends Fixture
{
    //public const STORAGE_STORAGE_1 = 'STORAGE_STORAGE_1';
    public function load(ObjectManager $manager): void
    {
        $storages = [
            "storage1",
            "storage2",
            "storage3",
            "storage4",
            "storage5",
        ];
        foreach($storages as $name){
            $storage = new Storage();
            $storage->setName($name);
            $manager->persist($storage);
            $this->addReference('STORAGE_'.strtoupper($name), $storage);
        }
        // 

        $manager->flush();
    }
}
