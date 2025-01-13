<?php
include("../utils/conexao.php");
include("../../auth/valida.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cnpj = $_POST["cnpj"];
    $status = $_POST["status"];
    if ((isset($_POST["cnpj"])) and (!empty($_POST))) {
        if($status == 1){
            $sql = "UPDATE fornecedores SET status = 0 WHERE cnpj = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $cnpj);
        } else {
            $sql = "UPDATE fornecedores SET status = 1 WHERE cnpj = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $cnpj);
        }

        if ($status == 1) {
            if ($stmt->execute()) {
                $_SESSION['resposta'] = "Fornecedor deletado com sucesso!";
            } else {
                $_SESSION['resposta'] = "Erro ao deletar Fornecedor: " . $stmt->error;
            }
        } else {
            if ($stmt->execute()) {
                $_SESSION['resposta'] = "Fornecedor reintegrado com sucesso!";
            } else {
                $_SESSION['resposta'] = "Erro ao reintegrar Fornecedor: " . $stmt->error;
            }
        }
    } else {
        $_SESSION['resposta'] = "Variável POST ínvalida!";
    }
} else {
    $_SESSION['resposta'] = "Método de solicitação ínvalido!";
}

header("Location: ../../admin/fornecedores/fornecedores.php");
exit();
