<?php
declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Item;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ItemFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $manager->persist(new Item('Grab Coffee', true));
        $manager->persist(new Item('Install Application', true));
        $manager->persist(new Item('Check Code Quality', false));
        $manager->persist(new Item('Hire Arne Van den Bogaert', false));

        $manager->flush();
    }
}
