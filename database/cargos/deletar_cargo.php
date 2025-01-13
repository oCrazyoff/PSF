<?php
include("../utils/conexao.php");
include("../../auth/valida.php");

$id = $_POST['id'];

$sql = "UPDATE cargos SET status = NULL WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $id);

if ($stmt->execute()) {
    $_SESSION['resposta'] = "Cargo deletado com sucesso!";
} else {
    $_SESSION['resposta'] = "Erro ao deletar cargo: " . $stmt->error;
}

header("Location: ../../admin/cargos/cargos.php");
exit;
