<?php
include '../connect.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $id = $_GET["id"];

    // Iniciar uma transação
    $conn->begin_transaction();

    // Consulta para excluir o login do usuário com base no ID
    $sql_delete_login = "DELETE FROM login_usuarios WHERE id_cliente = ?";

    // Consulta para excluir o usuário com base no ID
    $sql_delete_user = "DELETE FROM clientes WHERE id = ?";

    try {
        // Preparar e executar a consulta para excluir o login
        $stmt_login = $conn->prepare($sql_delete_login);
        $stmt_login->bind_param("i", $id);
        $stmt_login->execute();

        // Preparar e executar a consulta para excluir o usuário
        $stmt_user = $conn->prepare($sql_delete_user);
        $stmt_user->bind_param("i", $id);
        $stmt_user->execute();

        // Se as consultas foram bem-sucedidas, confirmar a transação
        $conn->commit();

        echo '<script>alert("Usuário e login excluídos com sucesso."); window.location.href = document.referrer;</script>';
    } catch (Exception $e) {
        // Em caso de erro, reverter a transação
        $conn->rollback();
        echo '<script>alert("Erro ao excluir usuário e login: ' . $e->getMessage() . '"); window.location.href = document.referrer;</script>';
    }

    $stmt_login->close();
    $stmt_user->close();
} else {
    echo "Requisição inválida ou ID de usuário não especificado.";
}

$conn->close();
?>
