<!-- database.php -->

<?php
$servername = "serverprojetotpi";
$username = "pma";
$password = "12345678";
$dbname = "projetotpi";

// Cria a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
?>
