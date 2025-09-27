<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Producto</title>
    <link rel="stylesheet" href="static/style.css">
</head>
<body>
    <div class="container">
        <?php
        session_start();
        include 'config.php';

        if ($_SESSION['role'] != 1) {
            echo "Acceso denegado.";
            exit();
        }

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $stmt = $conn->prepare("DELETE FROM products WHERE id=?");
            $stmt->bind_param("i", $id);

            if ($stmt->execute() === TRUE) {
                echo "Producto eliminado. <a href='home.php'>Volver</a>";
                $stmt->close();
                exit();
            } else {
                echo "Error: " . $conn->error;
            }
        } else {
            echo "ID de producto no especificado.";
        }
        echo "<p><a href=\"javascript:history.back()\">Volver</a></p>";
        ?>
    </div>
</body>
</html>
