<?php

namespace App\Controller;

use App\Entity\Appartment;
use App\Entity\Product;
use App\Entity\Review;
use App\Form\ReviewType;
use App\Repository\AppartmentRepository;
use App\Repository\ProductRepository;
use App\Repository\ReviewRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/vide-appart", name="appartment_")
 */

class AppartmentController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(AppartmentRepository $appartmentRepository): Response
    {
        return $this->render('appartment/index.html.twig', [
            'appartments' => $appartmentRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}", requirements={"id"="\d+"}, methods={"GET"}, name="show")
     */
    public function show(Appartment $appartment, ReviewRepository $reviewRepository, ProductRepository $productRepository): Response
    {
        return $this->render('appartment/show.html.twig', [
            'appart' => $appartment,
            'products' => $productRepository->findAll(),
            'reviews' => $reviewRepository->findAll(),
            'nbReviews' => $reviewRepository->countReviews(),
            'rateAverage' => $reviewRepository->rateAverage(),
        ]);
    }

    /**
     * @Route("/{appartment}/product/{product}", requirements={"id"="\d+"}, methods={"GET", "POST"}, name="buy")
     */
    public function buy(Request $request, Appartment $appartment, Product $product)
    {
        $review = new Review();
        $user = $appartment->getUser();
        $userId = $user->getId();

        if ($product->getIsSold() === true) {
            return $this->redirectToRoute('appartment_show', [
                'id' => $userId
            ]);
        }

        $form = $this->createForm(ReviewType::class, $review);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $review->setAppartment($appartment);
            $review->setProduct($product);
            $product->setIsSold(true);


            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($review);
            $entityManager->persist($product);
            $entityManager->flush();

            return $this->redirectToRoute('appartment_show', [
                'id' => $userId
            ]);
        }

        return $this->render('review/new.html.twig', [
            'product' => $product,
            "form" => $form->createView(),
            'review' => $review,
        ]);
    }
}
