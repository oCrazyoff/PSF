<?php
include("../utils/conexao.php");
include("../../auth/valida.php");

$nome = $_POST['nome'];

$sql = "INSERT INTO grupos (nome) VALUES (?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $nome);

if ($stmt->execute()) {
    $_SESSION['resposta'] = "Grupo cadastrado com sucesso!";
} else {
    $_SESSION['resposta'] = "Erro ao cadastrar grupo: " . $stmt->error;
}

header("Location: ../../admin/grupos/grupos.php");
exit;
