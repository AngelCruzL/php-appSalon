<?php

namespace Model;

class User extends ActiveRecord
{
  protected static $table = 'users';
  protected static $dbColumns = [
    'id',
    'firstname',
    'lastname',
    'email',
    'password',
    'phone',
    'is_admin',
    'is_confirmed',
    'token'
  ];

  public $id;
  public $firstname;
  public $lastname;
  public $email;
  public $password;
  public $phone;
  public $is_admin;
  public $is_confirmed;
  public $token;

  public function __construct($args = [])
  {
    $this->id = $args['id'] ?? null;
    $this->firstname = $args['firstname'] ?? '';
    $this->lastname = $args['lastname'] ?? '';
    $this->email = $args['email'] ?? '';
    $this->password = $args['password'] ?? '';
    $this->phone = $args['phone'] ?? '';
    $this->is_admin = $args['is_admin'] ?? null;
    $this->is_confirmed = $args['is_confirmed'] ?? null;
    $this->token = $args['token'] ?? '';
  }

  public function validateNewAccount()
  {
    if (empty($this->firstname)) self::$alerts['error'][] = 'El nombre es obligatorio';
    if (empty($this->lastname)) self::$alerts['error'][] = 'El apellido es obligatorio';
    if (empty($this->email)) self::$alerts['error'][] = 'El correo electrónico es obligatorio';
    if (empty($this->password)) self::$alerts['error'][] = 'La contraseña es obligatoria';
    if (strlen($this->password) < 8) self::$alerts['error'][] = 'La contraseña debe tener al menos 8 caracteres';
    if (empty($this->phone)) self::$alerts['error'][] = 'El teléfono es obligatorio';

    return self::$alerts;
  }
}