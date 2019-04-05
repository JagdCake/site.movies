<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

use App\Entity\Movie;
use App\Repository\MovieRepository;

class MoviesController extends AbstractController
{
    /**
     * @Route("/", name="movies", methods={"GET"})
     */
    public function index(MovieRepository $repo): Response
    {
        return $this->render('movies/index.html.twig', [
            'movies' => $repo->findBy([], ['id' => 'DESC']),
        ]);
    }

    /**
     * @Route("/javascript", name="javascriptLicenseInfo", methods={"GET"})
     */
    public function javascriptLicenseInfo(): Response
    {
        return $this->render('javascript.html');
    }

    /**
     * @Route("/generate", name="generateStaticSite", methods={"GET"})
     */
    public function generateStaticSite(MovieRepository $repo): Response
    {
        $content = $this->renderView('movies/index.html.twig', [
            'movies' => $repo->FindBy([], ['id' => 'DESC']),
        ]);

        $file = file_put_contents('../docs/index.html', $content);

        return $this->redirectToRoute('movies');
    }
}
