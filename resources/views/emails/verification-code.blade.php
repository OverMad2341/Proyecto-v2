<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Código de Verificación</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6;">
    <div style="max-width: 600px; margin: 20px auto; padding: 20px; border: 1px solid #ddd; border-radius: 5px;">
        <h2 style="text-align: center; color: #333;">¡Hola!</h2>
        <p>Gracias por registrarte. Tu código de verificación es:</p>
        <div style="font-size: 36px; font-weight: bold; text-align: center; margin: 30px 0; letter-spacing: 5px; color: #000;">
            {{ $code }}
        </div>
        <p>Este código expirará en 15 minutos.</p>
        <p>Si no te registraste, por favor ignora este correo.</p>
    </div>
</body>
</html>