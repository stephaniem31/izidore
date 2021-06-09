<?php

namespace App\Controller;

use App\Entity\Appartment;
use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;

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

        $users = $this->getDoctrine()
            ->getRepository(User::class)
            ->findAll();

        return $this->render('appartment/index.html.twig', [
            'appartments' => $appartments,
            'users' => $users,
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

        return $this->render('appartment/show.html.twig', [
            'appart' => $appartment,
            'products' => $products,
        ]);
    }
}
