<?php

namespace Controllers;

use MVC\Router;
use Model\Service;

class ServiceController
{
  public static function index(Router $router)
  {
    session_start();

    $services = Service::all();

    $router->render('services/index', [
      'name' => $_SESSION['fullname'],
      'services' => $services
    ]);
  }

  public static function createService(Router $router)
  {
    session_start();
    $service = new Service;
    $alerts = [];

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
    session_start();
    if (!is_numeric($_GET['id'])) header('Location: /servicios');

    $service = Service::find($_GET['id']);
    $alerts = [];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $service->sync($_POST);
      $alerts = $service->validateService();

      if (empty($alerts)) {
        $service->save();
        header('Location: /servicios');
      }
    }

    $router->render('services/update', [
      'name' => $_SESSION['fullname'],
      'service' => $service,
      'alerts' => $alerts
    ]);
  }

  public static function deleteService()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $id = $_POST['id'];
      $service = Service::find($id);
      $service->delete();
      header('Location: /servicios');
    }
  }
}
