<?php
include("../utils/conexao.php");
include("../../auth/valida.php");

$id = $_POST['id'];
$nome = $_POST['nome'];

$sql = "UPDATE marcas SET nome = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $nome, $id);

if ($stmt->execute()) {
    $_SESSION['resposta'] = "Marca editada com sucesso!";
} else {
    $_SESSION['resposta'] = "Erro ao editar marca: " . $stmt->error;
}

header("Location: ../../admin/marcas/marcas.php");
exit;
