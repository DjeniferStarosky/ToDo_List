<?php
session_start();

// Verifica se o usuário está autenticado
if (!isset($_SESSION['username'])) {
    // Se não estiver autenticado, redireciona para a página de login
    header("Location: login.php");
    exit();
}

// Se estiver autenticado, você pode acessar as informações do usuário a partir da sessão
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/agenda.svg" type="image/x-icon">
    <title> TO-DO LIST</title>
  <link rel="stylesheet" href="style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>
<body class="home">
    
    <div class="lateral">
      <div class="user">
        <div class="avatar">
          <img src="img/avatar3.png" alt="avatar">
        </div>
        <div class="usuario">
          <h4>Olá, <?php echo $username; ?></h4>
          <a href="logout.php"><img src="img/sair.png" alt="logout" class="logout"></a>
          
        </div>
      </div>

    <div class="menu">
      <ul>
        <li><a href="" wm-nav="minhaLista.php" id="minhasTarefas" class="menu-item active"><img src="img/lista.png" alt="Minhas Tarefas">Minhas Tarefas</a></li>
        <li><a href="" wm-nav="meuDia.php" id="meuDia" class="menu-item"> <img src="img/calendario.png" id="Minhas Tarefas"> Meu Dia</a></li>
        <li><a href="" wm-nav="importante.php" id="importante" class="menu-item"> <img src="img/normal.png" id="Minhas Tarefas">Importante</a></li>
        <li><a href="" wm-nav="atrasadas.php" id="atrasados" class="menu-item"> <img src="img/atrasado.png" alt="Minhas Tarefas">Atrasados</a></li>
      </ul>
    </div>
  </div>

  <div class="listagem" id="conteudo">  </div>

  <div class="incluir">
    <form id="tarefaForm" action="novaTarefa.php" method="post">
            <div class="inputTarefa" id="incluir">
            <input type="text" id="Descricao" name="descricao" placeholder="Descreva a tarefa" class="inputDescricao" required>
                <input type="date" id="Data" name="data" class="inputData" required>
                <div class="inputPrioridade" onclick="toggleStar()">
                    <i class="fa fa-star-o" id="starIcon"></i>
                </div>
                <div class="submitTarefa" onclick="insertTarefa()">
                    <i class="fa fa-paper-plane"></i>
                </div>
                <input type="hidden" id="prioridade" name="prioridade" value="normal">
            </div>
      </form>
    </div>
  <script src="script.js"> </script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</body>

</html>