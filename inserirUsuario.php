<?php
session_start();

// Conexão com o banco de dados 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "listadetarefas";

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Cria a conexão
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifica a conexão
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    // Recebe os dados do formulário
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Consulta SQL para verificar se o username já existe
    $check_username_sql = "SELECT * FROM usuarios WHERE nome = '$username'";
    $result = $conn->query($check_username_sql);

    if ($result->num_rows > 0) {
        // Username já existe, exibe mensagem de erro
        echo "Erro ao cadastrar usuário: Nome de usuário já existe. <br> <button onclick='window.location=\"login.php\"'>Voltar para tela de login</button>";
        
    } else {
        // Username não existe, pode inserir o novo usuário
        // Consulta SQL para inserir novo usuário
        $insert_user_sql = "INSERT INTO usuarios (nome, senha) VALUES ('$username', '$password')";

        if ($conn->query($insert_user_sql) === TRUE) {
            // Usuário cadastrado com sucesso, inicia a sessão e redireciona para a página inicial
            $_SESSION['username'] = $username;
            header("Location: home.php");
            exit();
        } else {
            echo "Erro ao cadastrar usuário: " . $conn->error;
        }
    }

    $conn->close();
}
?>
