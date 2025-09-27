<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cerrando Sesión</title>
    <link rel="stylesheet" href="static/style.css">
</head>
<body>
    <div class="container">
        <?php
        session_start();
        session_destroy();
        header("Location: login.php");
        exit();
        ?>
        <p>Cerrando sesión...</p>
    </div>
</body>
</html>
