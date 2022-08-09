<?php

namespace Controllers;

use Model\Service;
use Model\Appointment;
use Model\AppointmentService;

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
    $id = $result['id'];

    $idServices = explode(',', $_POST['services']);
    foreach ($idServices as $idService) {
      $args = [
        'appointment_id' => $id,
        'service_id' => $idService
      ];
      $appointmentService = new AppointmentService($args);
      $appointmentService->save();
    }

    $response = [
      'result' => $result,
    ];
    echo json_encode($response);
  }
}
