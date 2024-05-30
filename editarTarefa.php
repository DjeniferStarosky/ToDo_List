<?php

include 'listarTarefas.php';
$conn = obtem_conexao();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $acao = $_POST['acao'];

    if ($acao === 'concluir') {
        $sql = "UPDATE tarefas SET status = 'concluida' WHERE id = $id";
    } elseif ($acao === 'alterar_prioridade') {
        $sql = "UPDATE tarefas SET prioridade = IF(prioridade = 'alta', 'normal', 'alta') WHERE id = $id";
    }

    if ($conn->query($sql) === TRUE) {
        echo "Registro atualizado com sucesso";
    } else {
        echo "Erro ao atualizar registro: " . $conn->error;
    }
}

$conn->close();

?>