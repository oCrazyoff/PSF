<?php
include("../utils/conexao.php");
include("../../auth/valida.php");

$id = $_POST['id'];

$sqlVerifica = "SELECT status FROM produtos WHERE id = ?";
$stmt = $conn->prepare($sqlVerifica);
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($status);
$stmt->fetch();
$stmt->close();

if ($status == 1) {
    $sql = "UPDATE produtos SET status = 0 WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $_SESSION['resposta'] = "Produto deletado com sucesso!";
    } else {
        $_SESSION['resposta'] = "Erro ao deletar produto: " . $stmt->error;
    }
    $stmt->close();
} else {
    $sql = "UPDATE produtos SET status = 1 WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $_SESSION['resposta'] = "Produto ativado com sucesso!";
    } else {
        $_SESSION['resposta'] = "Erro ao ativar produto: " . $stmt->error;
    }
    $stmt->close();
}

header("Location: ../../admin/produtos/produtos.php");
exit;