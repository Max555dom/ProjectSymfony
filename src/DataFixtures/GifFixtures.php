<?php

namespace App\DataFixtures;

use App\Entity\Gif;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\String\Slugger\AsciiSlugger;

/*
	l'interface DependentFixtureInterface
		nécessite l'implémentation de la méthode getDependencies
		permet de préciser les dépendances entre fixtures
*/
class GifFixtures extends Fixture implements DependentFixtureInterface
{
	public function getDependencies():array
	{
		return [
			CategoryFixtures::class,
			UserFixtures::class,
		];
	}

    public function load(ObjectManager $manager)
    {
		$slugger = new AsciiSlugger();

		foreach(AbstractDataFixtures::CATEGORIES as $category => $subcategories){
			foreach($subcategories as $subcategory){
				$gif = new Gif();
				// getReference permet de récupérer une référence, par son identifiant, créée dans une autre fixtures
				$gif
					->setSource($slugger->slug($subcategory)->lower() . '.gif')
					->setSlug( $slugger->slug($subcategory)->lower() )
					->setCategory( $this->getReference("subcategory$subcategory") )
					->setUser( $this->getReference('user') )
				;

				$manager->persist($gif);
			};
		}

        $manager->flush();
    }
}
