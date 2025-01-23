<?php
include("../utils/conexao.php");
include("../../auth/valida.php");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $emailAtual = filter_input(INPUT_POST, 'emailAtual', FILTER_SANITIZE_EMAIL);
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $cpf = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $data_nascimento = $_POST["data_nascimento"];
    $cep = filter_input(INPUT_POST, 'cep', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $logradouro = filter_input(INPUT_POST, 'logradouro', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $numero = filter_input(INPUT_POST, 'numero', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $bairro = filter_input(INPUT_POST, 'bairro', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $complemento = filter_input(INPUT_POST, 'complemento', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $estado = filter_input(INPUT_POST, 'estado', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $cidade = filter_input(INPUT_POST, 'cidade', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $contato = filter_input(INPUT_POST, 'contato', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $cargo = filter_input(INPUT_POST, 'cargo', FILTER_SANITIZE_NUMBER_INT);
    $endereco = "$cep, $logradouro, $numero, $bairro, " . ($complemento == null ? "" : $complemento . ", ") . "$estado, $cidade";

    if (!DateTime::createFromFormat('Y-m-d', $data_nascimento)) {
        $_SESSION['resposta'] = "Data de validade inválida!";
        header("Location: ../../admin/produtos/cadastro_produto.php");
        exit;
    }

    $sql = "UPDATE pessoas SET nome = ?, cpf = ?, email = ?, data_nascimento = ?, endereco = ?, contato = ?, cargo = ? WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssss", $nome, $cpf, $email, $data_nascimento, $endereco, $contato, $cargo, $emailAtual);

    if ($stmt->execute()) {
        if($_SESSION['email'] == $emailAtual) {
            $_SESSION['cargo'] = $cargo;
        }
        $_SESSION['resposta'] = "Pessoa foi editada com sucessso!";
    } else {
        $_SESSION['resposta'] = "Erro ao editar pessoa: " . $stmt->error;
    }
} else {
    $_SESSION['resposta'] = "Método de solicitação ínvalido!";
}

header("Location: ../../admin/pessoas/pessoas_fisica.php");
exit();
