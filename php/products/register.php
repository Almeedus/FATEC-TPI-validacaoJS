<?php
include '../connect.php';

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera os dados do formulário
    $name = $_POST["name"];
    $stockQuantity = $_POST["stockQuantity"];
    $price = $_POST["price"];

    // Prepara e executa a consulta SQL para inserção
    $sql = "INSERT INTO produto (nome, qtde_estoque, valor_unitario) 
        VALUES ('$name', '$stockQuantity', '$price')";

    if ($conn->query($sql) === TRUE) {
        // Redireciona de volta para a página anterior
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit(); // Encerra o script para garantir que o redirecionamento funcione
    } else {
        echo "Erro ao inserir registro: " . $conn->error;
    }
}

// Fecha a conexão
$conn->close();
?>
