<?php
include("../utils/conexao.php");
include("../../auth/valida.php");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $emailAtual = $_POST["emailAtual"];
    $cpfAtual = $_POST["cpfAtual"];
    $nome = $_POST["nome"];
    $cpf = $_POST["cpf"];
    $email = $_POST["email"];
    $data_nascimento = $_POST["data_nascimento"];
    $endereco = $_POST["endereco"];
    $contato = $_POST["contato"];
    $cargo = $_POST["cargo"];

    if (!DateTime::createFromFormat('Y-m-d', $data_nascimento)) {
        $_SESSION['resposta'] = "Data de validade inválida!";
        header("Location: ../../admin/produtos/cadastro_produto.php");
        exit;
    }

    if ($cpfAtual != null) {
        $sql = "UPDATE pessoas SET nome = ?, cpf = ?, email = ?, data_nascimento = ?, endereco = ?, contato = ?, cargo = ? WHERE cpf = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssss", $nome, $cpf, $email, $data_nascimento, $endereco, $contato, $cargo, $cpfAtual);
    } else if ($emailAtual != null) {
        $sql = "UPDATE pessoas SET nome = ?, cpf = ?, email = ?, data_nascimento = ?, endereco = ?, contato = ?, cargo = ? WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssss", $nome, $cpf, $email, $data_nascimento, $endereco, $contato, $cargo, $emailAtual);
    } else {
        $_SESSION['resposta'] = "Usuário não possui nem email e nem cpf!";
        header("Location: ../../admin/pessoas/pessoas_fisica.php");
        exit();
    }

    if ($stmt->execute()) {
        $_SESSION['resposta'] = "Pessoa editada com sucessso!";
    } else {
        $_SESSION['resposta'] = "Erro ao editar pessoa: " . $stmt->error;
    }
} else {
    $_SESSION['resposta'] = "Método de solicitação ínvalido!";
}

header("Location: ../../admin/pessoas/pessoas_fisica.php");
exit();
