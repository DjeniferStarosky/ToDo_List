<?php
session_start();

// Destruir todas as variáveis de sessão
$_SESSION = array();

// Apagar dados de sessão e cookies
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Encerra sessão
session_destroy();

// Redireciona de volta para a página de login
header("Location: login.php");
exit();
?>
