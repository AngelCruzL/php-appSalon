<?php

namespace Controllers;

use MVC\Router;
use Model\Service;

class ServiceController
{
  public static function index(Router $router)
  {
    session_start();

    $router->render('services/index', [
      'name' => $_SESSION['fullname'],
    ]);
  }

  public static function createService(Router $router)
  {
    session_start();
    $service = new Service;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $service->sync($_POST);
      $alerts = $service->validateService();

      if (empty($alerts)) {
        $service->save();
        header('Location: /servicios');
      }
    }

    $router->render('services/create', [
      'name' => $_SESSION['fullname'],
      'service' => $service,
      'alerts' => $alerts
    ]);
  }

  public static function updateService(Router $router)
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    }

    session_start();

    $router->render('services/update', [
      'name' => $_SESSION['fullname'],
    ]);
  }

  public static function deleteService(Router $router)
  {
    echo '<h1>Eliminar Servicio</h1>';
  }
}
