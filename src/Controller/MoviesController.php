<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\Movie;
use App\Repository\MovieRepository;
use App\Form\MovieType;

class MoviesController extends AbstractController
{
    /**
     * @Route("/movies", name="movies", methods={"GET"})
     */
    public function index(MovieRepository $repo): Response
    {
        return $this->render('movies/index.html.twig', [
            'movies' => $repo->findBy([], ['id' => 'DESC']),
        ]);
    }

    /**
     * @Route("/movies/add", name="addMovie", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $movie = new Movie();
        $form = $this->createForm(MovieType::class, $movie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($movie);
            $entityManager->flush();

            return $this->redirectToRoute('movies');
        }

        return $this->render('movies/add.html.twig', [
            'movie' => $movie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/movies/{id}/edit", name="editMovie", methods={"GET","PUT"}, requirements={"id"="\d{1,5}"})
     */
    public function edit(Request $request, Movie $movie): Response
    {
        $form = $this->createForm(MovieType::class, $movie, array('method' => 'PUT'));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirect('/movies'.'#'.$movie->getId());
        }

        return $this->render('movies/edit.html.twig', [
            'movie' => $movie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/movies/{id}", name="deleteMovie", methods={"DELETE"}, requirements={"id"="\d{1,5}"})
     */
    public function delete(Request $request, Movie $movie): Response
    {
        if ($this->isCsrfTokenValid('delete'.$movie->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($movie);
            $entityManager->flush();
        }

        return $this->redirectToRoute('movies');
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
