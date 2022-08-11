<?php
include_once __DIR__ . '/../templates/top-bar.php';
include_once __DIR__ . '/../templates/alerts.php';
?>

<h1 class="pageName">Nuevo Servicio</h1>
<p class="pageDescription">Llena todos los campos para agregar un nuevo servicio</p>

<form method="POST" class="form">
  <?php include_once __DIR__ . '/form.php'; ?>

  <input type="submit" class="btn" value="Guardar Servicio">
</form>