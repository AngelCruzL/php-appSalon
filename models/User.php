<?php

use Model\ActiveRecord;

class User extends ActiveRecord
{
  public static $table = 'users';
  public static $dbColumns = [
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
}
