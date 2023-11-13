<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="stylesheet" href="../../styles.css">
    <link rel="stylesheet" href="../../css/register.css">
    <link rel="stylesheet" href="./styles/cart.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho de Compras</title>
</head>
<body>
    <a href="../home/index.html" class="back-button">Voltar</a>
    <div class="form-container">
        <h1>Carrinho de Compras</h1>
        <form id="cart_register" method="post" action="../../php/cart/register.php">
            <!-- Campo 'date' -->
            <input id="date" name="date" type="date">

            <!-- Campo 'product' -->
            <select id="product" name="product">
                <option value="" disabled selected>Selecione um produto</option>
                <?php
                include '../../php/connect.php';

                $sql = "SELECT id, nome, qtde_estoque FROM produto";
                $result = $conn->query($sql);

                while ($row = $result->fetch_assoc()) {
                    echo '<option value="' . $row['id'] . '" data-qtde-estoque="' . $row['qtde_estoque'] . '">' . $row['nome'] . '</option>';
                }
                ?>
            </select>
            <!-- Campo 'quantity' -->
            <input
                type="number"
                id="quantity"
                min="1"
                name="quantity"
                placeholder="Quantidade"
            >

            <!-- Campo 'payment' -->
            <input
                type="text"
                id="payment"
                name="payment"
                placeholder="Condição de Pagamento"
            >

            <!-- Campo 'observation' -->
            <textarea
                id="observation"
                name="observation"
                placeholder="Observação"
            ></textarea>

            
            <!-- Botão "Adicionar ao Carrinho" -->
            <input type="button" value="Adicionar ao Carrinho" id="addCartButton">
            
            <!-- Campos de Produtos e Quantidades -->
            <div id="carrinho"></div>

            <!-- Botão "Finalizar Compra" -->
            <input type="button" value="Finalizar Compra" id="finishPurchaseButton" hidden>
        </form>
    </div>
    <script src="../../js/cart_register.mjs"></script>
</body>
</html>
