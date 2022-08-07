<h1 class="pageName">Recuperar Contraseña</h1>
<p class="pageDescription">Coloca tu nueva contraseña a continuación</p>

<?php include_once __DIR__ . '/../templates/alerts.php'; ?>

<?php if ($error) return; ?>
<form method="POST" class="form">
  <div class="formField">
    <label for="password">Nueva Contraseña</label>
    <input type="password" id="password" name="password" placeholder="Nueva contraseña">
  </div>

  <input type="submit" value="Guardar nueva contraseña" class="btn">
</form>

<div class="actions">
  <a href="/">¿Ya tienes una cuenta? Inicia Sesión</a>
  <a href="/crear-cuenta">¿Aún no tienes cuenta? Crear una</a>
</div>