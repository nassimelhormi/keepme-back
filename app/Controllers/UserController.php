<?php

namespace KeepMe\Controllers;

use Silex\Application;
use Silex\ControllerCollection;
use Silex\Api\ControllerProviderInterface;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

Use KeepMe\Entities\User;

use Ofat\SilexJWT\JWTAuth;
use Ofat\SilexJWT\Middleware\JWTTokenCheck;

class UserController implements ControllerProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function connect(Application $app)
    {
        /* @var $controllers ControllerCollection */
        $controllers = $app['controllers_factory'];

        // On récupère tous les utilisateurs
        $controllers->get('/users', [$this, 'getAllUsers'])
                    ->before(new JWTTokenCheck());

        // On récupère un utilisateur selon un id
        $controllers->get('/user/{user_id}', [$this, 'getUserById'])
                    ->before(new JWTTokenCheck());

        // On crée un utilisateur
        $controllers->post('/user', [$this, 'createUser']);
//                    ->before(new JWTTokenCheck());

        return $controllers;
    }

    /**
     * Récupère tous les utilisateurs
     *
     * @param Application $app      Silex Application
     *
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function getAllUsers(Application $app, Request $request)
    {
        $token = substr($request->headers->get('authorization'), 7);
        $test = $app['jwt_auth']->getPayload($token);

        $all_users = $app["repositories"]("User")->findAll();

        return $app->json($all_users, 200);
    }

    /**
     * Récupère un utilisateur selon son id
     *
     * @param Application    $app      Silex Application
     * @param integer        $user_id  id du user
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function getUserById(Application $app, $user_id)
    {
        $user = $app["repositories"]("User")->findOneById($user_id);

        return $app->json($user, 200);
    }

    /**
     * Créer un utilisateur
     *
     * @param Application    $app      Silex Application
     * @param Request        $req      Request
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */

     /*
      ----- Prototype de body de requete -----
      {
      	"email": "dezeeu_l@etna-alternance.net",
      	"password": "dezeeu_l",
      	"firstname": "Louis",
      	"lastname": "DEZEEU",
      	"longitude": "2.5333",
      	"latitude": "48.9667"
      }
     */
    public function createUser(Application $app, Request $req)
    {
        $datas = $req->request->all();

        $user = new User();

        $user->setProperties($datas);
        $user->setPassword(sha1($datas["password"]));
        $app["orm.em"]->persist($user);
        $app["orm.em"]->flush();

        return $app->json($user, 200);
    }
}
