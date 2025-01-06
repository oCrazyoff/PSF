<?php
include("../utils/conexao.php");
include("../../auth/valida.php");

$nome = $_POST["nome"];
$cpf = $_POST["cpf"];
$email = $_POST["email"];
$data_nascimento = $_POST["data_nascimento"];
$endereco = $_POST["endereco"];
$contato = $_POST["contato"];
$salario = floatval($_POST["salario"]);
$data_admissao = $_POST["data_admissao"];
$cargo = $_POST["cargo"];

if (!DateTime::createFromFormat('Y-m-d', $data_admissao)) {
    $_SESSION['resposta'] = "Data de validade inválida!";
    header("Location: ../../admin/produtos/cadastro_produto.php");
    exit;
}

$sqlPessoas = "INSERT INTO pessoas (nome, cpf, email, data_nascimento, endereco, contato, cargo) VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmtPessoas = $conn->prepare($sqlPessoas);
$stmtPessoas->bind_param("sssssss", $nome, $cpf, $email, $data_nascimento, $endereco, $contato, $cargo);

$sqlFuncionarios = "INSERT INTO funcionarios (cpf, salario, data_admicao) VALUES (?, ?, ?)";
$stmtFuncionarios = $conn->prepare($sqlFuncionarios);
$stmtFuncionarios->bind_param("sds", $cpf, $salario, $data_admissao);


if ($stmtPessoas->execute() and $stmtFuncionarios->execute()) {
    $_SESSION['resposta'] = "Funcionário cadastrado com sucessso!";
} else {
    $_SESSION['resposta'] = "Erro ao cadastrar Funcionário: " . $stmt->error;
}

header("Location: ../../admin/funcionarios/funcionarios.php");
exit;
