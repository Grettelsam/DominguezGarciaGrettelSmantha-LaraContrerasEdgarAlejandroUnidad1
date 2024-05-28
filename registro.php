<?php
// Incluir archivos necesarios
include_once 'Conexion.php';
include_once 'user.php';

// Obtener conexión a la base de datos
$database = new Database();
$db = $database->getConnection();

// Inicializar objeto Usuario
$user = new User($db);

// Variable para almacenar mensajes de SweetAlert
$sweetalert = '';

// Verificar si se recibió una solicitud de registro
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar campos
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];

    $nombreValido = preg_match("/^[a-zA-Z\s]+$/", $nombre);
    $apellidoValido = preg_match("/^[a-zA-Z\s]+$/", $apellido);
    $correoValido = filter_var($correo, FILTER_VALIDATE_EMAIL);
    $contraseñaValida = strlen($contraseña) >= 8;

    if (!$nombreValido || !$apellidoValido) {
        $sweetalert = "
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error de validación',
                    text: 'El nombre y el apellido no deben contener números ni caracteres especiales.'
                });
            </script>
        ";
    } elseif (!$correoValido) {
        $sweetalert = "
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error de validación',
                    text: 'El correo no tiene un formato válido.'
                });
            </script>
        ";
    } elseif (!$contraseñaValida) {
        $sweetalert = "
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error de validación',
                    text: 'La contraseña debe tener al menos 8 caracteres.'
                });
            </script>
        ";
    } else {
        // Establecer valores de las propiedades del usuario
        $user->nombre = $nombre;
        $user->apellido = $apellido;
        $user->correo = $correo;
        $user->contraseña = $contraseña;

        // Registrar usuario
        if ($user->register()) {
            $sweetalert = "
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Registro Exitoso',
                        text: 'Usuario registrado exitosamente.'
                    });
                </script>
            ";
        } else {
            $sweetalert = "
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Ocurrió un error al registrar el usuario.'
                    });
                </script>
            ";
        }
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

            const nombre = document.getElementById('nombre').value;
            const apellido = document.getElementById('apellido').value;
            const correo = document.getElementById('correo').value;
            const contraseña = document.getElementById('contraseña').value;

            const nombreRegex = /^[a-zA-Z\s]+$/;
            const apellidoRegex = /^[a-zA-Z\s]+$/;
            const correoRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            const contraseñaMinLength = 8;

            if (!nombreRegex.test(nombre)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error de validación',
                    text: 'El nombre no debe contener números ni caracteres especiales.'
                });
                return;
            }

            if (!apellidoRegex.test(apellido)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error de validación',
                    text: 'El apellido no debe contener números ni caracteres especiales.'
                });
                return;
            }

            if (!correoRegex.test(correo)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error de validación',
                    text: 'El correo no tiene un formato válido.'
                });
                return;
            }

            if (contraseña.length < contraseñaMinLength) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error de validación',
                    text: 'La contraseña debe tener al menos 8 caracteres.'
                });
                return;
            }

            document.getElementById('registerForm').submit(); // Enviar el formulario si es válido
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

        .login-box input[type="text"],
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
    
    <?php
    // Mostrar alerta de SweetAlert si está definida
    if (!empty($sweetalert)) {
        echo $sweetalert;
    }
    ?>

    <div class="login-box">
        <h2>Registro</h2>
        <form id="registerForm" action="registro.php" method="post" onsubmit="validateForm(event)">
            <input type="text" id="nombre" name="nombre" placeholder="Nombres" required>
            <input type="text" id="apellido" name="apellido" placeholder="Apellidos" required>
            <input type="text" id="correo" name="correo" placeholder="Correo" required>
            <input type="password" id="contraseña" name="contraseña" placeholder="Contraseña" required>
            <input type="submit" value="Registrarse">
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
    <a href="index.php" class="register-button">Iniciar Sesion</a>
</body>
</html>
</html>
