<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MoviesControllerTest extends WebTestCase {

    private $fakeMovieData = [
        'movie[imdb_id]' => 'tt0000003',
        'movie[title]' => 'Test Movie 3',
        'movie[runtime]' => 3,
        'movie[genre]' => 'testGenre',
        'movie[imdb_rating]' => 1.3,
        'movie[year_of_release]' => 2003,
        'movie[directors]' => ['Test Director'],
        'movie[top_actors]' => ['Test Actor 1', 'Test Actor 2'],
        'movie[my_rating]' => 'Great Onion',
        'movie[discussion]' => 'test link',
    ];

    public function testRootRedirect() {
        $client = static::createClient();

        $client->request('GET', '/');
        $response = $client->getResponse();

        $this->assertEquals(
            301,
            $response->getStatusCode()
        );

        $this->assertEquals(
            'http://localhost/movies',
            $response->headers->get('location')
        );

        return $client;
    }

    /**
     * @depends testRootRedirect
     */
    public function testMoviesAreFetchedFromDb($client) {
        $crawler = $client->followRedirect();

        $this->assertEquals(
            3,
            $crawler->filter('article[id]')->count(), // number of movie cards
        );
    }

    public function testAddFormAttributes() {
        $client = static::createClient();

        $crawler = $client->request('GET', '/movies/add');

        $form = $crawler->filter('form[name="movie"]')->form();

        $this->assertEquals(
            'POST',
            $form->getMethod(),
        );

        $this->assertEquals(
            'http://localhost/movies/add',
            $form->getUri(), // the form's action attribute
        );

        return (object)[
            'form' => $form,
            'client' => $client,
        ];
    }

    /**
     * @depends testAddFormAttributes
     */
    public function testAddingAMovie(object $addRoute) {
        $form = $addRoute->form;
        $client = $addRoute->client;

        $form->setValues($this->fakeMovieData);
        $client->submit($form);

        $this->assertTrue(
            $client->getResponse()->isRedirect(),
            'Controller should redirect on successful submit'
        );

        $crawler = $client->followRedirect();
        $this->assertEquals(
            $this->fakeMovieData['movie[title]'],
            $crawler->filter('.movie-title')->first()->text(),
        );

        $this->assertEquals(
            date('d M Y'), // today's date
            $crawler->filter('.watched-on time')->first()->text(),
        );
    }
}
