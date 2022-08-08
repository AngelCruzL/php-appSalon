<h1 class="pageName">Crear Nueva Cita</h1>
<p class="pageDescription">Elige tus servicios y coloca tus datos</p>

<div id="app">
  <nav class="tabs mb-4">
    <button type="button" data-step="1">Servicios</button>
    <button type="button" data-step="2">Información de la cita</button>
    <button type="button" data-step="3">Resumen</button>
  </nav>

  <div>
    <div id="step-1" class="section">
      <h2>Servicios</h2>
      <p class="textCenter">Elige tus servicios a continuación</p>
      <div id="services" class="servicesList"></div>
    </div>

    <div id="step-2" class="section">
      <h2>Tus Datos y Cita</h2>
      <p class="textCenter">Coloca tus datos y fecha de tu cita</p>

      <form class="form">
        <div class="formField">

          <label for="name">Nombre</label>
          <input type="text" id="name" value="<?php echo $name; ?>" disabled>
        </div>

        <div class="formField">
          <label for="date">Fecha</label>
          <input type="date" id="date">
        </div>

        <div class="formField">
          <label for="hour">Hora</label>
          <input type="time" id="hour">
        </div>
      </form>
    </div>

    <div id="step-3" class="section">
      <h2>Resumen</h2>
      <p class="textCenter">Verifica que la información sea correcta</p>
    </div>
  </div>

  <div class="paginator">
    <button type="button" id="prevItem" class="btn">&laquo; Anterior</button>
    <button type="button" id="nextItem" class="btn">Siguiente &raquo;</button>
  </div>
</div>

<?php $script = '
  <script src="build/js/app.js"></script>
'; ?>