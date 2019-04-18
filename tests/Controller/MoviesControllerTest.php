<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MoviesControllerTest extends WebTestCase {

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
}
