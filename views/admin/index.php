<?php include_once __DIR__ . '/../templates/top-bar.php'; ?>

<h1 class="pageName">Panel de Administración</h1>

<h2>Buscar Citas</h2>

<div class="search">
  <form class="form mb-3" method="POST">
    <div class="formField">
      <label for="date">Fecha</label>
      <input type="date" id="date" name="date" value="<?php echo $currentDate; ?>">
    </div>
    <input type="submit" class="btn" value="Buscar">
  </form>
</div>

<?php if (empty($appointments)) : ?>
  <h2 class="mt-4">No hay citas para la fecha seleccionada</h2>
<?php endif; ?>

<div id="adminAppointments">
  <ul class="appointment">
    <?php
    $appointmentId = 0;
    foreach ($appointments as $key => $appointment) :
      if ($appointmentId !== $appointment->id) :
        $total = 0;
    ?>
        <li>
          <h3>Cliente</h3>
          <p><span><?php echo $appointment->client ?></span></p>
          <p>ID: <span><?php echo $appointment->id; ?></span></p>
          <p>Hora: <span><?php echo $appointment->time; ?></span></p>
          <p>Correo Electrónico: <span><?php echo $appointment->email; ?></span></p>
          <p>Teléfono: <span><?php echo $appointment->phone; ?></span></p>
          <h3 class="mt-2">Servicios</h3>
        <?php
        $appointmentId = $appointment->id;
      endif;
      $total += $appointment->price;
        ?>
        <p class="appointmentService"><?php echo $appointment->service . ' $' . $appointment->price; ?></p>
        <?php
        $currentAppointment = $appointment->id;
        $nextAppointment = $appointments[$key + 1]->id ?? 0;

        if (isTheLastElement($currentAppointment, $nextAppointment)) :
        ?>
          <p class="total">Total: <span>$<?php echo $total; ?></span></p>

          <form action="/api/eliminar" method="POST">
            <input type="hidden" name="appointmentId" value="<?php echo $appointment->id; ?>">
            <input type="submit" value="Eliminar cita" class="btnDelete">
          </form>
      <?php
        endif;
      endforeach;
      ?>
        </li>
  </ul>
</div>