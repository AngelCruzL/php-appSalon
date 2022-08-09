<?php

namespace Controllers;

use Model\Service;
use Model\Appointment;

class APIController
{
  public static function index()
  {
    $services = Service::all();

    echo json_encode($services);
  }

  public static function saveAppointment()
  {
    $appointment = new Appointment($_POST);
    $result = $appointment->save();

    echo json_encode($result);
  }
}
