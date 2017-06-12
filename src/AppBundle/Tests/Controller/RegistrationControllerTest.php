<?php
/**
 * Created by PhpStorm.
 * User: nikunjbansal
 * Date: 8/6/17
 * Time: 7:26 PM
 */

namespace AppBundle\Tests\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegistrationControllerTest extends WebTestCase
{

    public function testRegister()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/register');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $this->assertSame(
            [
                'user[username]',
                'user[email]',
                'user[password][first]',
                'user[password][second]',
                'user[_token]'
            ],
            $crawler->filter('form')->filter('input')->extract('name')
        );
    }

}