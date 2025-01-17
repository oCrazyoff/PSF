<?php

//Inicia ou recupera a sessão anterior
session_start();

//Limpa a variavel $_SESSION
$_SESSION = []; 

//Limpa os cookies do usuário logado
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

//Destroi a sessão
session_destroy();

//Reincaminha para a tela de login
header("Location: ../index.php");
exit;
?>
