<?php

/*
	App : espace de noms défini par défaut > composer.json
		App : dossier src
		Controller : dossier src/Controller
*/
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;

class HomepageController extends AbstractController
{
	/*
		annotations
			utiliser uniquement des doubles gillemets
			commentaires lus par symfony
			@Route : paramètres
				schéma de la route : url saisie
				name : nom unique de la route
					nomenclature : nom du contrôleur . nom de la méthode
		
		récupération de la requête HTTP:
			lister les services : symfony console debug:container
			injecter un service:
				créer une propriété qui va stocker le service
				créer un constructeur avec un paramètre du même type que le service
				dans le constructeur : lien entre la propriété et le paramètre
		RequestStack: service qui contient plusieurs requêtes et sous-requête
		Request : requête HTTP
*/

	private RequestStack $requestStack;
	private Request $request;

	public function __construct(RequestStack $requestStack)
	{
		$this->requestStack = $requestStack;
		$this->request = $this->requestStack->getCurrentRequest();
	}

	/**
	 * @Route("/", name="homepage.index")
	*/
	public function index():Response
	{
		/*
			débogage :
				dd : dump and die
				dump : affichage dans la barre de débogage de symfony
			
			Request:
				propriété request : $_POST
				propriété query : $_GET
				propriété files : $_FILES
				propriété headers : en-têtes
		*/
		//dd($this->request->headers->get('accept-language'));
		//$response = new Response('coucou');
		//return $response;

		/*
			vue Twig :
				créer un dossier du même nom que le contrôleur dans le dossier "templates"
				dans le dossier, créer un fichier du même nom que la méthode, avec une extension html.twig
			méthode render : appel d'une vue twig à partir du dossier "templates"
		*/
		return $this->render('homepage/index.html.twig');
	}
}

