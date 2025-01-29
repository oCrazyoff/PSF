<?php
include("../utils/conexao.php");
include("../../auth/valida.php");

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    $razao_social = filter_input(INPUT_POST, 'razao_social', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $nome_fantasia = filter_input(INPUT_POST, 'nome_fantasia', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $cnpj = filter_input(INPUT_POST, 'cnpj', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $cnpjAntigo = filter_input(INPUT_POST, 'cnpjAntigo', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
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

    if ((isset($_POST["cnpj"])) && (!empty($_POST))) {
        $sqlPessoas = "UPDATE pessoas SET tipo_pessoa = ?, cargo = ?, contato = ?, endereco = ?, razao_social = ?, nome_fantasia = ?, cnpj = ? WHERE cnpj = ?";
        $stmtPessoas = $conn->prepare($sqlPessoas);
        $stmtPessoas->bind_param("iissssss", $tipo_pessoa, $cargo, $contato, $endereco, $razao_social, $nome_fantasia, $cnpj, $cnpjAntigo);

        if ($stmtPessoas->execute()) {
            $sql = "UPDATE fornecedores SET cnpj = ? WHERE cnpj = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $cnpj, $cnpjAntigo);

            if ($stmt->execute()) {
                $_SESSION['resposta'] = "Fornecedor atualizado com sucesso!";
            } else {
                $_SESSION['resposta'] = "Erro ao atualizar fornecedor: " . $stmt->error;
            }
        } else {
            $_SESSION['resposta'] = "Erro ao atualizar pessoa: " . $stmtPessoas->error;
        }
    } else {
        $_SESSION['resposta'] = "Variável POST inválida!";
    }
} else {
    $_SESSION['resposta'] = "Método de solicitação inválido!";
}

header("Location: ../../admin/fornecedores/fornecedores.php");
exit();
