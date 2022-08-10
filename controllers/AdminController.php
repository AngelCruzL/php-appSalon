<?php

namespace Controllers;

use Model\AdminAppointment;
use MVC\Router;

class AdminController
{
  public static function index(Router $router)
  {
    session_start();
    isAdmin();
    $currentDate = date('Y-m-d');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $currentDate = $_POST['date'];
    }

    $query = "SELECT a.id, a.time, CONCAT(u.firstname, ' ', u.lastname) AS client,
    u.email, u.phone, s.name AS service, s.price FROM appointments AS a
    LEFT OUTER JOIN users AS u
    ON a.user_id = u.id
    LEFT OUTER JOIN appointments_services AS a_s
    ON a_s.appointment_id = a.id
    LEFT OUTER JOIN services AS s
    ON s.id = a_s.service_id
    WHERE a.date = '${currentDate}'";

    $appointments = AdminAppointment::SQL($query);

    $router->render('admin/index', [
      'name' => $_SESSION['fullname'],
      'appointments' => $appointments,
      'currentDate' => $currentDate
    ]);
  }
}
