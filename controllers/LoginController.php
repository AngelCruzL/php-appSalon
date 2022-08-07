<?php

namespace Controllers;

use Classes\Email;
use MVC\Router;
use Model\User;

class LoginController
{
  public static function login(Router $router)
  {
    $alerts = [];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $auth = new User($_POST);
      $alerts = $auth->loginValidation();

      if (empty($alerts)) {
        $user = User::where('email', $auth->email);

        if ($user) {
          $isUserAuth =   $user->loginChecks($auth->password);

          if ($isUserAuth) {
            session_start();
            $_SESSION['id'] = $user->id;
            $_SESSION['fullname'] = $user->firstname . ' ' . $user->lastname;
            $_SESSION['email'] = $user->email;
            $_SESSION['isLogged'] = true;

            if ($user->is_admin === '1') {
              $_SESSION['isAdmin'] = $user->is_admin ?? null;
              header('Location: /admin');
            } else {
              header('Location: /cita');
            }
          }
        } else {
          User::setAlert('error', 'Usuario no encontrado');
        }
      }
    }

    $alerts = User::getAlerts();

    $router->render('auth/login', [
      'alerts' => $alerts
    ]);
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
    $alerts = [];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $auth = new User($_POST);
      $alerts = $auth->validateEmail();

      if (empty($alerts)) {
        $user = User::where('email', $auth->email);

        if ($user && $user->is_confirmed === '1') {
          $user->createToken();
          $user->save();
          $email = new Email($user->email, $user->firstname, $user->token);
          $email->sendForgotPasswordEmail();
          User::setAlert('success', 'Se ha enviado un correo electrónico a ' . $user->email . ' para restablecer su contraseña');
        } else {
          User::setAlert('error', 'El usuario no existe o no está confirmado');
        }
      }
    }

    $alerts =  User::getAlerts();

    $router->render('auth/forgot-password', [
      'alerts' => $alerts
    ]);
  }

  public static function resetPassword(Router $router)
  {
    $alerts = [];
    $error = false;

    $token = s($_GET['token']);
    $user = User::where('token', $token);
    if (empty($user)) {
      User::setAlert('error', 'El token no es válido');
      $error = true;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $password = new User($_POST);
      $alerts = $password->validatePassword();

      if (empty($alerts)) {
        $user->password = $password->password;
        $user->hashPassword();
        $user->token = null;
        $result =  $user->save();

        if ($result) {
          User::setAlert('success', 'La contraseña ha sido restablecida correctamente');
          $error = true;
          header('Refresh: 3; url=/');
        }
      }
    }

    $alerts =  User::getAlerts();
    $router->render('auth/reset-password', [
      'alerts' => $alerts,
      'error' => $error
    ]);
  }

  public static function message(Router $router)
  {
    $router->render('auth/message', []);
  }
}
