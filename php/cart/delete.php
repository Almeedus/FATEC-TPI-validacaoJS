<?php
// Include do arquivo de conexão com o banco de dados
include '../connect.php';

// Verificar a conexão
if (!$conn) {
    die('Erro na conexão com o banco de dados: ' . mysqli_connect_error());
}

// Verificar se o ID do pedido foi fornecido na URL
if (isset($_GET['id'])) {
    // Obter o ID do pedido a ser excluído
    $id_pedido = $_GET['id'];

    // Iniciar a transação
    $conn->begin_transaction();

    try {
        // Excluir itens relacionados ao pedido na tabela itens_pedidos
        $sqlExcluirItens = "DELETE FROM itens_pedidos WHERE id_pedidos = ?";
        $stmtExcluirItens = $conn->prepare($sqlExcluirItens);
        $stmtExcluirItens->bind_param("i", $id_pedido);
        $stmtExcluirItens->execute();

        // Excluir o pedido na tabela pedidos
        $sqlExcluirPedido = "DELETE FROM pedidos WHERE id = ?";
        $stmtExcluirPedido = $conn->prepare($sqlExcluirPedido);
        $stmtExcluirPedido->bind_param("i", $id_pedido);
        $stmtExcluirPedido->execute();

        // Confirmar as alterações no banco de dados
        $conn->commit();

        // Redirecionar de volta para a página de gerenciamento de pedidos
        header("Location: ../../pages/cart/");
        exit();
    } catch (Exception $e) {
        // Em caso de erro, fazer o rollback da transação
        $conn->rollback();
        echo 'Erro: ' . $e->getMessage();
    }
} else {
    echo 'ID do pedido não fornecido.';
}
// Fechar a conexão com o banco de dados
$conn->close();
?>
