<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends AbstractController
{
	private CategoryRepository $categoryRepository;

	public function __construct(CategoryRepository $categoryRepository)
	{
		$this->categoryRepository = $categoryRepository;
	}

	/*
		création de variable de route:
			utilisation d'accolades dans le schéma de la route
			la variable de route se retrouve en paramètre de la méthode
	*/
	/**
	 * @Route("/category/{categorySlug}", name="category.index")
	*/
	public function index(string $categorySlug):Response
	{
		// récupération d'une catégorie par son slug
		$category = $this->categoryRepository->findOneBy([
			'slug' => $categorySlug
		]);

		/*
			appel d'une requête personnalisée
				à créer dans les classes de dépôt (repository)
			méthode de récupération des résultats
				getResult : array de résultats
		*/
		$subcategories = $this->categoryRepository
			->getSubCategoriesByMainCategorySlug($categorySlug)
			->getResult()
		;
		//dd($subcategories);

		/*
			envoi de données à la vue
				utilisation du second paramètre de render sous forme de tableau associatif
				twig va récupérer les clés du tableau associatif 
		*/
		return $this->render('category/index.html.twig', [
			'category' => $category,
			'subcategories' => $subcategories,
		]);
	}

	/**
	 * @Route("/category/{categorySlug}/{subcategorySlug}", name="category.subcategory")
	*/
	public function subcategory(string $categorySlug, string $subcategorySlug):Response
	{
		// récupération de la sous-catégorie dans la base
		$subcategory = $this->categoryRepository->findOneBy([
			'slug' =>$subcategorySlug
		]);

		return $this->render('category/subcategory.html.twig', [
			'subcategory' => $subcategory
		]);
	}
}

