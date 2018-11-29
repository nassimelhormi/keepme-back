<?php

namespace KeepMe\Controllers;

use Ofat\SilexJWT\JWTAuth;

use Silex\Application;

use Silex\ControllerCollection;
use Silex\Api\ControllerProviderInterface;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use KeepMe\Entities\User;

class HomeController implements ControllerProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function connect(Application $app)
    {
        /* @var $controllers ControllerCollection */
        $controllers = $app['controllers_factory'];

        $controllers->get('/', [$this, 'index']);

        $controllers->post('/login', [$this, 'login']);
//        $controllers->post('/logout', [$this, 'logout']);

        return $controllers;
    }

    public function index(Application $app)
    {
        // $token = $app['jwt_auth']->getToken();

        return $app->json("home", 200);
    }

    public function login(Application $app, Request $req)
    {
        $email = $req->get('email') ?? null;
        $password = $req->get('password') ?? null;

        if (null === $email || null === $password)
            return $app->abort(400, "Empty email or password");

        $password = sha1($password);

        if (($user = $app["orm.em"]->getRepository(User::class)->findOneBy(["email" => $email, "password" => $password])) === null ||
//            (!$user->getIsActive()) ||
            ($token = $app['jwt_auth']->generateToken($user->toArray(), ["exp" => 86400])) === null)
            return $app->abort(401, json_encode([$email, $password, "Authentication failed"]));

        return $app->json(['token' => $token, 'user' => $user], 200);
    }

}
