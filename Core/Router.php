<?php

namespace App\Core;

use App\Controllers\FilmsController;
use App\Controllers\UsersController;

class Router
{
    public function routes()
    {
        session_start();

        $controller = (isset($_GET['controller']) ? ucfirst(array_shift($_GET)) : 'Films');
        $controller = "\\App\\Controllers\\" . $controller . "Controller";

        $action = (isset($_GET['action']) ? array_shift($_GET) : 'filmList');

        $controller = new $controller();



        if (method_exists($controller, $action)) {
            if ($this->guard($controller, $action)) return;
            (isset($_POST)) ? call_user_func_array([$controller, $action], $_POST) : $controller->$action();
        } else {
            http_response_code(404);
            echo "La page recherche n'existe pas";
        }
    }

    private function guard($controller, $action)
    {
        // return;

        //if the page is the film list just return
        if ($controller instanceof FilmsController &&  $action == 'filmList') return false;


        if (!isset($_SESSION["user"]) && !$controller instanceof UsersController) {

            $controller = 'Users';
            $controller = "\\App\\Controllers\\" . $controller . "Controller";
            $action = 'login';

            $controller = new $controller;

            call_user_func_array([$controller, $action], $_GET);


            return true;
        }
        return false;
    }
}
// index.php?controller=home&action=index