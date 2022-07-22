<?php

namespace Controllers;

use MVC\Router;

class LoginController
{
  public static function login(Router $router)
  {
    $router->render('auth/login');
  }

  public static function logout()
  {
    echo 'LoginController::logout';
  }

  public static function createAccount(Router $router)
  {
    $router->render('auth/create-account', []);
  }

  public static function forgotPassword()
  {
    echo 'LoginController::forgotPassword';
  }

  public static function resetPassword()
  {
    echo 'LoginController::resetPassword';
  }
}
