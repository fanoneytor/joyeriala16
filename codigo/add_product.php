<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Producto</title>
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

        if (isset($_POST['save'])) {
            $name = $_POST['name'];
            $category = $_POST['category'];
            $unit_cost = $_POST['unit_cost'];
            $quantity = $_POST['quantity'];

            $stmt = $conn->prepare("INSERT INTO products (name, category, unit_cost, quantity) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssdi", $name, $category, $unit_cost, $quantity);
            if ($stmt->execute() === TRUE) {
                echo "Producto agregado. <a href='home.php'>Volver</a>";
                $stmt->close();
                exit();
            } else {
                echo "Error: " . $conn->error;
            }
        }
        ?>

        <h2>Agregar Producto</h2>
        <form method="POST" action="">
            <label for="name">Nombre:</label>
            <input type="text" id="name" name="name" required><br>

            <label for="category">Categoría:</label>
            <input type="text" id="category" name="category" required><br>

            <label for="unit_cost">Costo Unitario:</label>
            <input type="number" step="0.01" id="unit_cost" name="unit_cost" required><br>

            <label for="quantity">Cantidad:</label>
            <input type="number" id="quantity" name="quantity" required><br>

            <button type="submit" name="save">Guardar</button>
        </form>
        <p><a href="javascript:history.back()">Volver</a></p>
    </div>
</body>
</html>
