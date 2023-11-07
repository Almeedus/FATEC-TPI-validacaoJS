<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styles.css">
    <link rel="stylesheet" href="../../css/table.css">
    <title>Listagem de produtos</title>
</head>
<body>
    <a href="../home/index.html" class="back-button">Voltar</a>
    <?php
        include '../../php/connect.php';

        // Consulta SQL para buscar os produtos
        $sql = "SELECT * FROM produto";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo '<table>';
            echo '<tr><th>ID</th><th>Nome</th><th>Qtde em Estoque</th><th>Valor Unitário</th><th>Ações</th></tr>';

            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row['id'] . '</td>';
                echo '<td>' . $row['nome'] . '</td>';
                echo '<td>' . $row['qtde_estoque'] . '</td>';
                echo '<td>' . $row['valor_unitario'] . '</td>';
                echo '<td>';
                echo '<a href="./edit.php?id=' . $row['id'] . '">Editar</a>';
                echo ' | ';
                echo '<a href="../../php/products/delete.php?id=' . $row['id'] . '">Excluir</a>';
                echo '</td>';
                echo '</tr>';
            }

            echo '</table>';
        } else {
            echo 'Nenhum produto encontrado.';
        }

        $conn->close();
    ?>
</body>
</html>
