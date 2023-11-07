<?php
include '../connect.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $product_id = $_GET["id"];

    // Consulta SQL para excluir o produto com base no ID
    $sql = "DELETE FROM produto WHERE id = ?";

    // Prepara a consulta
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $product_id);

    // Executa a consulta
    if ($stmt->execute()) {
        // Redirecione para a página de listagem de produtos após a exclusão
        header("Location: ../../pages/products/index.php");
        exit;
    } else {
        echo '<script>alert("Erro ao excluir o produto: ' . $stmt->error . '"); window.location.href = document.referrer;</script>';
    }

    // Fecha a declaração
    $stmt->close();
} else {
    echo '<script>alert("Requisição inválida ou ID de produto não especificado."); window.location.href = document.referrer;</script>';
}
?>
