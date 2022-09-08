<?php

namespace App\Controller;

use App\Repository\PublicationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(PublicationRepository $repository): Response
    {
        $publications = $repository->findAll();

        return $this->render('home/index.html.twig', [
            'publications' => $publications,
        ]);
    }

    #[Route('/publication/{id}', name: 'app_publication')]
    public function show(PublicationRepository $repository, $id)
    {
        $publication = $repository->find($id);

        return $this->render('home/publication.html.twig', [
            'publication' => $publication,
        ]);
    }
}