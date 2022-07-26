<?php

namespace Controllers;

use MVC\Router;

class AppointmentController
{
  public static function index(Router $router)
  {
    session_start();
    isAuthenticated();

    $router->render('appointment/index', [
      'name' => $_SESSION['fullname'],
      'id' => $_SESSION['id']
    ]);
  }
}
