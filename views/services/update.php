<?php
include_once __DIR__ . '/../templates/top-bar.php';
include_once __DIR__ . '/../templates/alerts.php';
?>

<h1 class="pageName">Actualizar Servicio</h1>
<p class="pageDescription">Modifica los valores del formulario</p>

<form method="POST" class="form">
  <?php include_once __DIR__ . '/form.php'; ?>

  <input type="submit" class="btn" value="Actualizar Servicio">
</form>