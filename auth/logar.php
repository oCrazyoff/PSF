<?php
session_start();
require_once '../database/utils/conexao.php';

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $senha = htmlspecialchars($_POST["senha"]);

    if (isset($_POST['_csrf']) && $_POST['_csrf'] !== $_SESSION['_csrf']) {
        $_SESSION['resposta'] = "CSRF Token ínvalido!";
        $_SESSION['_csrf'] = hash('sha256', random_bytes(32));
        header("Location: ../index.php");
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['resposta'] = "Usuário ou senha incorreto!";
        header("Location: ../index.php");
        exit;
    }

    if (isset($_POST["email"]) and isset($_POST["senha"])) {
        $sql = "SELECT nome, cpf, id, cargo, email, senha FROM pessoas WHERE email = ? and status = 1";

        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->bind_result($nome, $cpf, $id, $cargo, $email, $senha_bd);
            $stmt->fetch();

            if ($nome != '' && password_verify($senha, $senha_bd)) {
                $_SESSION["id"] = $id;
                $_SESSION["nome"] = $nome;
                $_SESSION["cpf"] = ($cpf == null || $cpf == '') ? '' : $cpf;
                $_SESSION["email"] = $email;
                $_SESSION['cargo'] = $cargo;
                header("Location: ../pages/inicio.php");
                exit;
            } else {
                $_SESSION['resposta'] = "Usuário ou senha incorreto!";
                header("Location: ../index.php");
                exit;
            }
        }
    } else {
        $_SESSION['resposta'] = "Variável POST ínvalida!";
    }
} else {
    $_SESSION['resposta'] = "Método de solicitação ínvalido!";
}

$conn->close();
header("Location: ../index.php");
exit;
