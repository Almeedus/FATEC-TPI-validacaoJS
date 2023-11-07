<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="stylesheet" href="../../styles.css">
    <link rel="stylesheet" href="../../css/register.css">
    <link rel="stylesheet" href="./styles/products.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edição de Produto</title>
</head>
<body>
    <a href="../home/index.html" class="back-button">Voltar</a>
    <?php
    include '../../php/connect.php';

    // Verifique se o ID do produto foi fornecido na URL
    if (isset($_GET["id"])) {
        $id = $_GET["id"];

        // Consulta SQL para buscar os dados do produto pelo ID
        $sql = "SELECT * FROM produto WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);

        // Execute a consulta
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows === 1) {
                $row = $result->fetch_assoc();

                // Preencha os campos do formulário com os valores do produto
                $name = $row["nome"];
                $stockQuantity = $row["qtde_estoque"];
                $price = $row["valor_unitario"];
            } else {
                echo "Produto não encontrado.";
                exit;
            }
        } else {
            echo "Erro ao buscar o produto: " . $stmt->error;
            exit;
        }

        $stmt->close();
    } else {
        echo "ID de produto não especificado.";
        exit;
    }

    $conn->close();
    ?>
    <div class="form-container">
        <h1>Edição de Produto</h1>
        <form action="../../php/products/update.php" class="product-form" id="product_edit" method="post">
            <!-- Campo 'name' preenchido com o valor do produto -->
            <input 
                type="text" 
                id="name" 
                name="name" 
                placeholder="Nome" 
                value="<?php echo $name; ?>"
            >
            <!-- Campo 'stockQuantity' preenchido com o valor do produto -->
            <input
                type="number"
                id="stockQuantity"
                name="stockQuantity"
                placeholder="Quantidade em Estoque"
                value="<?php echo $stockQuantity; ?>"
            >
            <!-- Campo 'price' preenchido com o valor do produto -->
            <input
                type="number"
                id="price"
                name="price"
                placeholder="Preço"
                min="0.010"
                step="0.010"
                value="<?php echo $price; ?>"
            >
            <!-- Adicione um campo oculto para passar o ID do produto -->
            <input
                type="hidden"
                name="product_id"
                value="<?php echo $id; ?>"
            >
            <!-- Botão de envio -->
            <input type="submit" value="Atualizar">
        </form>
    </div>
</body>
<script src="../../js/product_register.mjs"></script>
</html>
