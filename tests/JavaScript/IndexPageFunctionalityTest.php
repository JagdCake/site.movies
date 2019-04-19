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
    }
}
