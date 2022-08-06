<h1 class="pageName">Crear Cuenta</h1>
<p class="pageDescription">Llena el siguiente formulario para crear una cuenta</p>

<?php
include_once __DIR__ . '/../templates/alerts.php';
?>

<form method="POST" class="form">
  <div class="field">
    <label for="name">Nombre</label>
    <input type="text" id="name" name="firstname" placeholder="Luis" value="<?php echo s($user->firstname); ?>">
  </div>

  <div class="field">
    <label for="lastname">Apellido</label>
    <input type="text" id="lastname" name="lastname" placeholder="Lara" value="<?php echo s($user->lastname); ?>">
  </div>

  <div class="field">
    <label for="phone">Teléfono</label>
    <input type="tel" id="phone" name="phone" placeholder="5522339964" value="<?php echo s($user->phone); ?>">
  </div>

  <div class="field">
    <label for="email">Correo Electrónico</label>
    <input type="email" id="email" name="email" placeholder="correo@correo.com" value="<?php echo s($user->email); ?>">
  </div>

  <div class="field">
    <label for="password">Contraseña</label>
    <input type="password" id="password" name="password" placeholder="contraseña" value="<?php echo s($user->password); ?>">
  </div>

  <input type="submit" class="btn" value="Crear Cuenta">
</form>

<div class="actions">
  <a href="/">¿Ya tienes una cuenta? Inicia Sesión</a>
  <a href="/olvide">¿Olvidaste tu contraseña?</a>
</div>