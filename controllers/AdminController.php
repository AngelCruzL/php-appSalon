<?php

namespace Controllers;

use MVC\Router;

class AdminController
{
  public static function index(Router $router)
  {
    session_start();
    isAuthenticated();

    $router->render('admin/index', [
      'name' => $_SESSION['fullname'],
      'id' => $_SESSION['id']
    ]);
  }
}
