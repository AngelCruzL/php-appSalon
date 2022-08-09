<?php

namespace Controllers;

use Model\Service;

class APIController
{
  public static function index()
  {
    $services = Service::all();

    echo json_encode($services);
  }

  public static function saveAppointment()
  {
    $response = [
      'ok' => true,
      'data' => $_POST
    ];

    echo json_encode($response);
  }
}
