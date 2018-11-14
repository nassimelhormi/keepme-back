<?php

use Silex\Application;
use Symfony\Component\HttpKernel\Tests\Controller;

Use KeepMe\Entities\User;

class NurseTest extends PHPUnit_Framework_TestCase
{
    private $app;
    public function __construct()
    {
        $this->app = new Silex\Application();
    }

    public function testGetAllNurses()
    {
        $app = new Silex\Application();
        $application_env = getenv("APPLICATION_ENV") ? : null;
        $app->register(new KeepMe\Config($application_env));

        $controller = new KeepMe\Controllers\NurseController;
        $this->assertEquals(true, 0 < count($controller->getAllNurses($app)));
    }

    public function testGetNurseById()
    {
        $app = new Silex\Application();
        $application_env = getenv("APPLICATION_ENV") ? : null;
        $app->register(new KeepMe\Config($application_env));

        $controller = new KeepMe\Controllers\NurseController;

        $result = (array) (json_decode($controller->getNurseById($app, 1)->getContent()));
        $this->assertArrayHasKey('id', $result);

        $this->assertEquals($result["id"], 1);
    }
}
