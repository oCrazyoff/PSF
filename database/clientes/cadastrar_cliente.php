<?php
include("../utils/conexao.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    $nome = htmlspecialchars($_POST["nome"]);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $senha = htmlspecialchars($_POST["senha"]);
    $confirma_senha = htmlspecialchars($_POST["confirma_senha"]);

    if (isset($_POST["nome"]) and isset($_POST["email"]) and isset($_POST["senha"]) and isset($_POST["confirma_senha"])) {
        if ($senha == $confirma_senha) {
            $senha_hash = password_hash($senha, PASSWORD_BCRYPT);
        } else {
            $_SESSION['resposta'] = "As senhas não estão iguais!";
            header("Location: ../../index.php");
            exit;
        }

        // O comando try-catch é usado para pegar erros de SQL, tem que colocar o código que pode dar erro no try e se der erro ele manda para o catch onde o erro é capturado para a verificação
        try {
            $sql = "INSERT INTO pessoas (nome, email, senha) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $nome, $email, $senha_hash);

            if ($stmt->execute()) {
                $_SESSION['resposta'] = "Usuário cadastrado com sucesso!";
                header("Location: ../../index.php");
                exit;
            } else {
                $_SESSION['resposta'] = "Usuário deu erro!";
                header("Location: ../../index.php");
                exit;
            }
        } catch (Exception $erro_email) {
            if ($erro_email->getCode() == 1062) {
                $_SESSION['resposta'] = "Email já cadastrado!";
                header("Location: ../../index.php");
                exit;
            } else {
                $_SESSION['resposta'] = "Erro ao cadastrar usuário!";
                header("Location: ../../index.php");
                exit;
            }
        }
    } else {
        $_SESSION['resposta'] = "Variável POST ínvalida!";
    }
} else {
    $_SESSION['resposta'] = "Método de solicitação ínvalido!";
}

header("Location: ../../index.php");
exit;
