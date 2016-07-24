<?php

namespace Jardiland\ProduitBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProduitControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/index');
    }

    public function testVoir()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/voir');
    }

    public function testBycategorie()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/categorie');
    }

}
