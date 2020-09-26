<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategoryRepository;

class SearchController extends AbstractController
{
    private Request $request;

    /**
     * @Route("/search", name="search.index")
     */

    public function index(Request $request)
    {
        $params = $request->get('title');
        $result = $this->categoryRepository->search($params)->getResult();
        $j = 0;

        for ($i = 0; $i < sizeof($result); $i++) {
            if ($this->gifRepository->getGif2($result[$j]->getid())->getResult() != Null) {

                $gifs[$i] = $this->gifRepository->getGif2($result[$j]->getid())->getResult();//requete SQL sur table gif;


            }
            $j++;
        }
        return $this->render('search/index.html.twig', ['gifs' => $gifs]);
    }
}

