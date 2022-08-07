<h1 class="pageName">Login</h1>
<p class="pageDescription">Inicia sesión con tus datos</p>

<?php include_once __DIR__ . '/../templates/alerts.php'; ?>

<form method="POST" class="form">
  <div class="formField">
    <label for="email">Correo electrónico</label>
    <input type="email" name="email" id="email" placeholder="correo@correo.com">
  </div>

  <div class="formField">
    <label for="password">Contraseña</label>
    <input type="password" name="password" id="password" placeholder="contraseña">
  </div>

  <input type="submit" class="btn" value="Iniciar Sesión">
</form>

<div class="actions">
  <a href="/crear-cuenta">¿Aún no tienes cuenta? Crear una</a>
  <a href="/olvide">¿Olvidaste tu contraseña?</a>
</div>