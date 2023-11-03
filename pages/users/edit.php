<?php
include '../../php/connect.php';

// Verifique se o ID do usuário foi fornecido na URL
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    // Consulta para buscar os dados do usuário na tabela 'clientes' pelo ID
    $sql = "SELECT * FROM clientes WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    // Execute a consulta
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();

            // Preencha os campos do formulário com os dados do usuário
            $name = $row["nome"];
            $address = $row["endereco"];
            $number = $row["numero"];
            $neighborhood = $row["bairro"];
            $city = $row["cidade"];
            $state = $row["estado"];
            $email = $row["email"];
            $cpf_cnpj = $row["cpf_cnpj"];
            $rg = $row["rg"];
            $phonenumber = $row["telefone"];
            $cellphone = $row["celular"];
        } else {
            echo "Usuário não encontrado.";
            exit;
        }
    } else {
        echo "Erro ao buscar usuário: " . $stmt->error;
        exit;
    }

    $stmt->close();

    // Agora, consulte a tabela 'login_usuarios' para obter o nome de usuário (login) e senha
    $sql_login = "SELECT login, senha FROM login_usuarios WHERE id_cliente = ?";
    $stmt_login = $conn->prepare($sql_login);
    $stmt_login->bind_param("i", $id);

    // Execute a consulta de login
    if ($stmt_login->execute()) {
        $result_login = $stmt_login->get_result();
        if ($result_login->num_rows === 1) {
            $row_login = $result_login->fetch_assoc();

            // Preencha os campos de nome de usuário e senha
            $username = $row_login["login"];
            $password = $row_login["senha"];
        } else {
            echo "Nome de usuário e senha não encontrados.";
            exit;
        }
    } else {
        echo "Erro ao buscar nome de usuário e senha: " . $stmt_login->error;
        exit;
    }

    $stmt_login->close();
} else {
    echo "ID de usuário não especificado.";
    exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styles.css">
    <link rel="stylesheet" href="../../css/register.css">
    <link rel="stylesheet" href="../create_account/styles/create_account.css">
    <title>Editar Usuário</title>
</head>
<body>
    <div class="form-client-container">
        <form action="../../php/users/update.php" class="user_form" method="POST" id="user_edit">
        <div class="two-section-form">
                <div class="form-section">
                    <label for="name">Nome</label>
                    <input type="text" name="name" id="name" value="<?php echo $phonenumber; ?>">
            
                    <label for="address">Endereço</label>
                    <input type="text" name="address" id="address" value="<?php echo $address; ?>">
            
                    <label for="number">Número</label>
                    <input type="number" name="number" id="number" value="<?php echo $number; ?>">
            
                    <label for="neighborhood">Bairro</label>
                    <input type="text" name="neighborhood" id="neighborhood" value="<?php echo $neighborhood; ?>">
            
                    <label for="city">Cidade</label>
                    <input type="text" name="city" id="city" value="<?php echo $city; ?>">
            
                    <label for="state">Estado</label>
                    <select id="state" name="state">
                        <option value="AC" <?php if ($state === 'AC') echo 'selected'; ?>>Acre</option>
                        <option value="AL" <?php if ($state === 'AL') echo 'selected'; ?>>Alagoas</option>
                        <option value="AP" <?php if ($state === 'AP') echo 'selected'; ?>>Amapá</option>
                        <option value="AM" <?php if ($state === 'AM') echo 'selected'; ?>>Amazonas</option>
                        <option value="BA" <?php if ($state === 'BA') echo 'selected'; ?>>Bahia</option>
                        <option value="CE" <?php if ($state === 'CE') echo 'selected'; ?>>Ceará</option>
                        <option value="DF" <?php if ($state === 'DF') echo 'selected'; ?>>Distrito Federal</option>
                        <option value="ES" <?php if ($state === 'ES') echo 'selected'; ?>>Espírito Santo</option>
                        <option value="GO" <?php if ($state === 'GO') echo 'selected'; ?>>Goiás</option>
                        <option value="MA" <?php if ($state === 'MA') echo 'selected'; ?>>Maranhão</option>
                        <option value="MT" <?php if ($state === 'MT') echo 'selected'; ?>>Mato Grosso</option>
                        <option value="MS" <?php if ($state === 'MS') echo 'selected'; ?>>Mato Grosso do Sul</option>
                        <option value="MG" <?php if ($state === 'MG') echo 'selected'; ?>>Minas Gerais</option>
                        <option value="PA" <?php if ($state === 'PA') echo 'selected'; ?>>Pará</option>
                        <option value="PB" <?php if ($state === 'PB') echo 'selected'; ?>>Paraíba</option>
                        <option value="PR" <?php if ($state === 'PR') echo 'selected'; ?>>Paraná</option>
                        <option value="PE" <?php if ($state === 'PE') echo 'selected'; ?>>Pernambuco</option>
                        <option value="PI" <?php if ($state === 'PI') echo 'selected'; ?>>Piauí</option>
                        <option value="RJ" <?php if ($state === 'RJ') echo 'selected'; ?>>Rio de Janeiro</option>
                        <option value="RN" <?php if ($state === 'RN') echo 'selected'; ?>>Rio Grande do Norte</option>
                        <option value="RS" <?php if ($state === 'RS') echo 'selected'; ?>>Rio Grande do Sul</option>
                        <option value="RO" <?php if ($state === 'RO') echo 'selected'; ?>>Rondônia</option>
                        <option value="RR" <?php if ($state === 'RR') echo 'selected'; ?>>Roraima</option>
                        <option value="SC" <?php if ($state === 'SC') echo 'selected'; ?>>Santa Catarina</option>
                        <option value="SP" <?php if ($state === 'SP') echo 'selected'; ?>>São Paulo</option>
                        <option value="SE" <?php if ($state === 'SE') echo 'selected'; ?>>Sergipe</option>
                        <option value="TO" <?php if ($state === 'TO') echo 'selected'; ?>>Tocantins</option>
                        <option value="EX" <?php if ($state === 'EX') echo 'selected'; ?>>Estrangeiro</option>
                    </select>
                </div>
            
                <div class="form-section">
                    <label for="email">E-mail</label>
                    <input type="email" name="email" id="email" value="<?php echo $email; ?>">
            
                    <label for="cpf_cnpj">CPF / CNPJ</label>
                    <input type="text" name="cpf_cnpj" id="cpf_cnpj" value="<?php echo $cpf_cnpj; ?>">
            
                    <label for="rg">RG</label>
                    <input type="text" name="rg" id="rg" value="<?php echo $rg; ?>">
            
                    <label for="phonenumber">Telefone</label>
                    <input type="text" name="phonenumber" id="phonenumber" value="<?php echo $phonenumber; ?>">
            
                    <label for="cellphone">Celular</label>
                    <input type="text" name="cellphone" id="cellphone" value="<?php echo $cellphone; ?>">

                    <label for="username">Usuário</label>
                    <input type="text" name="username" id="username" value="<?php echo $username; ?>">

                    <label for="password">Senha</label>
                    <input type="password" name="password" id="password" value="<?php echo $password; ?>">
                </div>
            </div>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="submit" value="Salvar Alterações">
            <a href="../../pages/home/index.html" class="register_button">Cancelar</a>
        </form>
    </div>
</body>
<script src="../../js/user_register.mjs" type="module"></script>
</html>
