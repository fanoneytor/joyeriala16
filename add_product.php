<?php
session_start();
include 'config.php';

if ($_SESSION['role'] != 1) {
    echo "Acceso denegado.";
    exit();
}

if (isset($_POST['save'])) {
    $name = $_POST['name'];
    $category = $_POST['category'];
    $unit_cost = $_POST['unit_cost'];
    $quantity = $_POST['quantity'];

    $sql = "INSERT INTO products (name, category, unit_cost, quantity) 
            VALUES ('$name','$category','$unit_cost','$quantity')";
    if ($conn->query($sql) === TRUE) {
        echo "Producto agregado. <a href='home.php'>Volver</a>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<h2>Agregar Producto</h2>
<form method="POST" action="">
    Nombre: <input type="text" name="name" required><br>
    Categoría: <input type="text" name="category" required><br>
    Costo Unitario: <input type="number" step="0.01" name="unit_cost" required><br>
    Cantidad: <input type="number" name="quantity" required><br>
    <button type="submit" name="save">Guardar</button>
</form>
