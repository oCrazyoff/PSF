<?php
include("../utils/conexao.php");
include("../../auth/valida.php");

$cnpjAtual = $_POST["cnpjAtual"];
$cnpj = $_POST["cnpj"];
$razao_social = $_POST["razao_social"];
$nome_fantasia = $_POST["nome_fantasia"];
$endereco = $_POST["endereco"];
$contato = $_POST["contato"];


$sql = "UPDATE pessoas SET cnpj = ?, razao_social = ?, nome_fantasia = ?, endereco = ?, contato = ? WHERE cnpj = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssss",$cnpj, $razao_social, $nome_fantasia, $endereco, $contato, $cnpjAtual);


if($stmt->execute()){
    $_SESSION["resposta"] = "Fornecedor editado com sucesso!";
} else {
    $_SESSION["resposta"] = "Fornecedor não editado!";
}

header("Location: ../../admin/fornecedores/fornecedores.php");
exit();

