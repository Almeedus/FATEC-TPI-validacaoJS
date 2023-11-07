<?php

header('Content-Type: application/json');

// Verifique se a solicitação é um POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Inclua o arquivo connect.php
    include '../connect.php';

    // Receba os dados do carrinho de compras e outros campos
    $cartItems = json_decode(file_get_contents('php://input'), true); // Dados do carrinho em formato JSON
    $observation = $_POST['observation'];
    $date = $_POST['date'];
    $payment = $_POST['payment'];

    // Verifique se a conexão com o banco de dados foi bem-sucedida
    if ($conn) {
        // Você pode começar a inserir os dados no banco de dados aqui
        // $cartItems contém os itens do carrinho em um formato que você pode manipular e inserir no banco de dados

        // Lembre-se de implementar a lógica de inserção no banco de dados
        // Por exemplo, você pode usar consultas SQL preparadas para inserir os dados
        // Certifique-se de validar e limpar os dados para evitar injeção de SQL

        // Após a inserção bem-sucedida, você pode enviar uma resposta adequada, como um JSON
        $response = ['message' => 'Compra registrada com sucesso'];
        echo json_encode($response);

        // Feche a conexão com o banco de dados no final
        $conn->close();
    } else {
        // Se a conexão com o banco de dados falhou, envie uma resposta de erro
        $response = ['error' => 'Erro na conexão com o banco de dados'];
        echo json_encode($response);
    }
}
?>
