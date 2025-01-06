<?php
include("../utils/conexao.php");
include("../../auth/valida.php");

$cpf = $_POST["cpf"];
$status = $_POST["status"];
$hoje = date('Y-m-d');

if($status == 1){
    $sql = "UPDATE funcionarios SET status = 0, data_demicao = ? WHERE cpf = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $hoje, $cpf);
} else {
    $sql = "UPDATE funcionarios SET status = 1, data_demicao = null WHERE cpf = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $cpf);
}

if($status == 1){
    if ($stmt->execute()) {
        $_SESSION['resposta'] = "Funcionário deletado com sucesso!";
    } else {
        $_SESSION['resposta'] = "Erro ao deletar Funcionário: " . $stmt->error;
    }
} else {
    if ($stmt->execute()) {
        $_SESSION['resposta'] = "Funcionário reintegrado com sucesso!";
    } else {
        $_SESSION['resposta'] = "Erro ao reintegrar Funcionário: " . $stmt->error;
    }
}


header("Location: ../../admin/funcionarios/funcionarios.php");
exit;
