<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use \Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\TricksRepository;



class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @param TricksRepository $tricksRepository
     * @return Response
     */
    public function index(TricksRepository $tricksRepository):Response
    {
//        $request->attributes->getInt('id')
        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
            'tricks' => $tricksRepository->findBy(array(),array('id'=> 'ASC'),$limit=15,$offset=null)
        ]);
    }
}
