<?php
include '../connect.php'; // Inclua o seu arquivo de conexão

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Receba os campos do formulário
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Consulta SQL para buscar o usuário com base no nome de usuário
    $sql = "SELECT id, senha FROM login_usuarios WHERE login = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);

    // Execute a consulta
    if ($stmt->execute()) {
        $result = $stmt->get_result();

        // Verifique se o usuário com o nome de usuário fornecido existe
        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            $hashed_password = $row["senha"];
            $user_id = $row["id"];

            // Verifique a senha usando password_verify
            if (password_verify($password, $hashed_password)) {
                // Senha válida, o usuário está autenticado
                // Você pode armazenar o ID do usuário na sessão para autenticação contínua, se desejar
                session_start();
                $_SESSION["user_id"] = $user_id;

                // Redirecione para a página home após o login bem-sucedido
                header('Location: ../../pages/home/index.html');
                exit;
            } else {
                echo '<script>alert("Senha incorreta. Tente novamente."); window.location.href = document.referrer;</script>';
            }
        } else {
            echo '<script>alert("Usuário não encontrado. Verifique o nome de usuário."); window.location.href = document.referrer;</script>';
        }
    } else {
        echo '<script>alert("Erro ao buscar usuário: ' . $stmt->error . '"); window.location.href = document.referrer;</script>';
    }

    // Feche a declaração
    $stmt->close();
}

// Feche a conexão no final
$conn->close();
?>
