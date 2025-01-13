<?php
include("../utils/conexao.php");
include("../../auth/valida.php");

$id = $_POST['id'];

$sql = "UPDATE subgrupo SET status = NULL WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $id);

if ($stmt->execute()) {
    $_SESSION['resposta'] = "Sub Grupo deletado com sucesso!";
} else {
    $_SESSION['resposta'] = "Erro ao deletar Sub Grupo: " . $stmt->error;
}

header("Location: ../../admin/subgrupos/subgrupos.php");
exit;
