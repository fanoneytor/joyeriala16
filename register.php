<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <?php include 'config.php'; ?>
        <h2>Registro de Usuario</h2>
        <form method="POST" action="">
            <label for="name">Nombre:</label>
            <input type="text" id="name" name="name" required><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br>

            <label for="phone">Teléfono:</label>
            <input type="text" id="phone" name="phone"><br>

            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required><br>

            

            <button type="submit" name="register">Registrar</button>
        </form>
        <p>¿Ya tienes cuenta? <a href="login.php">Inicia sesión aquí</a></p>
        <p><a href="javascript:history.back()">Volver</a></p>

        <?php
        if (isset($_POST['register'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $role = 2; // Always assign Client role

            $stmt = $conn->prepare("INSERT INTO users (name, email, phone, password, role_id) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssi", $name, $email, $phone, $password, $role);

            if ($stmt->execute() === TRUE) {
                echo "<p>Usuario registrado con éxito. <a href='login.php'>Iniciar sesión</a></p>";
                $stmt->close();
            } else {
                echo "<p class=\"error\">Error: " . $conn->error . "</p>";
            }
        }
        ?>
    </div>
</body>

</html>