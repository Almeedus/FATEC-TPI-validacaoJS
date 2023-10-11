<!-- database.php -->

<?php
$servername = "localhost";
$dbname = "projetotpi";
$username = "root";
$password = "";

// Cria a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
?>
