<?php

// Cria e testa a conexão com banco
function obtem_conexao () {
    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $bancodedados = "listadetarefas";

    $conexao = new mysqli( $servidor
                            , $usuario
                            , $senha
                            , $bancodedados);

    if ($conexao->connect_error) {
        die("Falha na conexão: ".$conexao->connect_error);
    }

    return $conexao;
}


// Verifica se o usuário está autenticado e pega o ID do usuario
function pega_idUser() { 

    session_start();


    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit();
    }

    $username = $_SESSION['username'];

    $sql = "SELECT id FROM usuarios WHERE nome = '$username'";
    $conn = obtem_conexao();
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $user_id = $row['id'];
    } else {
        header("Location: login.php");
        exit();
    };

    return $user_id;
}

// Lista todas as tarefas ativas do usuário
function minhaLista() {
    $conn = obtem_conexao();
    $user_id = pega_idUser();

    $sql = "SELECT * FROM tarefas WHERE data >= CURDATE() AND status = 'pendente' AND usuario_id = '$user_id' ";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h2 class='tituloPag'><i class='fa fa-list'></i> Minhas Tarefas</h2>";
        while ($row = $result->fetch_assoc()) {
            $id = $row["id"];
            // Formata a data no formato DD/MM/AAAA
            $data_formatada = date('d/m/Y', strtotime($row["data"]));
            // Verifica a prioridade da tarefa e define o ícone correspondente
            $icone_prioridade = ($row["prioridade"] == "Alta") ? "fa-star" : "fa-star-o";

            // Exibe a descrição da tarefa, data e ícone de prioridade
            echo "<div class='item_lista'>";
            echo "<div class='concluir' onclick='concluirTarefa($id)' id='concluir'><i class='fa fa-check-circle-o'></i></div>";
            echo "<div class='informacao'><p class='descricao'>" . $row["descricao"] . "</p>";
            echo "<p class='data'>$data_formatada</p> </div>";
            echo "<div class='prioridade' onclick='alterarPrioridade($id)' id='prioridade'><i class='fa $icone_prioridade icone_prioridade'  id='prioridade_" . $row["id"] . "'></i> </div>";
            echo "</div>";
        }
    } else {
        echo "<h2 class='tituloPag'><i class='fa fa-list'></i> Minhas Tarefas</h2>";
        echo "<h3 class='semTarefas'>Você não tem tarefas cadastradas.</h3>";
    }

    $conn->close();
}

// Lista tarefas ativas do dia atual do usuário
function meuDia() {
    $conn = obtem_conexao();
    $user_id = pega_idUser();

    $sql = "SELECT * FROM tarefas WHERE data = CURDATE() AND status = 'pendente' AND usuario_id = '$user_id' ";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h2 class='tituloPag'><i class='fa fa-calendar'></i> Meu Dia </h2>";
        while ($row = $result->fetch_assoc()) {
            $id = $row["id"];
            // Formata a data no formato DD/MM/AAAA
            $data_formatada = date('d/m/Y', strtotime($row["data"]));
            // Verifica a prioridade da tarefa e define o ícone correspondente
            $icone_prioridade = ($row["prioridade"] == "Alta") ? "fa-star" : "fa-star-o";

            // Exibe a descrição da tarefa, data e ícone de prioridade
            echo "<div class='item_lista'>";
            echo "<div class='concluir' onclick='concluirTarefa($id)' id='concluir'><i class='fa fa-check-circle-o'></i></div>";
            echo "<div class='informacao'><p class='descricao'>" . $row["descricao"] . "</p>";
            echo "<p class='data'>$data_formatada</p> </div>";
            echo "<div class='prioridade' onclick='alterarPrioridade($id)' id='prioridade'><i class='fa $icone_prioridade icone_prioridade'  id='prioridade_" . $row["id"] . "'></i> </div>";
            echo "</div>";
        }
    } else {
        echo "<h2 class='tituloPag'><i class='fa fa-calendar'></i> Meu Dia</h2>";
        echo "<h3 class='semTarefas'>Você não tem tarefas para hoje.</h3>";
    }

    $conn->close();
}


// Lista tarefas importantes do usuário
function importante() {
    $conn = obtem_conexao();
    $user_id = pega_idUser();

    $sql = "SELECT * FROM tarefas WHERE data >= CURDATE() AND prioridade = 'alta' AND status = 'pendente' AND usuario_id = '$user_id' ";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h2 class='tituloPag'><i class='fa fa-star-o'></i>  Minhas Tarefas Importantes </h2>";
        while ($row = $result->fetch_assoc()) {
            $id = $row["id"];
            // Formata a data no formato DD/MM/AAAA
            $data_formatada = date('d/m/Y', strtotime($row["data"]));
            // Verifica a prioridade da tarefa e define o ícone correspondente
            $icone_prioridade = ($row["prioridade"] == "Alta") ? "fa-star" : "fa-star-o";

            // Exibe a descrição da tarefa, data e ícone de prioridade
            echo "<div class='item_lista'>";
            echo "<div class='concluir' onclick='concluirTarefa($id)' id='concluir'><i class='fa fa-check-circle-o'></i></div>";
            echo "<div class='informacao'><p class='descricao'>" . $row["descricao"] . "</p>";
            echo "<p class='data'>$data_formatada</p> </div>";
            echo "<div class='prioridade' onclick='alterarPrioridade($id)' id='prioridade'><i class='fa $icone_prioridade icone_prioridade'  id='prioridade_" . $row["id"] . "'></i> </div>";
            echo "</div>";
        }
    } else {
        echo "<h2 class='tituloPag'><i class='fa fa-star-o'></i> Minhas Tarefas Importantes</h2>";
        echo "<h3 class='semTarefas'>Você não tem tarefas importantes.</h3>";
    }

    $conn->close();
}


// Lista tarefas atrasadas do usuário (pendente de dias anteriores)
function atrasada() {
    $conn = obtem_conexao();
    $user_id = pega_idUser();

    $sql = "SELECT * FROM tarefas WHERE data < CURDATE() AND status = 'pendente' AND usuario_id = '$user_id' ";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h2 class='tituloPag'><i class='fa fa-calendar-times-o'></i> Minhas Tarefas Atrasadas</h2>";
        while ($row = $result->fetch_assoc()) {
            $id = $row["id"];
            // Formata a data no formato DD/MM/AAAA
            $data_formatada = date('d/m/Y', strtotime($row["data"]));
            // Verifica a prioridade da tarefa e define o ícone correspondente
            $icone_prioridade = ($row["prioridade"] == "Alta") ? "fa-star" : "fa-star-o";

            // Exibe a descrição da tarefa, data e ícone de prioridade
            echo "<div class='item_lista'>";
            echo "<div class='concluir' onclick='concluirTarefa($id)' id='concluir'><i class='fa fa-check-circle-o'></i></div>";
            echo "<div class='informacao'><p class='descricao'>" . $row["descricao"] . "</p>";
            echo "<p class='dataAtrasada'>$data_formatada</p> </div>";
            echo "<div class='prioridade' onclick='alterarPrioridade($id)' id='prioridade'><i class='fa $icone_prioridade icone_prioridade'  id='prioridade_" . $row["id"] . "'></i> </div>";
            echo "</div>";
        }
    } else {
        echo "<h2 class='tituloPag'><i class='fa fa-calendar-times-o'></i> Minhas Tarefas Atrasadas</h2>";
        echo "<h3 class='semTarefas'>Você não tem tarefas atrasadas.</h3>";
    }

    $conn->close();
}



?>
