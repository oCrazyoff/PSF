<?php
include("../utils/conexao.php");
include("../../auth/valida.php");

$id = $_POST['id'];

$sql = "DELETE FROM marcas WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $id);

if ($stmt->execute()) {
    $_SESSION['resposta'] = "Marca deletada com sucesso!";
} else {
    $_SESSION['resposta'] = "Erro ao deletar marca: " . $stmt->error;
}

header("Location: ../../admin/marcas/marcas.php");
exit;
