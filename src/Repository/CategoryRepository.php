<?php

namespace App\Repository;

use App\Entity\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Category|null find($id, $lockMode = null, $lockVersion = null)
 * @method Category|null findOneBy(array $criteria, array $orderBy = null)
 * @method Category[]    findAll()
 * @method Category[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Category::class);
    }

	// récupération de sous-catégories à partir du slug d'une catégorie principale
	public function getSubCategoriesByMainCategorySlug(string $slugCategory):Query
	{
		/*
			DQL : Doctrine Query Language
				createQueryBuilder : définition d'un alias pour l'entité
				select : sélection des propriétés de l'entité
				where : première condition
				andWhere : condition supplémentaire
				setMaxResults : équivaut à LIMIT
				join: 2 paramètres
					cibler une propriété relationnelle de l'entité
					alias de la jointure
				utilisation de getQuery en dernière position
			paramètres
				précéder les paramètres par :
				donner une valeur dans setParameters
		*/
		$query = $this->createQueryBuilder('category')
			->join('category.parent', 'parent')
			->where('parent.slug = :slug')
			->setParameters([
				'slug' => $slugCategory
			])

			/*->select('category.name, category.slug')
			->where('category.name LIKE :name')
			->setParameters([
				'name' => 'b%'
			])
			->setMaxResults(2)*/
			
			->getQuery()
		;

		return $query;
	}

	// récupération des sous-catégories, utilisé dans le formulaire
	public function getSubCategories():QueryBuilder
	{
		$query = $this->createQueryBuilder('category')
			->where('category.parent IS NOT NULL')
		;
		return $query;
	}



        public function search($search):Query{

            $query = $this->createQueryBuilder('category')
                ->where('category.name LIKE = :name')
                ->setParameter('name','%'.$search.'%' )
                ->getQuery()
            ;

            return $query;
        }





    // /**
    //  * @return Category[] Returns an array of Category objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Category
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
