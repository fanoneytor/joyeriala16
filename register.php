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

            <label for="role">Rol:</label>
            <select id="role" name="role">
                <option value="1">Admin</option>
                <option value="2">Client</option>
            </select><br>

            <button type="submit" name="register">Registrar</button>
        </form>

        <?php
        if (isset($_POST['register'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $role = $_POST['role'];

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