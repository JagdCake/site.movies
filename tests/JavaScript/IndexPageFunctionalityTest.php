<?php

namespace App\Tests\JavaScript;

use Symfony\Component\Panther\PantherTestCase;

class IndexPageFunctionalityTest extends PantherTestCase {

    public function testSearchButtonWorks() {
        $client = static::createPantherClient();
        $crawler = $client->request('GET', '/movies');

        $this->assertFalse(
            $crawler->filter('input[type="search"]')->isDisplayed(),
        );

        $crawler->filter('.search-button')->click();

        $this->assertTrue(
            $crawler->filter('input[type="search"]')->isDisplayed(),
        );

        return $crawler;
    }

    /**
     * @depends testSearchButtonWorks
     */
    public function testMovieSearchWorks($crawler) {
        $crawler->filter('input[type="search"]')->sendKeys('t');

        $this->assertContains(
            'Test Movie 2',
            $crawler->filter('.movie-list p a')->first()->text(),
            'The first search result should be the title of the last added fixture data movie',
        );
    }
}
