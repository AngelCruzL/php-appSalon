<?php

namespace Model;

class Appointment extends ActiveRecord
{
  protected static $table = 'appointments';
  protected static $dbColumns = [
    'id',
    'date',
    'time',
    'user_id',
  ];

  public $id;
  public $date;
  public $time;
  public $user_id;

  public function __construct($args = [])
  {
    $this->id = $args['id'] ?? null;
    $this->date = $args['date'] ?? '';
    $this->time = $args['time'] ?? '';
    $this->user_id = $args['user_id'] ?? '';
  }
}
