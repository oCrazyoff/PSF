<?php
include("../utils/conexao.php");
include("../../auth/valida.php");

$id = $_POST['id'];
$status = $_POST["status"];

if ($status == 1) {
    $sql = "UPDATE grupos SET status = 0 WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $id);

    if ($stmt->execute()) {
        $_SESSION['resposta'] = "Grupo deletado com sucesso!";
    } else {
        $_SESSION['resposta'] = "Erro ao deletar grupo: " . $stmt->error;
    }
} else {
    $sql = "UPDATE grupos SET status = 1 WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $id);

    if ($stmt->execute()) {
        $_SESSION['resposta'] = "Grupo reintegrado com sucesso!";
    } else {
        $_SESSION['resposta'] = "Erro ao deletar grupo: " . $stmt->error;
    }
}

header("Location: ../../admin/grupos/grupos.php");
exit;
