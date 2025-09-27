<?php
$servername = "sql213.infinityfree.com";
$username   = "if0_40011441";
$password   = "Joyeria123654";
$dbname     = "if0_40011441_joyeria_la_16";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
