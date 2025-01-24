<?php
include("../utils/conexao.php");
include("../../auth/valida.php");

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $cnpjAtual = filter_input(INPUT_POST, 'cnpjAtual', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $razao_social = filter_input(INPUT_POST, 'razao_social', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $nome_fantasia = filter_input(INPUT_POST, 'nome_fantasia', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $cnpj = filter_input(INPUT_POST, 'cnpj', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
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
    if((isset($_POST["cnpjAtual"])) and (!empty($_POST))){
        $sql = "UPDATE pessoas SET razao_social = ?, nome_fantasia = ?, cnpj = ?, email = ?, endereco = ?, contato = ?, cargo = ? WHERE cnpj = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssss",$razao_social, $nome_fantasia, $cnpj, $email, $endereco, $contato, $cargo, $cnpjAtual);

        if($stmt->execute()){
            $_SESSION['resposta'] = "Pessoa editada com sucessso!";
        } else {
            $_SESSION['resposta'] = "Erro ao editar pessoa: " . $stmt->error;
        }

    } else {
        $_SESSION['resposta'] = "Variável POST ínvalida!";
    }
} else {
    $_SESSION['resposta'] = "Método de solicitação ínvalido!";
}

header("Location: ../../admin/pessoas/pessoas_juridica.php");
exit();