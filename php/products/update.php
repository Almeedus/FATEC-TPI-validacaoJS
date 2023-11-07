<?php
include '../connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Receba os campos do formulário
    $product_id = $_POST["product_id"];
    $name = $_POST["name"];
    $stockQuantity = $_POST["stockQuantity"];
    $price = $_POST["price"];

    // Use uma consulta SQL para atualizar os dados do produto com base no ID
    $sql = "UPDATE produto SET nome = ?, qtde_estoque = ?, valor_unitario = ? WHERE id = ?";
    
    // Prepara a consulta
    $stmt = $conn->prepare($sql);
    
    // Vincula os parâmetros
    $stmt->bind_param("sddi", $name, $stockQuantity, $price, $product_id);

    // Executa a consulta
    if ($stmt->execute()) {
        // Redirecione para a página de listagem de produtos após a edição
        header("Location: ../../pages/products/index.php");
        exit;
    } else {
        echo '<script>alert("Erro ao editar o produto: ' . $stmt->error . '"); window.location.href = document.referrer;</script>';
    }

    // Fecha a declaração
    $stmt->close();
} else {
    echo '<script>alert("O formulário não foi submetido."); window.location.href = document.referrer;</script>';
}
?>
