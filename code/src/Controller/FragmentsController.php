<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/frags')]
class FragmentsController extends AbstractController
{
    #[Route('/home', name: 'app_frags_home', methods: ['GET'])]
    public function home(): Response
    {
        return $this->render('frags/home.html.twig', [
            'nom' => 'AzKam',
        ]);
    }
}
