<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // 1. Premier produit
        $p1 = new Product();
        $p1->setName('Casque Airbod');
        $p1->setPrice(79.99);
        $p1->setImage('airbod.png');
        $manager->persist($p1);

        // 2. Deuxième produit
        $p2 = new Product();
        $p2->setName('Souris Gaming');
        $p2->setPrice(34.50);
        $p2->setImage('mouse.png');
        $manager->persist($p2);

        // 3. Troisième produit
        $p3 = new Product();
        $p3->setName('Clavier Mécanique');
        $p3->setPrice(59.90);
        $p3->setImage('item.png');
        $manager->persist($p3);

        $manager->flush();
    }
}
