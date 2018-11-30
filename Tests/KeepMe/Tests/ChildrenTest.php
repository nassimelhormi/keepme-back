<?php

use Silex\Application;
use Symfony\Component\HttpKernel\Tests\Controller;

Use KeepMe\Entities\User;

class ChildrenTest extends PHPUnit_Framework_TestCase
{
    private $app;
    public function __construct()
    {
        $this->app = new Silex\Application();
    }

    public function testGetAllChildrens()
    {
        $app = new Silex\Application();
        $application_env = getenv("APPLICATION_ENV") ? : null;
        $app->register(new KeepMe\Config($application_env));

        $controller = new KeepMe\Controllers\ChildrenController;
        $this->assertEquals(true, 0 < count($controller->getAllChildrens($app)));
    }

    public function testGetNurseById()
    {
        $app = new Silex\Application();
        $application_env = getenv("APPLICATION_ENV") ? : null;
        $app->register(new KeepMe\Config($application_env));

        $controller = new KeepMe\Controllers\ChildrenController;
        $userController = new KeepMe\Controllers\UserController;

        $user = (array) (json_decode($userController->getUserById($app, 1)->getContent()));
        $result = (array) (json_decode($controller->getChildrenById($app, 1)->getContent()));
        var_dump($result);
        $this->assertArrayHasKey('id', $result);
        $this->assertArrayHasKey('firstname', $result);
        $this->assertArrayHasKey('description', $result);
        $this->assertArrayHasKey('user', $result);
        $this->assertArrayHasKey('birthdate', $result);

        $this->assertEquals($result["id"], 1);
        $this->assertEquals($result["firstname"], 'lilou');
        $this->assertEquals($result["description"], 'Apportez des couches !');

        $this->assertArrayHasKey('id', $user);
        $this->assertArrayHasKey('firstname', $user);
        $this->assertArrayHasKey('lastname', $user);
        $this->assertArrayHasKey('email', $user);
        $this->assertArrayHasKey('longitude', $user);
        $this->assertArrayHasKey('latitude', $user);

        $this->assertEquals($user["id"], 1);
        $this->assertEquals($user["firstname"], 'Yanis');
        $this->assertEquals($user["lastname"], 'AYAD');
        $this->assertEquals($user["email"], 'ayad_y@etna-alternance.net');
        $this->assertEquals($user["longitude"], 2.5333);
        $this->assertEquals($user["latitude"], 48.9667);
    }
}
