
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styleLogin.css">
</head>
<body class="login">
    <script>
        // Script JS + PHP caso usuário/senha incorretos
        window.onload = function() {
            <?php
            // Iniciar a sessão
            session_start();
            
            // Verificar se a variável de sessão 'redirected' está definida
            if (isset($_SESSION['redirected']) && $_SESSION['redirected'] === true) {
                // Exibir o alerta
                echo "alert('Usuário e/ou senha incorretos!');";
                
                // Limpar a variável de sessão para que o alerta não seja exibido novamente
                unset($_SESSION['redirected']);
            }
            ?>
        };
    </script>

    <div class="bemvindo"> 
        <h1>Bem vindo à sua lista de Tarefas!</h1>
        <p><strong>Faça login</strong> ou <strong>crie uma conta</strong> para começar.</p>
    </div>

    <div class="login-container">
        <div id="loginFormContainer">
           
            <form id="loginForm" action="validarLogin.php" method="post">
                 <h2>Login</h2>

                <div class="input-group">
                <div class="icon-container"><input type="text" id="username" name="username" class="username" placeholder="Digite sua usuario..." required></div>
                </div>

                <div class="input-group">
                <div class="icon-container password-container"><input type="password" id="password" name="password" placeholder="Digite sua senha..." required> </div>
                </div>

                <div class="botaoLogin">
                    <input type="submit" value="Login" class="btnLogin">
                </div>

                <div class="criarConta"><a href="#" onclick="mostrarFormularioCriarConta()" class="create">Criar conta</a> </div>
            </form>
        </div>


        <div id="criarContaFormContainer" style="display: none">
            <form id="cadastroForm" action="inserirUsuario.php" method="post" class="form-container">
            <h2>Criar conta</h2>
            <div class="input-group">
                <div class="icon-container"> <input type="text" id="username" name="username" class="username" placeholder="Digite seu usuário..." required> </div>
            </div>

            <div class="input-group">
                <div class="icon-container password-container">
                    <input type="password" id="password" name="password" placeholder="Digite sua senha..." required>
                </div>
            </div>

            <div class="botaoLogin">
                <input type="submit" value="Criar" class="btnLogin">
            </div>

            <div class="loginConta"><a href="#" onclick="mostrarFormularioLogin()" class="create">Fazer login</a></div>

            </form>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>
