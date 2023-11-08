<?php

header('Content-Type: application/json');

// Verifique se a solicitação é um POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Inclua o arquivo connect.php
    include '../connect.php';

    // Receba o ID do usuário da sessão
    session_start();
    $user_id = $_SESSION['user_id'];
    // Receba os dados do carrinho de compras e outros campos
    $cartItems = json_decode($_POST['cartItems'], true); // Dados do carrinho em formato JSON
    $observation = $_POST['observation'];
    $date = $_POST['date'];
    $payment = $_POST['payment'];

    // Verifique se a conexão com o banco de dados foi bem-sucedida
    if ($conn) {
        // Inicie a transação
        $conn->begin_transaction();

        // Insira os dados do pedido na tabela de pedidos, associando o usuário
        $sqlPedido = "INSERT INTO pedidos (id_cliente, data, observacao, cond_pagto) VALUES (?, ?, ?, ?)";
        $stmtPedido = $conn->prepare($sqlPedido);
        $stmtPedido->bind_param("isss", $user_id, $date, $observation, $payment);

        if ($stmtPedido->execute()) {
            // Obtenha o ID do pedido recém-inserido
            $id_pedido = $stmtPedido->insert_id;

            // Em seguida, insira os itens do pedido na tabela de itens_pedidos
            if (is_array($cartItems)) {
                foreach ($cartItems as $item) {
                    $id_produto = $item['product'];
                    $qntd = $item['quantity'];
                    $sqlItem = "INSERT INTO itens_pedidos (id_pedidos, id_produto, qntd) VALUES (?, ?, ?)";
                    $stmtItem = $conn->prepare($sqlItem);
                    $stmtItem->bind_param("iii", $id_pedido, $id_produto, $qntd);
                    $stmtItem->execute();
                }
            }


            // Finalize a transação e confirme as alterações no banco de dados
            $conn->commit();

            // Responda com uma mensagem de sucesso
            $response = ['message' => 'Compra registrada com sucesso'];
            echo json_encode($response);
        } else {
            // Se houver algum erro na inserção do pedido, faça o rollback da transação
            $conn->rollback();

            // Responda com uma mensagem de erro
            $response = ['error' => 'Erro ao registrar a compra'];
            echo json_encode($response);
        }

        // Feche a conexão com o banco de dados no final
        $conn->close();
    } else {
        // Se a conexão com o banco de dados falhou, envie uma resposta de erro
        $response = ['error' => 'Erro na conexão com o banco de dados'];
        echo json_encode($response);
    }
}
?>
