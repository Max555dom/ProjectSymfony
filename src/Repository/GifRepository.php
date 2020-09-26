<?php

namespace App\Repository;

use App\Entity\Gif;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Gif|null find($id, $lockMode = null, $lockVersion = null)
 * @method Gif|null findOneBy(array $criteria, array $orderBy = null)
 * @method Gif[]    findAll()
 * @method Gif[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GifRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Gif::class);
	}
	
	// récupération des gifs par l'id de l'utilisateur
	public function getByUserId(int $userId):Query
	{
		$query = $this->createQueryBuilder('gif')
			->join('gif.user', 'user')
			->where('user.id = :id')
			->setParameters([
				'id' => $userId
			])
			->getQuery()
		;
		return $query;
	}

    public function getGifs(int $categoryId):Query
    {
        $query = $this->createQueryBuilder('gif')
            ->join('gif.category','user')
            ->where('category.id = :id')
            ->setParameters([
                'id' => $categoryId
            ])
            ->getQuery()
        ;
        return $query;
    }


    public function getGif2($Id):Query
    {
        $query = $this->createQueryBuilder('gif')
            ->where('gif.category = :id')
            ->setParameters([
                'id'=> $Id
            ])
            ->getQuery()
        ;
        return $query;

    }


    // /**
    //  * @return Gif[] Returns an array of Gif objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Gif
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
