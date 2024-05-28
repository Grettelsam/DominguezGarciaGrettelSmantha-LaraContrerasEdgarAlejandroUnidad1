<?php
session_start();

// Función para generar un texto aleatorio para el CAPTCHA
function generate_captcha_text($length = 6) {
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $captcha_text = '';
    for ($i = 0; $i < $length; $i++) {
        $captcha_text .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $captcha_text;
}

// Generar texto CAPTCHA y almacenarlo en la sesión
$captcha_text = generate_captcha_text();
$_SESSION['captcha'] = $captcha_text;
?>