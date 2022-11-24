<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ZZController extends AbstractController
{
    #[Route('/pages/{page}', name: 'app_pages')]
    public function pages($page): Response
    {
        //Return file content
        return new Response(file_get_contents(__DIR__ . '/../../public/pages/' . $page . '.html'));
    }


    #[Route('/{string}', name: 'app_zz')]
    public function angular_routes(): Response
    {
        return $this->render('index.html.twig');
    }
}
