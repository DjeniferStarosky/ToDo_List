// Função para controle de formulario Login/Cadastro
function mostrarFormularioCriarConta() {
    document.getElementById('loginFormContainer').style.display = 'none';
    document.getElementById('criarContaFormContainer').style.display = 'block';
}

function mostrarFormularioLogin() {
    document.getElementById('criarContaFormContainer').style.display = 'none';
    document.getElementById('loginFormContainer').style.display = 'block';
}

// Estrutura que vai buscar o html do link e apresentar dentro da section conteudo qndo o usuário clicar no link - SPA
document.querySelectorAll('[wm-nav]').forEach(link => {
    const conteudo = document.getElementById('conteudo')

   link.onclick = function(e) {
    e.preventDefault()
    fetch(link.getAttribute('wm-nav'))
        .then(resp => resp.text())
        .then(html => conteudo.innerHTML = html)
   }
})


// Estrutura que vai alterar o css dos menus quando selecionados

document.addEventListener("DOMContentLoaded", function() {
    // Define o menu inicialmente ativo
    setActive(document.getElementById("minhasTarefas"));

    // Adiciona um ouvinte de evento de clique a todos os itens do menu
    var menuItems = document.querySelectorAll('.menu-item');
    menuItems.forEach(function(item) {
        item.addEventListener("click", function() {
            // Remove a classe 'active' de todos os itens do menu
            menuItems.forEach(function(menuItem) {
                menuItem.classList.remove("active");
            });
            // Define o item do menu clicado como ativo
            setActive(this);
        });
    });
});

// Tratar o css dos links de menu
function setActive(element) {
    // Adiciona a classe 'active' ao elemento do menu clicado
    element.classList.add("active");
}


// Carregar minhaLista.php na home automaticamente:
document.addEventListener("DOMContentLoaded", function() {
    $.ajax({
        url: 'minhaLista.php',
        type: 'GET',
        success: function(response) {
            $('#conteudo').html(response);
        }
    });
});




// Incluir Tarefa
function insertTarefa() {
    document.getElementById("tarefaForm").submit();
}



// Incluir tarefa - funcionamento da estrela de importante
function toggleStar() {
    const starIcon = document.getElementById('starIcon');
    const taskPriority = document.getElementById('prioridade');
    
    starIcon.classList.toggle('fa-star-o');
    starIcon.classList.toggle('fa-star');
    starIcon.classList.toggle('active');
    
    if (starIcon.classList.contains('active')) {
        taskPriority.value = 'alta';
    } else {
        taskPriority.value = 'normal';
    }
}



//Concluir Tarefa
function concluirTarefa(id) {
    $.ajax({
        url: 'editarTarefa.php',
        type: 'POST',
        data: { id: id, acao: 'concluir' },
        success: function(response) {
            location.reload(); 
        },
        error: function(xhr, status, error) {
            alert('Erro ao concluir tarefa: ' + error);
        }
    });
}

// Alterar situação p/ concluido
function alterarPrioridade(id) {
    $.ajax({
        url: 'editarTarefa.php',
        type: 'POST',
        data: { id: id, acao: 'alterar_prioridade' },
        success: function(response) {
            location.reload(); 
        },
        error: function(xhr, status, error) {
            alert('Erro ao alterar prioridade: ' + error);
        }
    });
}