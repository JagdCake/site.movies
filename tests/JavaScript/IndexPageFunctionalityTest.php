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

    /**
     * @depends testSearchButtonWorks
     */
    public function testHidingTheSearchResultsWorks($crawler) {
        $this->assertTrue(
            $crawler->filter('.movie-list')->isDisplayed(),
        );

        $crawler->filter('body')->click();
        $this->assertFalse(
            $crawler->filter('.movie-list')->isDisplayed(),
            'Clicking outside the search results element should hide it'
        );

        $client = static::createPantherClient();

        $crawler->filter('input[type="search"]')->sendKeys('t'); // display search results
        $client->getKeyboard()->pressKey("\xEE\x80\x8C"); // press ESCAPE
        $this->assertFalse(
            $crawler->filter('.movie-list')->isDisplayed(),
            'Pressing ESCAPE should hide the search results'
        );

        $crawler->filter('input[type="search"]')->sendKeys('t');
        $client->getKeyboard()->pressKey("\xEE\x80\x84"); // press tab to select the first result
        $client->getKeyboard()->pressKey("\xEE\x80\x87"); // press enter to go to the selected movie

        $this->assertFalse(
            $crawler->filter('.movie-list')->isDisplayed(),
            'Pressing ENTER on a selected movie should hide the search results'
        );

        $crawler->filter('input[type="search"]')->sendKeys('e');
        $crawler->filter('.movie-list p a')->first()->click();

        $this->assertFalse(
            $crawler->filter('.movie-list')->isDisplayed(),
            'Clicking on a selected movie should hide the search results'
        );
    }

    public function testAboutButtonWorks() {
        $client = static::createPantherClient();
        $crawler = $client->request('GET', '/movies');

        $this->assertEquals(
            '8px',
            $crawler->filter('.about')->getCSSValue('height'),
            'The about section\'s height should equal the default HTML block element\'s height when the height is set to 0'
        );

        $crawler->filter('.about-button')->click();

        $this->assertContains(
            'height',
            $crawler->filter('.about')->getAttribute('style'),
            'Opening the about section should set its height with a style attribute'
        );
    }
}
