<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Pago</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h2>Detalles de Pago</h2>
        <form action="procesar_pago.php" method="POST" class="payment-form">
            <div class="form-group">
                <label for="nombre">Nombre en la Tarjeta:</label><br>
                <input type="text" id="nombre" name="nombre" class="input-field" required>
            </div>
            <div class="form-group">
                <label for="numero-tarjeta">Número de Tarjeta:</label><br>
                <input type="text" id="numero-tarjeta" name="numero-tarjeta" class="input-field" required>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="fecha-expiracion">Fecha de Expiración:</label><br>
                    <input type="text" id="fecha-expiracion" name="fecha-expiracion" placeholder="MM/AA" class="input-field" required>
                </div>
                <div class="form-group">
                    <label for="cvv">CVV:</label><br>
                    <input type="text" id="cvv" name="cvv" class="input-field" required>
                </div>
            </div>
            <div class="form-group">
                <label for="tipo-tarjeta">Tipo de Tarjeta:</label><br>
                <select id="tipo-tarjeta" name="tipo-tarjeta" class="input-field" required>
                    <option value="visa">Visa</option>
                    <option value="mastercard">Mastercard</option>
                    <option value="amex">American Express</option>
                </select>
            </div>
            <button type="submit" class="pay-btn">Pagar</button>
        </form>
    </div>
</body>
</html>
