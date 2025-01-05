<?php
include("../utils/conexao.php");
include("../../auth/valida.php");

$nome = $_POST['nome'];
$codigo = $_POST['codigo'];
$fornecedor = $_POST['fornecedor'];
$marca = $_POST['marca'];
$grupo = $_POST['grupo'];
$preco_custo = floatval($_POST['preco_custo']);
$preco_venda = floatval($_POST['preco_venda']);
$quantidade = intval($_POST['quantidade']);
$validade = $_POST['validade'];
$subgrupo = $_POST['subgrupo'];

if (!DateTime::createFromFormat('Y-m-d', $validade)) {
    $_SESSION['resposta'] = "Data de validade inválida!";
    header("Location: ../../admin/produtos/cadastro_produto.php");
    exit;
}

$sql = "INSERT INTO produtos (nome, codigo_barra, fornecedor, preco_custo, preco_venda, quantidade, subgrupo, grupo, marca, validade) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssssss", $nome, $codigo, $fornecedor, $preco_custo, $preco_venda, $quantidade, $subgrupo, $grupo, $marca, $validade);

if ($stmt->execute()) {
    $_SESSION['resposta'] = "Produto cadastrado com sucessso!";
} else {
    $_SESSION['resposta'] = "Erro ao cadastrar produto: " . $stmt->error;
}

header("Location: ../../admin/produtos/produtos.php");
exit;
