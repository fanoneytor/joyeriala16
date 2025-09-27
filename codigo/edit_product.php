<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <link rel="stylesheet" href="static/style.css">
</head>
<body>
    <div class="container">
        <?php
        session_start();
        include 'config.php';

        // Verificar si es Admin
        if ($_SESSION['role'] != 1) {
            echo "Acceso denegado.";
            exit();
        }

        $product = null;
        // Obtener producto por ID
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $stmt = $conn->prepare("SELECT * FROM products WHERE id=?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $product = $result->fetch_assoc();
            $stmt->close();
        }

        // Guardar cambios
        if (isset($_POST['update'])) {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $category = $_POST['category'];
            $unit_cost = $_POST['unit_cost'];
            $quantity = $_POST['quantity'];

            $stmt = $conn->prepare("UPDATE products SET name=?, category=?, unit_cost=?, quantity=? WHERE id=?");
            $stmt->bind_param("ssdii", $name, $category, $unit_cost, $quantity, $id);

            if ($stmt->execute() === TRUE) {
                echo "Producto actualizado. <a href='home.php'>Volver</a>";
                $stmt->close();
                exit();
            } else {
                echo "Error: " . $conn->error;
            }
        }
        ?>

        <h2>Editar Producto</h2>
        <?php if ($product): ?>
            <form method="POST" action="">
                <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                <label for="name">Nombre:</label>
                <input type="text" id="name" name="name" value="<?php echo $product['name']; ?>" required><br>

                <label for="category">Categoría:</label>
                <input type="text" id="category" name="category" value="<?php echo $product['category']; ?>" required><br>

                <label for="unit_cost">Costo Unitario:</label>
                <input type="number" step="0.01" id="unit_cost" name="unit_cost" value="<?php echo $product['unit_cost']; ?>" required><br>

                <label for="quantity">Cantidad:</label>
                <input type="number" id="quantity" name="quantity" value="<?php echo $product['quantity']; ?>" required><br>

                <button type="submit" name="update">Actualizar</button>
            </form>
            <p><a href="javascript:history.back()">Volver</a></p>
        <?php else: ?>
            <p>Producto no encontrado.</p>
        <?php endif; ?>
    </div>
</body>
</html>
