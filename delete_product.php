<?php
session_start();
include 'config.php';

if ($_SESSION['role'] != 1) {
    echo "Acceso denegado.";
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM products WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Producto eliminado. <a href='home.php'>Volver</a>";
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "ID de producto no especificado.";
}
?>
