<?php
include("../utils/conexao.php");
include("../../auth/valida.php");

$cpf = $_POST["cpf"];
$salario = $_POST["salario"];
$data_admissao = $_POST["data_admissao"];
$cargo = $_POST["cargo"];

if (!DateTime::createFromFormat('Y-m-d', $data_admissao)) {
    $_SESSION['resposta'] = "Data de validade inválida!";
    header("Location: ../../admin/produtos/cadastro_produto.php");
    exit;
}

$sqlFuncionarios = "INSERT INTO funcionarios (cpf, salario, data_admicao) VALUES (?, ?, ?)";
$stmtFuncionarios = $conn->prepare($sqlFuncionarios);
$stmtFuncionarios->bind_param("sss", $cpf, $salario, $data_admissao);

$sqlPessoas = "UPDATE pessoas SET cargo = ? WHERE cpf = ?";
$stmtPessoas = $conn->prepare($sqlPessoas);
$stmtPessoas->bind_param("ss", $cargo, $cpf);

if ($stmtFuncionarios->execute() and $stmtPessoas->execute()) {
    $_SESSION['resposta'] = "Funcionário cadastrado com sucessso!";
} else {
    $_SESSION['resposta'] = "Erro ao cadastrar Funcionário: " . $stmt->error;
}

header("Location: ../../admin/produtos/produtos.php");
exit;