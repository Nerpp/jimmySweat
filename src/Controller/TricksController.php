<?php

namespace App\Controller;

use App\Entity\Pic;
use App\Entity\Tricks;
use App\Entity\TricksGroup;
use App\Form\TricksType;
use App\Repository\TricksRepository;
use Doctrine\Common\Collections\ArrayCollection;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/tricks")
 *
 */
class TricksController extends AbstractController
{
    /**
     * @Route("/", name="tricks_index", methods={"GET"})
     * @param TricksRepository $tricksRepository
     * @return Response
     */
    public function index(TricksRepository $tricksRepository): Response
    {
        return $this->render('tricks/index.html.twig', [
            'tricks' => $tricksRepository->findAll(),
        ]);
    }

    /**
     * fonction pour traiter les images
     * Require ROLE_USER for *every* controller method in this class.
     * @IsGranted("ROLE_USER")
     * @param ArrayCollection $collectionPics
     * @param Tricks $tricks
     */
    public function treatmentPic(ArrayCollection $collectionPics,Tricks $tricks)
    {
        foreach ($collectionPics as $picture ) {

            /** @var UploadedFile $nameImage */

            $nameImage = $picture->getPicture();

            $originalName = $nameImage->getClientOriginalName();
            $safeFilename = transliterator_transliterate(
                'Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()',
                $originalName
            );
            $newFilename = $safeFilename . '-' . uniqid() . '.' . $nameImage->guessExtension();
            try {
                $nameImage->move(
//             path destination
                    'Image/ImagesLoaded/',
                    $newFilename
                );
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
            }
            /**@var Pic $picture */
            $picture->setPath($newFilename);
            $picture->setProfile(FALSE);
            $picture->setFkTricks($tricks);
            $picture->setFkUser($this->getUser());
        }
    }

    /**
     * @Route("/new", name="tricks_new", methods={"GET","POST"})
     * Require ROLE_USER for *every* controller method in this class.
     * @IsGranted("ROLE_USER")
     * @param Request $request
     * @return Response
     * @throws \Exception
     */
    public function new(Request $request): Response
    {
        $trick = new Tricks();
        $form = $this->createForm(TricksType::class, $trick);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $collectionPics = $form->get('pics')->getData();
            $this->treatmentPic($collectionPics,$trick);
            //todo : traiter les images
            $trick->setCreateDate(new \DateTime());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($trick);
            $entityManager->flush();

            return $this->redirectToRoute('tricks_index');
        }

        return $this->render('tricks/new.html.twig', [
            'trick' => $trick,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tricks_show", methods={"GET"})
     */
    public function show(Tricks $trick): Response
    {
        return $this->render('tricks/show.html.twig', [
            'trick' => $trick,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="tricks_edit", methods={"GET","POST"})
     * Require ROLE_USER for *every* controller method in this class.
     * @IsGranted("ROLE_USER")
     * @param Request $request
     * @param Tricks $trick
     * @return Response
     * @throws \Exception
     */
    public function edit(Request $request, Tricks $trick): Response
    {
        $form = $this->createForm(TricksType::class, $trick);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $trick->setUpdateDate(new \DateTime());
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('tricks_index');
        }


        return $this->render('tricks/edit.html.twig', [
            'trick' => $trick,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tricks_delete", methods={"DELETE"})
     * Require ROLE_USER for *every* controller method in this class.
     * @IsGranted("ROLE_USER")
     * @param Request $request
     * @param Tricks $trick
     * @return Response
     */
    public function delete(Request $request, Tricks $trick): Response
    {
        if ($this->isCsrfTokenValid('delete'.$trick->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($trick);
            $entityManager->flush();
        }

        return $this->redirectToRoute('tricks_index');
    }


}
