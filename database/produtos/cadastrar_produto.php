<?php
include("../utils/conexao.php");

$nome = $_POST['nome'];
$codigo = $_POST['codigo'];
$fornecedor = $_POST['fornecedor'];
$marca = $_POST['marca'];
$grupo = $_POST['grupo'];
$preco_custo = $_POST['preco_custo'];
$preco_venda = $_POST['preco_venda'];
$quantidade = $_POST['quantidade'];
$validade = $_POST['validade'];
$sub_grupo = $_POST['sub_grupo'];

$sql = "INSERT INTO produtos (nome,codigo_barra,fornecedor,preco_custo,preco_venda,quantidade,subgrupo,grupo,marca) VALUES (?,?,?,?,?,?,?,?,?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssssss", $nome, $codigo, $fornecedor, $preco_custo, $preco_venda, $quantidade, $sub_grupo, $grupo, $marca);
$stmt->execute();

header("Location: ../../admin/produtos.php");