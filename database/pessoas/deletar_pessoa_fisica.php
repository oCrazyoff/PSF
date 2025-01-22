<?php
include("../utils/conexao.php");
include("../../auth/valida.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $cpfAtual = filter_input(INPUT_POST, 'cpfAtual', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_NUMBER_INT);
    $deletar = filter_input(INPUT_POST, 'deletar', FILTER_SANITIZE_NUMBER_INT);
    if ((isset($_POST["cpfAtual"])) and (!empty($_POST))) {
        if ($deletar != 1) {
            if ($status == 1) {

                if($cpfAtual == ""){
                    $sql = "UPDATE pessoas SET status = 0 WHERE email = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("s", $email);
                } else {
                    $sql = "UPDATE pessoas SET status = 0 WHERE cpf = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("s", $cpfAtual);
                }
                
                if ($stmt->execute()) {
                    $_SESSION['resposta'] = "Pessoa deletada com sucesso!";
                } else {
                    $_SESSION['resposta'] = "Erro ao deletar Pessoa: " . $stmt->error;
                }
            } else {
                $sql = "UPDATE pessoas SET status = 1 WHERE cpf = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $cpfAtual);

                if ($stmt->execute()) {
                    $_SESSION['resposta'] = "Pessoa reintegrado com sucesso!";
                } else {
                    $_SESSION['resposta'] = "Erro ao reintegrar Pessoa: " . $stmt->error;
                }
            }
        } else {

            if($cpfAtual == ""){
                $sql = "DELETE FROM pessoas WHERE email = ?";   
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $email);
            } else {
                $sql = "DELETE FROM pessoas WHERE cpf = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $cpfAtual);
            }
            
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $cpfAtual);

            if ($stmt->execute()) {
                $_SESSION['resposta'] = "Pessoa deletada com sucesso!";
            } else {
                $_SESSION['resposta'] = "Erro ao deletar pessoa: " . $stmt->error;
            }
        }
    } else {
        $_SESSION['resposta'] = "Variável POST inválida!";
    }
} else {
    $_SESSION['resposta'] = "Método de solicitação inválido!";
}

$conn->close();

header("Location: ../../admin/pessoas/pessoas_fisica.php");
exit();
?>