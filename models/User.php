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
    $this->is_admin = $args['is_admin'] ?? '0';
    $this->is_confirmed = $args['is_confirmed'] ?? '0';
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

  public function checkIfUserExists()
  {
    $query = "SELECT * FROM " . self::$table . " WHERE email = '$this->email' LIMIT 1";
    $result = self::$db->query($query);

    if ($result->num_rows) self::$alerts['error'][] = 'El usuario ya está registrado';

    return $result;
  }

  public function hashPassword()
  {
    $this->password = password_hash($this->password, PASSWORD_BCRYPT);
  }

  public function createToken()
  {
    // $this->token = bin2hex(random_bytes(32));
    $this->token = uniqid();
  }

  public function loginValidation()
  {
    if (empty($this->email)) self::$alerts['error'][] = 'El correo electrónico es obligatorio';
    if (empty($this->password)) self::$alerts['error'][] = 'La contraseña es obligatoria';

    return self::$alerts;
  }

  public function loginChecks($password)
  {
    $result = $this->checkPassword($password);

    if (!$result || !$this->is_confirmed) {
      self::$alerts['error'][] = 'La contraseña es incorrecta o la cuenta no ha sido verificada';
    } else {
      return true;
    }
  }

  private function checkPassword($password)
  {
    $result = password_verify($password, $this->password);

    return $result;
  }
}
