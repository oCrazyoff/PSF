<?php
include("../utils/conexao.php");
include("../../auth/valida.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cnpj = filter_input(INPUT_POST, "cnpj", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $status = filter_input(INPUT_POST, "status", FILTER_SANITIZE_NUMBER_INT);
    $deletar = filter_input(INPUT_POST, "deletar", FILTER_SANITIZE_NUMBER_INT);
    if ((isset($_POST["cnpj"])) and (!empty($_POST))) {
        if($deletar != 1){
            if ($status == 1) {
                $sql = "UPDATE fornecedores SET status = 0 WHERE cnpj = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $cnpj);
    
                if ($stmt->execute()) {
                    $_SESSION['resposta'] = "Fornecedor foi desativado com sucesso!";
                } else {
                    $_SESSION['resposta'] = "Erro ao desativar Fornecedor: " . $stmt->error;
                }
            } else {
                $sql = "UPDATE fornecedores SET status = 1 WHERE cnpj = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $cnpj);
    
                if ($stmt->execute()) {
                    $_SESSION['resposta'] = "Fornecedor foi reintegrado com sucesso!";
                } else {
                    $_SESSION['resposta'] = "Erro ao reintegrar Fornecedor: " . $stmt->error;
                }
            }
        } else {
            $sql = "DELETE FROM fornecedores WHERE cnpj = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $cnpj);

            if ($stmt->execute()) {
                $_SESSION['resposta'] = "Fornecedor foi deletado com sucesso!";
            } else {
                $_SESSION['resposta'] = "Erro ao deletar Fornecedor: " . $stmt->error;
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
