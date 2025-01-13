<?php
include("../utils/conexao.php");
include("../../auth/valida.php");

$id = $_POST["id"];
$status = $_POST["status"];
$hoje = date('Y-m-d');

if ($status == 1) {
    $sql = "UPDATE funcionarios SET status = 0, data_demissao = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $hoje, $id);
    
    if ($stmt->execute()) {
        $_SESSION['resposta'] = "Funcionário deletado com sucesso!";
    } else {
        $_SESSION['resposta'] = "Erro ao deletar Funcionário: " . $stmt->error;
    }
} else {
    $sql = "UPDATE funcionarios SET status = 1, data_demissao = null WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $id);

    if ($stmt->execute()) {
        $_SESSION['resposta'] = "Funcionário reintegrado com sucesso!";
    } else {
        $_SESSION['resposta'] = "Erro ao reintegrar Funcionário: " . $stmt->error;
    }
}

header("Location: ../../admin/funcionarios/funcionarios.php");
exit;