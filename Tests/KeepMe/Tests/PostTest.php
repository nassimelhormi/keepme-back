<?php

use Silex\Application;
use Symfony\Component\HttpKernel\Tests\Controller;

Use KeepMe\Entities\User;

class PostTest extends PHPUnit_Framework_TestCase
{
    private $app;
    public function __construct()
    {
        $this->app = new Silex\Application();
    }

    public function testGetAllPosts()
    {
        $app = new Silex\Application();
        $application_env = getenv("APPLICATION_ENV") ? : null;
        $app->register(new KeepMe\Config($application_env));

        $controller = new KeepMe\Controllers\PostController;
        $this->assertEquals(true, 0 < count($controller->getAllPosts($app)));
    }

    public function testGetPostById()
    {
        $app = new Silex\Application();
        $application_env = getenv("APPLICATION_ENV") ? : null;
        $app->register(new KeepMe\Config($application_env));

        $controller = new KeepMe\Controllers\PostController;

        $result = (array) (json_decode($controller->getPostById($app, 49)->getContent()));
        var_dump($result);
        $this->assertArrayHasKey('id', $result);
//        $this->assertArrayHasKey('firstname', $result);
//        $this->assertArrayHasKey('lastname', $result);
//        $this->assertArrayHasKey('email', $result);
//        $this->assertArrayHasKey('longitude', $result);
//        $this->assertArrayHasKey('latitude', $result);

//        $this->assertEquals($result["firstname"], 'Yanis');
//        $this->assertEquals($result["lastname"], 'AYAD');
//        $this->assertEquals($result["email"], 'ayad_y@etna-alternance.net');
//        $this->assertEquals($result["longitude"], 2.5333);
//        $this->assertEquals($result["latitude"], 48.9667);
    }
}
