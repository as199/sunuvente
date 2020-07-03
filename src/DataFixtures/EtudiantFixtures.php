<?php

namespace App\DataFixtures;

use App\Entity\Chambre;
use App\Entity\Etudiant;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Validator\Constraints\Choice;

class EtudiantFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('fr_FR');


        for ($j = 1; $j <3; $j++) {
            $article = new Chambre();
            $article->setNumchambre("145-m5l");
            $article->setType(2);
            # code...
            $manager->persist($article);
        for ($i = 1; $i <= mt_rand(4, 6); $i++) {
            $etudiant = new Etudiant();
            $etudiant->setMatricule("10542$i")
                ->setPrenom("Prenom$i")
                ->setNom("Nom$i")
                ->setEmail("etudiant$i@gmail.com")
                ->setType("type$i")
                ->setTelephone("77150870$i")
                ->setDateNaissance(new \DateTime())
                ->setChambre($article);
            $manager->persist($etudiant);

            }
        }
        $manager->flush();
    }
}
