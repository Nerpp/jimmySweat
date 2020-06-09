<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ValidateTrickDeleteController extends AbstractController
{

    /**
     * @Route("/validate/trick/delete/{id}", name="validate_trick_delete")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
//        dd($request->attributes->getInt('id'));
        return $this->render('validate_trick_delete/index.html.twig', [
            'controller_name' => 'ValidateTrickDeleteController',
        ]);
    }
}
