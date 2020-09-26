<?php

namespace App\Controller\Profile;

use App\Entity\Gif;
use App\Form\GifType;
use App\Repository\GifRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\String\ByteString;

class HomepageController extends AbstractController
{
	private GifRepository $gifRepository;
	private RequestStack $requestStack;
	private Request $request;
	private EntityManagerInterface $entityManager;

	public function __construct(GifRepository $gifRepository, RequestStack $requestStack, EntityManagerInterface $entityManager)
	{
		$this->requestStack = $requestStack;
		$this->request = $this->requestStack->getCurrentRequest();
		$this->gifRepository = $gifRepository;
		$this->entityManager = $entityManager;
	}

	/**
	 * @Route("/profile", name="profile.homepage.index")
	*/
	public function index():Response
	{
		// récupération de l'utilisateur
		$user = $this->getUser();

		// récupération des gifs par l'id de l'utilisateur
		$gifs = $this->gifRepository->getByUserId( $user->getId() )->getResult();

		return $this->render('profile/homepage/index.html.twig', [
			'gifs' => $gifs
		]);
	}

	/**
	 * @Route("/profile/form", name="profile.homepage.form")
	*/
	public function form():Response
	{
		/*
			affichage d'un formulaire
				créer une classe de formulaire reliée à un modèle(entité ou classe) : make:form
				dans la classe de formulaire, définir les types de champs
				dans les champs, définir les contraintes de validation
			
			il est recommandé de supprimer les typages sur les propriétés liées aux images pour utiliser la classe UploadedFile de Symfony
		*/

		// instances nécessaires à l'affichage d'un formulaire
		$model = new Gif();
		$type = GifType::class;

		// création du formulaire
		$form = $this->createForm($type, $model);

		// récupération de la saisie dans la requête HTTP
		$form->handleRequest($this->request);

		// formulaire valide
		if($form->isSubmitted() && $form->isValid()){
			// associer l'utilisateur au gif
			$model->setUser( $this->getUser() );

			// gestion de l'image
			$imageName = ByteString::fromRandom(32)->lower();

			// guessExtension : méthode de UploadedFile qui permet de récupérer l'extension du fichier
			$imageExtension = $model->getSource()->guessExtension();

			// move :  méthode de UploadedFile qui permet de transférer l'image
			$model->getSource()->move('img', "$imageName.$imageExtension");

			// définir le slug et la source
			$model
				->setSlug("$imageName.$imageExtension")
				->setSource("$imageName.$imageExtension")
			;

			/*
				enregistrement en base de données:
					EntityManagerInterface qui permet les UPDATE, les INSERT et les DELETE
					méthode persist : équivaut à INSERT, mise en file d'attente
					flush : exécution des requêtes 
			*/
			$this->entityManager->persist($model);
			$this->entityManager->flush();

			//dd($model);
		}
 
		// méthode createView : permet de transcrire les propriétés du modèle en champ HTML 
		return $this->render('profile/homepage/form.html.twig', [
			'form' => $form->createView()
		]);
	}
}

