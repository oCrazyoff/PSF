<?php
include("../utils/conexao.php");
include("../../auth/valida.php");

$id = $_POST['id'];
$nome = $_POST['nome'];
$grupo = $_POST['grupo'];

$sql = "UPDATE subgrupo SET nome = ?, grupo_id = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sis", $nome, $grupo, $id);

if ($stmt->execute()) {
    $_SESSION['resposta'] = "Sub Grupo editado com sucesso!";
} else {
    $_SESSION['resposta'] = "Erro ao editar Sub Grupo: " . $stmt->error;
}

header("Location: ../../admin/subgrupos/subgrupos.php");
exit;
