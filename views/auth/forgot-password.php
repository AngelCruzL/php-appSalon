<h1 class="pageName">Olvide mi Contraseña</h1>
<p class="pageDescription">Restablece tu contraseña escribiendo tu email a continuación</p>

<?php include_once __DIR__ . '/../templates/alerts.php'; ?>

<form method="POST" class="form">
  <div class="field">
    <label for="email">Correo electrónico</label>
    <input type="email" name="email" id="email" placeholder="correo@correo.com" />
  </div>

  <input type="submit" class="btn" value="Enviar Instrucciones" />
</form>

<div class="actions">
  <a href="/">¿Ya tienes una cuenta? Inicia Sesión</a>
  <a href="/crear-cuenta">¿Aún no tienes cuenta? Crear una</a>
</div>