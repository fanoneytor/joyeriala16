<?php include 'config.php'; ?>
<h2>Registro de Usuario</h2>
<form method="POST" action="">
    Nombre: <input type="text" name="name" required><br>
    Email: <input type="email" name="email" required><br>
    Teléfono: <input type="text" name="phone"><br>
    Contraseña: <input type="password" name="password" required><br>
    Rol: 
    <select name="role">
        <option value="1">Admin</option>
        <option value="2">Client</option>
    </select><br>
    <button type="submit" name="register">Registrar</button>
</form>

<?php
if (isset($_POST['register'])) {
    $name  = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    $sql = "INSERT INTO users (name, email, phone, password, role_id) 
            VALUES ('$name','$email','$phone','$password','$role')";

    if ($conn->query($sql) === TRUE) {
        echo "Usuario registrado con éxito. <a href='login.php'>Iniciar sesión</a>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
