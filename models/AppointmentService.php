<?php

namespace Model;

class AppointmentService extends ActiveRecord
{
  protected static $table = 'appointments_services';
  protected static $dbColumns = [
    'id',
    'appointment_id',
    'service_id'
  ];

  public $id;
  public $appointment_id;
  public $service_id;

  public function __construct($args = [])
  {
    $this->id = $args['id'] ?? null;
    $this->appointment_id = $args['appointment_id'] ?? '';
    $this->service_id = $args['service_id'] ?? '';
  }
}
