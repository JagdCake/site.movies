<?php

namespace App\Tests\JavaScript;

use Symfony\Component\Panther\PantherTestCase;

class FormFunctionalityTest extends PantherTestCase {

    public function testAddingDirectorFieldsWorks() {
        $client = static::createPantherClient();

        $crawler = $client->request('GET', '/movies/add');

        $this->assertEquals(
            1,
            $crawler->filter('.director-field')->count(),
            'There should be only one director input on the add form page',
        );

        $addDirectorButton = $crawler->filter('.button-add-director');
        $addDirectorButton->click();
        $addDirectorButton->click();
        $addDirectorButton->click();

        $this->assertEquals(
            3,
            $crawler->filter('.director-field')->count(),
            'The maximum number of director inputs should be 3',
        );

        return $crawler;
    }

    /**
     * @depends testAddingDirectorFieldsWorks
     */
    public function testRemovingDirectorFieldsWorks($crawler) {
        $crawler->filter('.button-remove-director')->click();
        $crawler->filter('.button-remove-director')->click();

        $this->assertEquals(
            1,
            $crawler->filter('.director-field')->count(),
            'There should be one director field after removing the other two',
        );
    }
}
