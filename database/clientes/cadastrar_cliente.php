<?php
include("../utils/conexao.php");

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    $nome = htmlspecialchars($_POST["nome"]);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $senha = htmlspecialchars($_POST["senha"]);
    $confirma_senha = htmlspecialchars($_POST["confirma_senha"]);

    if (isset($_POST["nome"]) and isset($_POST["email"]) and isset($_POST["senha"]) and isset($_POST["confirma_senha"])) {
        if ($senha == $confirma_senha) {
            $senha_hash = password_hash($senha, PASSWORD_BCRYPT);
        } else {
            $resposta = "As senhas não estão iguais!";
            header("Location: ../../pages/cadastrese.php?resposta=$resposta");
            exit;
        }

        // O comando try 
        try {
            $sql = "INSERT INTO pessoas (nome, email, senha) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $nome, $email, $senha_hash);

            if ($stmt->execute()) {
                $resposta = "Usuário cadastrado com sucesso!";
                header("Location: ../../index.php?resposta=$resposta");
                exit;
            } else {
                $resposta = "Usuário deu erro!";
                header("Location: ../../index.php?resposta=$resposta");
                exit;
            }
        } catch (Exception $erro_email) {
            if ($erro_email->getCode() == 1062) {
                $resposta = "Email já cadastrado!";
                header("Location: ../../index.php?resposta=$resposta");
                exit;
            } else {
                $resposta = "Erro ao cadastrar usuário!";
                header("Location: ../../index.php?resposta=$resposta");
                exit;
            }
        }
    } else {
        $_SESSION['resposta'] = "Variável POST ínvalida!";
    }
} else {
    $_SESSION['resposta'] = "Método de solicitação ínvalido!";
}

header("Location: ../index.php?resposta=$resposta");
exit;
