<?php
session_start();

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conexão com o banco de dados (substitua pelos seus próprios detalhes)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "listadetarefas";

    // Cria a conexão
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifica a conexão
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    // Recebe os dados do formulário
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Consulta SQL para verificar se o usuário existe
    $sql = "SELECT * FROM usuarios WHERE nome = '$username' AND senha = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Usuário autenticado com sucesso, inicia a sessão e armazena informações do usuário nela
        $_SESSION['username'] = $username;
        // Redireciona para a lista de tarefas
        header("Location: home.php");
        exit();
    } else {
        $_SESSION['redirected'] = true;
        header("Location: login.php");
    }

    $conn->close();
} else {
    header("Location: login.php");
}
?>
