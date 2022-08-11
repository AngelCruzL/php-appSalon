<?php

namespace Model;

class Service extends ActiveRecord
{
  protected static $table = 'services';
  protected static $dbColumns = [
    'id',
    'name',
    'price'
  ];

  public $id;
  public $name;
  public $price;

  public function __construct($args = [])
  {
    $this->id = $args['id'] ?? null;
    $this->name = $args['name'] ?? '';
    $this->price = $args['price'] ?? '';
  }

  public function validateService()
  {
    if (empty($this->name)) self::$alerts['error'][] = 'El nombre del servicio es obligatorio';
    if (empty($this->price)) self::$alerts['error'][] = 'El precio del servicio es obligatorio';
    if (!is_numeric($this->price)) self::$alerts['error'][] = 'El precio debe ser un número';

    return self::$alerts;
  }
}
