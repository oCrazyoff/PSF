<?php
include("../utils/conexao.php");

$cnpj = $_POST["cnpj"];
$razao_social = $_POST["razao_social"];
$nome_fantasia = $_POST["nome_fantasia"];
$endereco = $_POST["endereco"];
$contato = $_POST["contato"];

$sql = "INSERT INTO pessoas (cnpj, razao_social, nome_fantasia, endereco, contato, tipo_pessoa, cargo) VALUES (?, ?, ?, ?, ?, 2, 5)";
$stmt = $conn->prepare($sql);

$sql_fornecedor = "INSERT INTO fornecedores (cnpj) VALUES (?)";
$stmt_fornecedor = $conn->prepare($sql_fornecedor);

if (!$stmt or !$stmt_fornecedor) {
    die("Erro ao preparar a consulta: " . $conn->error);
}

$stmt->bind_param("sssss", $cnpj, $razao_social, $nome_fantasia, $endereco, $contato);

$stmt_fornecedor->bind_param("s", $cnpj);

if ($stmt->execute() and $stmt_fornecedor->execute()) {
    $resposta = "Fornecedor cadastrado com sucesso!";
    header("Location: ../../admin/fornecedores/fornecedores.php?resposta=$resposta");
    die();
} else {
    $resposta = "Fornecedor deu erro!";
    header("Location: ../../admin/fornecedores/fornecedores.php?resposta=$resposta");
    die();
}

$stmt->close();
$conn->close();
