<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planes de Mensualidades</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<style>
body {
  margin: 0;
  padding: 0;
  font-family: Arial, sans-serif;
  background-image: url('css/images/fondo2.jpg');
  background-size: cover;
  background-position: center;
  height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
}

.container {
  border: 2px solid red; /* Add a red outline to the container div */
}

#logo {
  position: fixed;
  top: 10px;
  left: 100px;
  width: 250px;
  height: auto;
  z-index: 9999;
}

.plan {
  border: 1px solid red; /* Add a red outline to each plan div */
  padding: 10px;
  margin: 10px;
}
</style>

</head>
<body>
    <img id="logo" src="css/images/logo2.png" alt="Logo de la empresa">
</body>
</body>
</style>
<body>
    <div class="container">
        <div class="plan">
            <h1>Plan Básico</h1>
            <p class="price">$9.99/mes</p>
            <ul>
                <li>Acceso a contenido estándar</li>
                <li>1 dispositivo</li>
                <li>Sin HD</li>
            </ul>
             <a href="contenido.php" class="register-button">Seleccionar</a>
        </div>
        <div class="plan">
            <h1>Plan Estándar</h1>
            <p class="price">$12.99/mes</p>
            <ul>
                <li>Acceso a contenido HD</li>
                <li>2 dispositivos</li>
                <li>Sin Ultra HD</li>
            </ul>
            <a href="contenido.php" class="register-button">Seleccionar</a>
        </div> 
        <div class="plan">
            <h1>Plan Premium</h1>
            <p class="price">$15.99/mes</p>
            <ul>
                <li>Acceso a contenido Ultra HD</li>
                <li>4 dispositivos</li>
                <li>Descargas disponibles</li>
            </ul>           
    <a href="contenido.php" class="register-button">Seleccionar</a>
    </div>
</body>
</html>
