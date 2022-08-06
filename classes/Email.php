<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email
{
  public $email;
  public $name;
  public $token;

  public function __construct($email, $name, $token)
  {
    $this->email = $email;
    $this->name = $name;
    $this->token = $token;
  }

  public function sendConfirmationEmail()
  {
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host =   $_ENV['EMAIL_HOST'];
    $mail->SMTPAuth = $_ENV['EMAIL_SMTPAUTH'];
    $mail->Port = $_ENV['EMAIL_PORT'];
    $mail->Username = $_ENV['EMAIL_USERNAME'];
    $mail->Password = $_ENV['EMAIL_PASSWORD'];

    $mail->setFrom($_ENV['EMAIL_FROM_ADDRESS']);
    $mail->addAddress('test@user.com', 'AppSalon.com');
    $mail->Subject = 'Confirma tu cuenta';
    $mail->isHTML(true);
    $mail->CharSet = 'UTF-8';

    $mailContent = '
      <html>
        <p><strong>Hola ' . $this->name . '</strong>, has creado tu cuenta en AppSalon, solo debes confirmarla presionando el siguiente enlace:</p>
        <p><a href="http://localhost:3000/confirmar-cuenta?token=' . $this->token . '">Confirmar Cuenta</a></p>
        <p>Si no has solicitado esta cuenta, puedes ignorar este mensaje.</p>
      </html>
    ';

    $mail->Body = $mailContent;
    $mail->send();
  }
}
