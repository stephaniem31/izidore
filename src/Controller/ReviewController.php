<?php

namespace App\Controller;

use App\Entity\Appartment;
use App\Entity\Review;
use App\Entity\User;
use App\Form\ReviewType;
use App\Repository\AppartmentRepository;
use App\Repository\ReviewRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/review", name="review_")
 */

class ReviewController extends AbstractController
{
    /**
     * @Route("/", name="new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $review = new Review();
        $form = $this->createForm(ReviewType::class, $review);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($review);
            $entityManager->flush();

            return $this->redirectToRoute('review_show');
        }

        return $this->render('review/new.html.twig', [
            "form" => $form->createView(),
        ]);
    }

    /**
     * @Route("/show/{id}/", requirements={"id"="\d+"}, methods={"GET"}, name="show")     
     */
    public function show(Appartment $appartment, ReviewRepository $reviewRepository)
    {
        return $this->render('review/show.html.twig', [
            'reviews' => $reviewRepository->findBy(
                ['appartment' => $appartment->getId()],
            ),
            'appartment' => $appartment,
        ]);
    }
}
