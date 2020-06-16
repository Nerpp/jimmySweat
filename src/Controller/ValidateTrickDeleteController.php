<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


class ValidateTrickDeleteController extends AbstractController
{

    /**
     * @Route("/validate/trick/delete/{id}", name="validate_trick_delete")
     * Require ROLE_USER for *every connected user* controller method in this class.
     * @IsGranted("ROLE_USER")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        return $this->render('validate_trick_delete/index.html.twig', [
            'controller_name' => 'ValidateTrickDeleteController',
            'id' => $request->attributes->getInt('id'),
        ]);
    }

}
