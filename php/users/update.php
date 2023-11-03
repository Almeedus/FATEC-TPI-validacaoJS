<?php
include '../connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Receba os campos do formulário
    $id = $_POST["id"]; // Certifique-se de ter um campo oculto no formulário com o ID do usuário

    $name = $_POST["name"];
    $address = $_POST["address"];
    $number = $_POST["number"];
    $neighborhood = $_POST["neighborhood"];
    $city = $_POST["city"];
    $state = $_POST["state"];
    $email = $_POST["email"];
    $cpf_cnpj = $_POST["cpf_cnpj"];
    $rg = $_POST["rg"];
    $phonenumber = $_POST["phonenumber"];
    $cellphone = $_POST["cellphone"];
    $username = $_POST["username"];
    
    // Verifique se a senha foi alterada
    $password = $_POST["password"];

    // Use uma consulta SQL para atualizar os dados do cliente na tabela de clientes
    $sql = "UPDATE clientes 
            SET nome = ?, endereco = ?, numero = ?, bairro = ?, cidade = ?, estado = ?, email = ?, cpf_cnpj = ?, rg = ?, telefone = ?, celular = ? 
            WHERE id = ?";

    // Prepara a consulta
    $stmt = $conn->prepare($sql);

    // Vincula os parâmetros
    $stmt->bind_param("sssssssssssi", $name, $address, $number, $neighborhood, $city, $state, $email, $cpf_cnpj, $rg, $phonenumber, $cellphone, $id);

    // Executa a consulta
    if ($stmt->execute()) {
        // Verifique se a senha foi alterada
        if (!empty($password)) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            // Atualize a senha na tabela de logins
            $sqlUpdatePassword = "UPDATE login_usuarios SET senha = ? WHERE id_cliente = ?";
            $stmtUpdatePassword = $conn->prepare($sqlUpdatePassword);
            $stmtUpdatePassword->bind_param("si", $hashedPassword, $id);
            $stmtUpdatePassword->execute();
        }

        // Redirecione para a página anterior
        echo '<script>alert("Dados atualizados com sucesso!"); window.location.href = document.referrer;</script>';
    } else {
        echo '<script>alert("Erro ao atualizar os dados do cliente: ' . $stmt->error . '"); window.location.href = document.referrer;</script>';
    }

    // Fecha a declaração e a conexão
    $stmt->close();
    $conn->close();
} else {
    echo '<script>alert("O formulário não foi submetido."); window.location.href = document.referrer;</script>';
}
?>
