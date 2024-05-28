<?php
// Incluir archivos necesarios
include_once 'Conexion.php';
include_once 'user.php';

// Obtener conexión a la base de datos
$database = new Database();
$db = $database->getConnection();

// Inicializar objeto Usuario
$user = new User($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];

    // Intentar iniciar sesión
    if ($user->login($correo, $contraseña)) {
        $_SESSION['nombre'] = $user->nombre;
        $_SESSION['apellido'] = $user->apellido;
        header("Location: contenido.php");
        exit();
    } else {
        echo "
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error de autenticación',
                    text: 'Correo o contraseña incorrectos.'
                }).then(() => {
                    window.location.href = 'index.php';
                });
            </script>
        ";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function validateForm(event) {
            event.preventDefault(); // Prevenir el envío del formulario

            const correo = document.getElementById('correo').value;
            const contraseña = document.getElementById('contraseña').value;

            const correoRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (!correoRegex.test(correo)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error de validación',
                    text: 'El correo no tiene un formato válido.'
                });
                return;
            }

            if (contraseña.length < 8) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error de validación',
                    text: 'La contraseña debe tener al menos 8 caracteres.'
                });
                return;
            }

            document.getElementById('loginForm').submit(); // Enviar el formulario si es válido
        }
    </script>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-image: url('css/images/fondo.jpg'); 
            background-size: cover; 
            background-position: center; 
            height: 100vh; 
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-box {
            width: 300px;
            padding: 60px;
            background: rgba(255, 255, 255, 0.7); /
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        .login-box h2 {
            text-align: center;
        }

        .login-box input[type="email"],
        .login-box input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: none;
            border-radius: 5px;
        }

        .login-box input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #A22929;
            color: white;
            cursor: pointer;
        }
    </style>
</head>
<style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        #logo {
            position: fixed; 
            top: 10px; 
            left: 100px; 
            width: 250px; 
            height: auto; 
            z-index: 9999; 
    </style>
</head>
<body>
    <img id="logo" src="css/images/logo2.png" alt="Logo de la empresa">
</body>
</html>
<body>
    <div class="login-box">
        <h2>Iniciar Sesión</h2>
        <form id="loginForm" action="index.php" method="post" onsubmit="validateForm(event)">
            <input type="email" id="correo" name="correo" placeholder="Correo" required>
            <input type="password" id="contraseña" name="contraseña" placeholder="Contraseña" required>
            <input type="submit" value="Iniciar Sesión">
        </form>

    </div>
</body>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página con Botón "Registrarse"</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        .container {
            position: relative;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .register-button {
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 999;
            background-color: #A22929;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <a href="registro.php" class="register-button">Suscribirse</a>
</body>
</html>

</html>
