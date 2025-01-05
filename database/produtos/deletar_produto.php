<?php
include("../utils/conexao.php");
include("../../auth/valida.php");

$id = $_POST['id'];

$sql = "UPDATE produtos SET status = 0 WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    $_SESSION['resposta'] = "Produto deletado com sucesso!";
} else {
    $_SESSION['resposta'] = "Erro ao deletar produto: " . $stmt->error;
}

header("Location: ../../admin/produtos/produtos.php");
exit;
