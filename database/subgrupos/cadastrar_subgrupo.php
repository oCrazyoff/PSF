<?php
include("../utils/conexao.php");
include("../../auth/valida.php");

$nome = $_POST['nome'];

$sql = "INSERT INTO subgrupo (nome) VALUES (?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $nome);

if ($stmt->execute()) {
    $_SESSION['resposta'] = "Sub Grupo cadastrado com sucesso!";
} else {
    $_SESSION['resposta'] = "Erro ao cadastrar Sub Grupo: " . $stmt->error;
}

header("Location: ../../admin/subgrupos/subgrupos.php");
exit;
