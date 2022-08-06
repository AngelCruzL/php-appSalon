<?php

namespace Controllers;

use MVC\Router;
use Model\User;

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
    $user = new User;
    $alerts = [];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $user->sync($_POST);
      $alerts = $user->validateNewAccount();

      if (empty($alerts)) {
        $result = $user->checkIfUserExists();

        if ($result->num_rows) {
          $alerts = User::getAlerts();
        } else {
          $user->hashPassword();
          debug($user);
        }
      }
    }

    $router->render('auth/create-account', [
      'user' => $user,
      'alerts' => $alerts
    ]);
  }

  public static function forgotPassword(Router $router)
  {
    $router->render('auth/forgot-password', []);
  }

  public static function resetPassword()
  {
    echo 'LoginController::resetPassword';
  }
}
