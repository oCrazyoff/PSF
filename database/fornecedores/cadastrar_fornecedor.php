<?php
include("../utils/conexao.php");
include("../../auth/valida.php");

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    $razao_social = filter_input(INPUT_POST, 'razao_social', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $nome_fantasia = filter_input(INPUT_POST, 'nome_fantasia', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $cnpj = filter_input(INPUT_POST, 'cnpj', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $cep = filter_input(INPUT_POST, 'cep', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $logradouro = filter_input(INPUT_POST, 'logradouro', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $numero = filter_input(INPUT_POST, 'numero', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $bairro = filter_input(INPUT_POST, 'bairro', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $complemento = filter_input(INPUT_POST, 'complemento', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $estado = filter_input(INPUT_POST, 'estado', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $cidade = filter_input(INPUT_POST, 'cidade', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $contato = filter_input(INPUT_POST, 'contato', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $tipo_pessoa = 2;
    $cargo = 5;
    $endereco = "$cep, $logradouro, $numero, $bairro, " . ($complemento == null ? "" : $complemento . ", ") . "$estado, $cidade";

    if ((isset($_POST["cnpj"])) and (!empty($_POST))) {

        $sqlPessoas = "INSERT INTO pessoas (cnpj, tipo_pessoa, cargo, contato, endereco, razao_social, nome_fantasia) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmtPessoas = $conn->prepare($sqlPessoas);
        $stmtPessoas->bind_param("siissss", $cnpj, $tipo_pessoa, $cargo, $contato, $endereco, $razao_social, $nome_fantasia);

        if ($stmtPessoas->execute()) {
            $sql = "INSERT INTO fornecedores (cnpj) VALUES (?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $cnpj);

            if ($stmt->execute()) {
                $_SESSION['resposta'] = "Fornecedor cadastrado com sucessso!";
            } else {
                $_SESSION['resposta'] = "Erro ao cadastrar fornecedor: " . $stmtPessoas->error;
            }
        } else {
            $_SESSION['resposta'] = "Erro ao cadastrar fornecedor: " . $stmt->error;
        }
    } else {
        $_SESSION['resposta'] = "Variável POST ínvalida!";
    }
} else {
    $_SESSION['resposta'] = "Método de solicitação ínvalido!";
}

header("Location: ../../admin/fornecedores/fornecedores.php");
exit();
