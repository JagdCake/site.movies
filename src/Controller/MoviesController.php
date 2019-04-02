<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Movie;

class MoviesController extends AbstractController
{
    /**
     * @Route("/", name="movies")
     */
    public function index()
    {
        $repository = $this->getDoctrine()->getRepository(Movie::class);
        $movies = $repository->findBy([], ['id' => 'DESC']);

        if(!$movies) {
            throw $this->createNotFoundException('No movie data has been found.');
        }

        return $this->render('movies/index.html.twig', [
            'movies' => $movies,
        ]);
    }
}
