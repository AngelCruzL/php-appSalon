<?php

namespace Controllers;

use MVC\Router;

class AppointmentController
{
  public static function index(Router $router)
  {
    session_start();

    $router->render('appointment/index', [
      'name' => $_SESSION['fullname'],
    ]);
  }
}
