<?php

namespace App\Controller;

use App\Repository\GifRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class GifController extends AbstractController
{
	private GifRepository $gifRepository;

	public function __construct(GifRepository $gifRepository)
	{
		$this->gifRepository = $gifRepository;
	}

	/**
	 * @Route("/gif/{gifSlug}", name="gif.index")
	*/
	public function index(string $gifSlug):Response
	{
		// récupération d'un gif par son slug
		$gif = $this->gifRepository->findOneBy([
			'slug' => $gifSlug
		]);

		return $this->render('gif/index.html.twig', [
			'gif' => $gif,
		]);
	}
}

