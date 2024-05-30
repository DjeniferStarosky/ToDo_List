<?php
// Banco
$servidor = "localhost";
$usuario = "root";
$senha = "";
$bancodedados = "listadetarefas";

// Cria a conexão
$conexao = new mysqli( $servidor
                        , $usuario
                        , $senha
                        , $bancodedados);

// Teste de conexão
if ($conexao->connect_error) {
    die("Falha na conexão: ".$conexao->connect_error);
}

// Query SQL para buscar usuários e senhas
$query = "SELECT * FROM usuarios";
$resultado = $conexao->query($query);

if ($resultado) {
    $usuarios = array();

    while ($linha = $resultado->fetch_assoc()) {
        $usuarios[] = $linha;
    }

    echo json_encode($usuarios); // Retorna os dados como JSON
} else {
    echo "Erro na consulta: " . $conexao->error;
}

$conexao->close();
?>
