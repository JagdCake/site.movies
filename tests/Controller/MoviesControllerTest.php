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

    public function testRootRedirectWorks() {
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
     * @depends testRootRedirectWorks
     */
    public function testAllMoviesAreFetchedFromDb($client) {
        $crawler = $client->followRedirect();

        $this->assertEquals(
            3,
            $crawler->filter('article[id]')->count(), // number of movie cards
        );
    }

    public function testAddFormAttributesAreCorrect() {
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
     * @depends testAddFormAttributesAreCorrect
     */
    public function testAddingAMovieWorks(object $addRoute) {
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
            'The watched_on date of the newly added movie should equal today\'s date',
        );
    }

    public function testEditFormAttributesAreCorrect() {
        $client = static::createClient();

        $client->request('GET', '/movies');
        $crawler = $client->clickLink('Edit');

        $this->assertEquals(
            'PUT',
            $crawler->filter('input[name="_method"]')->attr('value'),
            'Symfony should insert an input with the correct form method'
        );

        $form = $crawler->filter('form[name="movie"]')->form();

        $this->assertRegExp(
            '/movies\/\d{1,5}\/edit/',
            $form->getUri(), // the form's action attribute
        );

        return (object)[
            'client' => $client,
            'form' => $form,
        ];
    }

    /**
     * @depends testEditFormAttributesAreCorrect
     */
    public function testEditingAMovieWorks(object $editRoute) {
        $client = $editRoute->client;
        $form = $editRoute->form;

        $this->assertEquals(
            'Test Movie 2',
            $form->getValues()['movie[title]'],
            'The data of the movie to edit should be displayed'
        );

        $form->setValues([
            'movie[title]' => 'Edit Movie 0',
        ]);
        $client->submit($form);

        preg_match('/\d{1,5}/', $form->getUri(), $matches);
        $movieId = $matches[0];
        $this->assertTrue(
            $client->getResponse()->isRedirect('/movies#'.$movieId),
            'Controller should redirect to the updated movie on successful submit'
        );

        $crawler = $client->followRedirect();
        $this->assertEquals(
            'Edit Movie 0',
            $crawler->filter('article[id="'.$movieId.'"] .movie-title')->text(),
        );
    }

    public function testDeletingAMovieWorks() {
        $client = static::createClient();

        $client->request('GET', '/movies');
        $crawler = $client->clickLink('Edit');

        $form = $crawler->filter('input[value="DELETE"]')->parents()->form();
        $client->submit($form);

        $crawler = $client->followRedirect();
        $this->assertEquals(
            2,
            $crawler->filter('article[id]')->count(),
            'There should be two movies left after deleting one'
        );
    }
}
