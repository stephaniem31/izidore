<?php

namespace App\Controller;

use App\Entity\Appartment;
use App\Entity\Product;
use App\Entity\Review;
use App\Entity\User;
use App\Form\ReviewType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use ContainerHt5EXhX\getDoctrine_UlidGeneratorService;

/**
 * @Route("/vide-appart", name="appartment_")
 */

class AppartmentController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        $appartments = $this->getDoctrine()
            ->getRepository(Appartment::class)
            ->findAll();

        return $this->render('appartment/index.html.twig', [
            'appartments' => $appartments,
        ]);
    }

    /**
     * @Route("/{id}/", requirements={"id"="\d+"}, methods={"GET"}, name="show")
     */
    public function show(int $id): Response
    {
        $appartment = $this->getDoctrine()
            ->getRepository(Appartment::class)
            ->findOneBy(['id' => $id]);

        $products = $this->getDoctrine()
            ->getRepository(Product::class)
            ->findAll();

        $reviews = $this->getDoctrine()
            ->getRepository(Review::class)
            ->findAll();

        $nbReviews = $this->getDoctrine()
            ->getRepository(Review::class)
            ->countReviews();

        $rateAverage = $this->getDoctrine()
            ->getRepository(Review::class)
            ->rateAverage();


        return $this->render('appartment/show.html.twig', [
            'appart' => $appartment,
            'products' => $products,
            'reviews' => $reviews,
            'nbReviews' => $nbReviews,
            'rateAverage' => $rateAverage,
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
