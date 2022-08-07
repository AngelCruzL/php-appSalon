<?php

namespace Controllers;

use Classes\Email;
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
          $user->createToken();

          $email = new Email($user->email, $user->firstname, $user->token);
          $email->sendConfirmationEmail();

          $result = $user->save();

          if ($result) {
            header('Location: /mensaje');
          }
        }
      }
    }

    $router->render('auth/create-account', [
      'user' => $user,
      'alerts' => $alerts
    ]);
  }

  public static function confirmAccount(Router $router)
  {
    $alerts = [];

    $token = s($_GET['token']);
    $user = User::where('token', $token);

    if (empty($user)) {
      User::setAlert('error', 'El token no es válido');
    } else {
      $user->is_confirmed = 1;
      $user->token = null;
      $user->save();
      User::setAlert('success', 'La cuenta ha sido confirmada correctamente');
    }

    $alerts = User::getAlerts();

    $router->render('auth/confirm-account', [
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

  public static function message(Router $router)
  {
    $router->render('auth/message', []);
  }
}
