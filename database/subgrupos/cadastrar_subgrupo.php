<?php
include("../utils/conexao.php");
include("../../auth/valida.php");

$nome = $_POST['nome'];
$grupo = $_POST['grupo'];

$sql = "INSERT INTO subgrupo (nome, grupo_id) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $nome, $grupo);

if ($stmt->execute()) {
    $_SESSION['resposta'] = "Sub Grupo cadastrado com sucesso!";
} else {
    $_SESSION['resposta'] = "Erro ao cadastrar Sub Grupo: " . $stmt->error;
}

header("Location: ../../admin/subgrupos/subgrupos.php");
exit;
