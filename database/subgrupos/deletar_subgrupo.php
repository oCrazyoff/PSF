<?php
include("../utils/conexao.php");
include("../../auth/valida.php");

$id = $_POST['id'];
$status = $_POST["status"];

if ($status == 1) {
    $sql = "UPDATE subgrupo SET status = 0 WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $id);

    if ($stmt->execute()) {
        $_SESSION['resposta'] = "Sub Grupo deletado com sucesso!";
    } else {
        $_SESSION['resposta'] = "Erro ao deletar Sub Grupo: " . $stmt->error;
    }
} else {
    $sql = "UPDATE subgrupo SET status = 1 WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $id);

    if ($stmt->execute()) {
        $_SESSION['resposta'] = "Sub Grupo reintegrado com sucesso!";
    } else {
        $_SESSION['resposta'] = "Erro ao deletar Sub Grupo: " . $stmt->error;
    }
}



header("Location: ../../admin/subgrupos/subgrupos.php");
exit;
