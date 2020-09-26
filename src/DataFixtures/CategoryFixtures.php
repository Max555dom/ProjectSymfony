<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\AsciiSlugger;

class CategoryFixtures extends Fixture
{
	public function load(ObjectManager $manager)
	{
		$slugger = new AsciiSlugger();
		foreach(AbstractDataFixtures::CATEGORIES as $main => $sub)
		{
			/*
				avec Doctrine, pour manipuler les données d'une table, il faut passer par les entités
			*/
			$mainCategory = new Category();
			$mainCategory
				->setName($main)
				->setSlug( $slugger->slug($main) )
			;

			// méthode persist de doctrine : équivaut à insert into
			$manager->persist($mainCategory);

			// création des sous-catégories
			foreach($sub as $subcategory){
				$subcat = new Category();
				$subcat
					->setName($subcategory)
					->setSlug( $slugger->slug($subcategory) )
					->setParent( $mainCategory )
				;
				$manager->persist($subcat);

				/*
					stocker en mémoire les entités pour y accéder dans d'autres fixtures
					addReference : 2 paramètres
						identifiant unique de la référence
						entité liée à la référence
				*/
				$this->addReference("subcategory$subcategory", $subcat);
			}
		}
	  
		// méthode flush de doctrine qui permet d'exécuter les requêtes
		$manager->flush();
	}
}
