<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styles.css">
    <link rel="stylesheet" href="../../css/table.css">
    <title>Listagem de usuários</title>
</head>
<body>
    <?php
    include '../../php/connect.php';

    // Consulta para recuperar todos os usuários
    $sql = "SELECT id, nome, endereco, numero, bairro, cidade, estado, email, cpf_cnpj, rg, telefone, celular FROM clientes";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table border='1'>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Endereço</th>
            <th>Número</th>
            <th>Bairro</th>
            <th>Cidade</th>
            <th>Estado</th>
            <th>Email</th>
            <th>CPF/CNPJ</th>
            <th>RG</th>
            <th>Telefone</th>
            <th>Celular</th>
            <th>Ações</th>
        </tr>";

        while($row = $result->fetch_assoc()) {
            echo "<tr>
            <td>".$row["id"]."</td>
            <td>".$row["nome"]."</td>
            <td>".$row["endereco"]."</td>
            <td>".$row["numero"]."</td>
            <td>".$row["bairro"]."</td>
            <td>".$row["cidade"]."</td>
            <td>".$row["estado"]."</td>
            <td>".$row["email"]."</td>
            <td>".$row["cpf_cnpj"]."</td>
            <td>".$row["rg"]."</td>
            <td>".$row["telefone"]."</td>
            <td>".$row["celular"]."</td>
            <td>
                <a href='../../php/users/editar_usuario.php?id=".$row["id"]."'>Editar</a> |
                <a href='excluir_usuario.php?id=".$row["id"]."'>Excluir</a>
            </td>
            </tr>";
        }

        echo "</table>";
    } else {
        echo "Nenhum usuário encontrado.";
    }

    $conn->close();
    ?>
</body>
</html>
