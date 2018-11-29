<?php

namespace KeepMe\Utils;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class CreateUtils
{
    /**
     * Récupère le KBis de la company
     *
     * @param Application $app       Silex Application
     * @param Company     $company
     *
     * @return
     */
    public static function checkCreateFields(Application $app, array $fields, $nurse = false)
    {
        if (empty($fields))
            return $app->abort(400, "Empty fields to create");
        if (empty($fields["email"]))
            return $app->abort(400, "Empty field : email");
        if (empty($fields["password"]))
            return $app->abort(400, "Empty field : password");
        if (empty($fields["firstname"]))
            return $app->abort(400, "Empty field : firstname");
        if (empty($fields["lastname"]))
            return $app->abort(400, "Empty field : lastname");
        if (empty($fields["longitude"]))
            return $app->abort(400, "Empty field : longitude");
        if (empty($fields["latitude"]))
            return $app->abort(400, "Empty field : latitude");
        if ($nurse) {
            if ($fields["birthdate"])
                return $app->abort(400, "Empty field : birthdate");
        }

        return;
    }
}
