<?php
include("../utils/conexao.php");
include("../../auth/valida.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_NUMBER_INT);
    $deletar = filter_input(INPUT_POST, 'deletar', FILTER_SANITIZE_NUMBER_INT);
    if ((isset($_POST["id"])) and (!empty($_POST))) {
        if($deletar != 1){
            if ($status == 1) {
                $sql = "UPDATE pessoas SET status = 0 WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $id);
    
                if ($stmt->execute()) {
                    $_SESSION['resposta'] = "Pessoa foi desativada com sucesso!";
                } else {
                    $_SESSION['resposta'] = "Erro ao desativar Pessoa: " . $stmt->error;
                }
            } else {
                $sql = "UPDATE pessoas SET status = 1 WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $id);
    
                if ($stmt->execute()) {
                    $_SESSION['resposta'] = "Pessoa foi reintegrada com sucesso!";
                } else {
                    $_SESSION['resposta'] = "Erro ao reintegrar Pessoa: " . $stmt->error;
                }
            }
        } else {
            $sql = "DELETE FROM pessoas WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $id);

            if ($stmt->execute()) {
                $_SESSION['resposta'] = "Pessoa foi deletada com sucesso!";
            } else {
                $_SESSION['resposta'] = "Erro ao deletar Pessoa: " . $stmt->error;
            }
        }
    } else {
        $_SESSION['resposta'] = "Variável POST ínvalida!";
    }
} else {
    $_SESSION['resposta'] = "Método de solicitação ínvalido!";
}

header("Location: ../../admin/pessoas/pessoas_juridica.php");
exit();