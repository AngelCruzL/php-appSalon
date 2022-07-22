<h1 class="pageName">Crear Cuenta</h1>
<p class="pageDescription">Llena el siguiente formulario para crear una cuenta</p>

<form method="POST" class="form">
  <div class="field">
    <label for="name">Nombre</label>
    <input type="text" id="name" name="name" placeholder="Luis">
  </div>

  <div class="field">
    <label for="lastname">Apellido</label>
    <input type="text" id="lastname" name="lastname" placeholder="Lara">
  </div>

  <div class="field">
    <label for="phone">Teléfono</label>
    <input type="tel" id="phone" name="phone" placeholder="5522339964">
  </div>

  <div class="field">
    <label for="email">Correo Electrónico</label>
    <input type="email" id="email" name="email" placeholder="correo@correo.com">
  </div>

  <div class="field">
    <label for="password">Contraseña</label>
    <input type="password" id="password" name="password" placeholder="contraseña">
  </div>

  <input type="submit" class="btn" value="Crear Cuenta">
</form>

<div class="actions">
  <a href="/">¿Ya tienes una cuenta? Inicia Sesión</a>
  <a href="/olvide">¿Olvidaste tu contraseña?</a>
</div>