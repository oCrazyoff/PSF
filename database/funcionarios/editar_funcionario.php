<?php
include("../utils/conexao.php");
include("../../auth/valida.php");

$idFuncionario = $_POST['id'];
$idPessoa = $_POST['idPessoa'];
$nome = $_POST["nome"];
$cpf = $_POST["cpf"];
$email = $_POST["email"];
$data_nascimento = $_POST["data_nascimento"];
$endereco = $_POST["endereco"];
$contato = $_POST["contato"];
$salario = floatval($_POST["salario"]);
$data_admissao = $_POST["data_admissao"];
$cargo = $_POST["cargo"];

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