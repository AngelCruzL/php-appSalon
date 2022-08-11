<div class="topBar textCenter">
  <p>Hola <strong><?php echo $name; ?></strong></p>
  <a class="btn" href="/logout">Cerrar sesión</a>
</div>

<?php if (isset($_SESSION['isAdmin'])) : ?>
  <div class="topBar-services">
    <a class="btn" href="/admin">Ver Citas</a>
    <a class="btn" href="/servicios">Ver Servicios</a>
    <a class="btn" href="/servicios/crear">Nuevo Servicio</a>
  </div>
<?php endif; ?>