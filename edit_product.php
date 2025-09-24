<?php
session_start();
include 'config.php';

// Verificar si es Admin
if ($_SESSION['role'] != 1) {
    echo "Acceso denegado.";
    exit();
}

// Obtener producto por ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM products WHERE id=$id";
    $result = $conn->query($sql);
    $product = $result->fetch_assoc();
}

// Guardar cambios
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $category = $_POST['category'];
    $unit_cost = $_POST['unit_cost'];
    $quantity = $_POST['quantity'];

    $sql = "UPDATE products 
            SET name='$name', category='$category', unit_cost='$unit_cost', quantity='$quantity'
            WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Producto actualizado. <a href='home.php'>Volver</a>";
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<h2>Editar Producto</h2>
<form method="POST" action="">
    <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
    Nombre: <input type="text" name="name" value="<?php echo $product['name']; ?>" required><br>
    Categoría: <input type="text" name="category" value="<?php echo $product['category']; ?>" required><br>
    Costo Unitario: <input type="number" step="0.01" name="unit_cost" v_
