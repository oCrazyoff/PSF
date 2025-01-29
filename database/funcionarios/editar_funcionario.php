<?php
include("../utils/conexao.php");
include("../../auth/valida.php");

$idFuncionario = filter_input(INPUT_POST, 'idFuncionario', FILTER_SANITIZE_NUMBER_INT);
$idPessoa = filter_input(INPUT_POST, 'idPessoa', FILTER_SANITIZE_NUMBER_INT);
$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
$cpf = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS);
$data_nascimento = $_POST["data_nascimento"];
$cep = filter_input(INPUT_POST, 'cep', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$logradouro = filter_input(INPUT_POST, 'logradouro', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$numero = filter_input(INPUT_POST, 'numero', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$bairro = filter_input(INPUT_POST, 'bairro', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$complemento = filter_input(INPUT_POST, 'complemento', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$estado = filter_input(INPUT_POST, 'estado', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$cidade = filter_input(INPUT_POST, 'cidade', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$contato = filter_input(INPUT_POST, 'contato', FILTER_SANITIZE_SPECIAL_CHARS);
$salario = filter_input(INPUT_POST, 'salario', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
$data_admissao = $_POST["data_admissao"];
$cargo = filter_input(INPUT_POST, 'cargo', FILTER_SANITIZE_NUMBER_INT);
$endereco = "$cep, $logradouro, $numero, $bairro, " . ($complemento == null ? "" : $complemento . ", ") . "$estado, $cidade";

if (!DateTime::createFromFormat('Y-m-d', $data_nascimento)) {
    $_SESSION['resposta'] = "Data de nascimento inválida!";
    header("Location: ../../admin/produtos/cadastro_produto.php");
    exit;
}
if (!DateTime::createFromFormat('Y-m-d', $data_admissao)) {
    $_SESSION['resposta'] = "Data de admissão inválida!";
    header("Location: ../../admin/produtos/cadastro_produto.php");
    exit;
}

$sqlFuncionarios = "UPDATE funcionarios SET cpf = ?, salario = ?, data_admissao = ? WHERE id = ?";
$stmtFuncionarios = $conn->prepare($sqlFuncionarios);
$stmtFuncionarios->bind_param("sssi", $cpf, $salario, $data_admissao, $idFuncionario);

$sqlPessoas = "UPDATE pessoas SET nome = ?, cpf = ?, email = ?, data_nascimento = ?, endereco = ?, contato = ?, cargo = ? WHERE id = ?";
$stmtPessoas = $conn->prepare($sqlPessoas);
$stmtPessoas->bind_param("ssssssss", $nome, $cpf, $email, $data_nascimento, $endereco, $contato, $cargo, $idPessoa);

if ($stmtFuncionarios->execute() && $stmtPessoas->execute()) {
    $_SESSION['resposta'] = "Funcionario editado com sucesso!";
} else {
    $_SESSION['resposta'] = "Erro ao editar funcionario! Erro 1: " . $stmtFuncionarios->error . " Erro 2: " . $stmtPessoas->error;
}

header("Location: ../../admin/funcionarios/funcionarios.php");
exit;