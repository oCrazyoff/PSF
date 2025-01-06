<?php
include("../utils/conexao.php");
include("../../auth/valida.php");

$id = $_POST['id'];
$nome = $_POST['nome'];

$sql = "UPDATE grupos SET nome = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $nome, $id);

if ($stmt->execute()) {
    $_SESSION['resposta'] = "Grupo editado com sucesso!";
} else {
    $_SESSION['resposta'] = "Erro ao editar grupo: " . $stmt->error;
}

header("Location: ../../admin/grupos/grupos.php");
exit;
