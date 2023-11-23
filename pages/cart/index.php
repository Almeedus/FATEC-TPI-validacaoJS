<?php
// Include do arquivo de conexão com o banco de dados
include '../../php/connect.php';

// Verificar a conexão
if (!$conn) {
    die('Erro na conexão com o banco de dados: ' . mysqli_connect_error());
}

// Consulta para obter pedidos e itens
$sql = "SELECT pedidos.id, pedidos.data, pedidos.observacao, pedidos.cond_pagto, produto.nome, itens_pedidos.qntd
        FROM pedidos
        LEFT JOIN itens_pedidos ON pedidos.id = itens_pedidos.id_pedidos
        LEFT JOIN produto ON itens_pedidos.id_produto = produto.id
        ORDER BY pedidos.id, produto.id"; // Adicionado ORDER BY para garantir a ordem correta

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styles.css">
    <link rel="stylesheet" href="../../css/table.css">
    <link rel="stylesheet" href="./styles/cart.css">
    <title>Gerenciar Pedidos</title>
</head>
<body>
    <a href="../home/index.html" class="back-button">Voltar</a>
    <table>
        <thead>
            <tr>
                <th>ID do Pedido</th>
                <th>Data</th>
                <th>Observação</th>
                <th>Condição de Pagamento</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Verifique se há resultados
            if ($result->num_rows > 0) {
                // Inicializar variável para controlar IDs de detalhes
                $detailId = 1;

                // Inicializar variável para controlar ID do pedido anterior
                $prevOrderId = null;

            // Loop através dos resultados
            while ($row = $result->fetch_assoc()) {
                if ($row['id'] !== $prevOrderId) {
                    // Se este é um novo pedido, exibir informações de pedido
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['data'] . "</td>";
                    echo "<td>" . $row['observacao'] . "</td>";
                    echo "<td>" . $row['cond_pagto'] . "</td>";
                    echo "<td>";
                    echo '<a href="../../php/cart/delete.php?id=' . $row['id'] . '">Excluir</a> | ';
                    echo "<span class='expand-button' onclick='toggleDetails(" . $row['id'] . ")'>Expandir</span>";
                    echo "</td>";
                    echo "</tr>";
                    echo "<tr class='details' id='details" . $row['id'] . "'>";
                    echo "<td colspan='5'>";
                    echo "<strong>Itens do Pedido:</strong><br>";
                }
                // Exibir informações do item
                echo "Produto: " . $row['nome'] . " | Quantidade: " . $row['qntd'] . "<br>";

                // Atualizar ID do pedido anterior
                $prevOrderId = $row['id'];
            }
            echo "</td></tr>"; // Fechar a última linha de detalhes
            } else {
                echo "<tr><td colspan='5'>Nenhum pedido encontrado.</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <script src="./script/index.js"></script>
</body>
</html>
