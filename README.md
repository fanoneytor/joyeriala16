# Joyeria la 16

Este es un sistema web básico para la gestión de productos de una joyería, con funcionalidades de autenticación de usuarios y roles (Administrador y Cliente).

## Configuración de la Base de Datos

Para que la aplicación funcione correctamente, necesitas configurar una base de datos MySQL.

1.  **Crear la Base de Datos:**
    Crea una base de datos con el nombre `if0_40011441_joyeria_la_16`. Puedes usar phpMyAdmin o la línea de comandos de MySQL.

2.  **Crear Tablas:**
    Ejecuta las siguientes sentencias SQL para crear las tablas `users` y `products`:

    ```sql
    CREATE DATABASE IF NOT EXISTS `if0_40011441_joyeria_la_16`;
    USE `if0_40011441_joyeria_la_16`;

    CREATE TABLE IF NOT EXISTS `users` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `name` VARCHAR(255) NOT NULL,
        `email` VARCHAR(255) NOT NULL UNIQUE,
        `phone` VARCHAR(20),
        `password` VARCHAR(255) NOT NULL,
        `role_id` INT NOT NULL DEFAULT 2 -- 1 para Admin, 2 para Cliente
    );

    CREATE TABLE IF NOT EXISTS `products` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `name` VARCHAR(255) NOT NULL,
        `category` VARCHAR(255) NOT NULL,
        `unit_cost` DECIMAL(10, 2) NOT NULL,
        `quantity` INT NOT NULL
    );

    -- Opcional: Insertar un usuario administrador por defecto (contraseña: admin123)
    -- Para generar el hash de la contraseña 'admin123', puedes usar el siguiente código PHP:
    -- <?php echo password_hash('admin123', PASSWORD_DEFAULT); ?>
    -- Luego, reemplaza el hash en la siguiente línea:
    -- INSERT INTO `users` (`name`, `email`, `phone`, `password`, `role_id`) VALUES ('Admin User', 'admin@example.com', '123456789', 'HASH_GENERADO_PARA_ADMIN123', 1);
    ```

3.  **Actualizar `config.php`:**
    Asegúrate de que los detalles de conexión en `config.php` coincidan con tu configuración de base de datos local.

    ```php
    <?php
    $servername = "localhost"; // O la dirección de tu servidor de base de datos
    $username   = "tu_usuario";
    $password   = "tu_contraseña";
    $dbname     = "if0_40011441_joyeria_la_16";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }
    ?>
    ```

## Uso

1.  Sube todos los archivos a tu servidor web (por ejemplo, Apache con PHP).
2.  Abre `index.php` en tu navegador.
3.  Regístrate como un nuevo usuario. Si deseas un usuario administrador, puedes modificar el `role_id` directamente en la base de datos o usar la opción de rol durante el registro (aunque esto es una vulnerabilidad de seguridad en un entorno real).
4.  Inicia sesión para acceder a la funcionalidad del sistema.