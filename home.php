<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

echo "<h1>Bienvenido a la Joyería</h1>";

if ($_SESSION['role'] == 1) {
    echo "<a href='add_product.php'>Agregar Producto</a><br>";
    echo "<a href='logout.php'>Cerrar sesión</a><br><br>";
} else {
    echo "<p>Solo lectura (Cliente)</p>";
    echo "<a href='logout.php'>Cerrar sesión</a><br><br>";
}

$sql = "SELECT * FROM products";
$result = $conn->query($sql);

echo "<table border='1'>
<tr><th>Nombre</th><th>Categoría</th><th>Costo</th><th>Cantidad</th>";

if ($_SESSION['role'] == 1) {
    echo "<th>Acciones</th>";
}
echo "</tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>
        <td>{$row['name']}</td>
        <td>{$row['category']}</td>
        <td>{$row['unit_cost']}</td>
        <td>{$row['quantity']}</td>";

    if ($_SESSION['role'] == 1) {
        echo "<td>
            <a href='edit_product.php?id={$row['id']}'>Editar</a> |
            <a href='delete_product.php?id={$row['id']}'>Eliminar</a>
        </td>";
    }
    echo "</tr>";
}
echo "</table>";
?>
