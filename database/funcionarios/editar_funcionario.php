<?php
include("../utils/conexao.php");
include("../../auth/valida.php");

$id = $_POST['id'];
$nome = $_POST['nome'];
$codigo = $_POST['codigo'];
$fornecedor = $_POST['fornecedor'];
$marca = $_POST['marca'];
$grupo = $_POST['grupo'];
$preco_custo = floatval($_POST['preco_custo']);
$preco_venda = floatval($_POST['preco_venda']);
$quantidade = intval($_POST['quantidade']);
$validade = $_POST['validade'];
$sub_grupo = $_POST['sub_grupo'];

if (!DateTime::createFromFormat('Y-m-d', $validade)) {
    $_SESSION['resposta'] = "Data de validade inválida!";
    header("Location: ../../admin/produtos/cadastro_produto.php");
    exit;
}

$sql = "UPDATE produtos SET nome = ?, codigo_barra = ?, fornecedor = ?, preco_custo = ?, preco_venda = ?, quantidade = ?, subgrupo = ?, grupo = ?, marca = ?, validade = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssssssi", $nome, $codigo, $fornecedor, $preco_custo, $preco_venda, $quantidade, $sub_grupo, $grupo, $marca, $validade, $id);

if ($stmt->execute()) {
    $_SESSION['resposta'] = "Produto editado com sucessso!";
} else {
    $_SESSION['resposta'] = "Erro ao editar produto: " . $stmt->error;
}

header("Location: ../../admin/produtos/produtos.php");
exit;