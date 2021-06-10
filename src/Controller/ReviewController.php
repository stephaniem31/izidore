<?php

namespace App\Controller;

use App\Entity\Review;
use App\Form\ReviewType;
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
     * @Route("/", name="new")
     */
    public function new(): Response
    {
        $review = new Review();
        $form = $this->createForm(ReviewType::class, $review);

        return $this->render('review/new.html.twig', [
            "form" => $form->createView(),

        ]);
    }
}
