<?php
include '../connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Receba os campos do formulário
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
    $password = $_POST["password"];

    // Use uma consulta SQL para inserir os dados do cliente na tabela de clientes
    $sql = "INSERT INTO clientes (nome, endereco, numero, bairro, cidade, estado, email, cpf_cnpj, rg, telefone, celular) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepara a consulta
    $stmt = $conn->prepare($sql);

    // Vincula os parâmetros
    $stmt->bind_param("sssssssssss", $name, $address, $number, $neighborhood, $city, $state, $email, $cpf_cnpj, $rg, $phonenumber, $cellphone);

    // Executa a consulta
    if ($stmt->execute()) {
        // Obtém o ID do cliente recém-inserido
        $cliente_id = $stmt->insert_id;
        
        // Agora, use uma consulta SQL para inserir o login e senha vinculado ao ID do cliente na tabela de logins
        $login = $username; // Suponha que o login seja o mesmo que o nome de usuário
        $senha = password_hash($password, PASSWORD_DEFAULT); // Use password_hash() para armazenar a senha com segurança

        $sql = "INSERT INTO login_usuarios (login, senha, id_cliente) VALUES (?, ?, ?)";
        
        // Prepara a segunda consulta
        $stmt = $conn->prepare($sql);
        
        // Vincula os parâmetros
        $stmt->bind_param("ssi", $login, $senha, $cliente_id);
        
        // Executa a segunda consulta
        if ($stmt->execute()) {
            echo "Cadastro realizado com sucesso!";
        } else {
            echo "Erro ao cadastrar o login: " . $stmt->error;
        }
    } else {
        echo "Erro ao cadastrar o cliente: " . $stmt->error;
    }

    // Fecha a declaração e a conexão
    $stmt->close();
    $conn->close();
} else {
    echo "O formulário não foi submetido.";
}
?>
