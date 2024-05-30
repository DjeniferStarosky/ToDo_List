<?php

include 'listarTarefas.php';


// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $conn = obtem_conexao(); // function que faz conexão com banco
    $user_id = pega_idUser(); // functiona que busca o id do usuário logado

    // Recebe os dados do formulário
    $descricao = $_POST['descricao'];
    $data = $_POST['data'];
    $prioridade = $_POST['prioridade'];


    $insertTarefa = "INSERT INTO tarefas (descricao, data, prioridade, status, usuario_id) VALUES ('$descricao', '$data', '$prioridade','Pendente', '$user_id')";

        if ($conn->query($insertTarefa) === TRUE) {
            // Usuário cadastrado com sucesso, inicia a sessão e redireciona para a página inicial
            header("Location: home.php");
            exit();
        } else {
            echo "Erro ao cadastrar tarefa: " . $conn->error;
        }
    }

    $conn->close();


?>
