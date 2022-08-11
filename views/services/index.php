<?php include_once __DIR__ . '/../templates/top-bar.php'; ?>

<h1 class="pageName">Servicios</h1>
<p class="pageDescription">Administración de Servicios</p>

<ul class="services">
  <?php foreach ($services as $service) : ?>
    <li>
      <p>Nombre: <span><?php echo $service->name; ?></span></p>
      <p>Precio: <span>$<?php echo $service->price; ?></span></p>

      <div class="actions">
        <a class="btn" href="/servicios/actualizar?id=<?php echo $service->id; ?>">Actualizar</a>
        <form action="/servicios/eliminar" method="POST">
          <input type="hidden" name="id" value="<?php echo $service->id; ?>">
          <input type="submit" class="btnDelete" value="Borrar">
        </form>
      </div>
    </li>
  <?php endforeach; ?>
</ul>