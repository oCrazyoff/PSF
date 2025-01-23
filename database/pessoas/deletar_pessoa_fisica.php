<?php
include("../utils/conexao.php");
include("../../auth/valida.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    $email = filter_input(INPUT_POST, 'emailAtual', FILTER_SANITIZE_EMAIL);
    $status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_NUMBER_INT);
    $deletar = filter_input(INPUT_POST, 'deletar', FILTER_SANITIZE_NUMBER_INT);
    if ((isset($_POST["id"])) and (!empty($_POST))) {
        if ($deletar != 1) {
            if ($status == 1) {
                if ($_SESSION['email'] == $email) {
                    $_SESSION['resposta'] = "Você não pode desativar sua própria conta!";
                    header("Location: ../../admin/pessoas/pessoas_fisica.php");
                    exit();
                }
                $sql = "UPDATE pessoas SET status = 0 WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $id);

                if ($stmt->execute()) {
                    $_SESSION['resposta'] = "Pessoa foi desativa com sucesso!";
                } else {
                    $_SESSION['resposta'] = "Erro ao desativar Pessoa: " . $stmt->error;
                }
            } else {
                $sql = "UPDATE pessoas SET status = 1 WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $id);

                if ($stmt->execute()) {
                    $_SESSION['resposta'] = "Pessoa reintegrado com sucesso!";
                } else {
                    $_SESSION['resposta'] = "Erro ao reintegrar Pessoa: " . $stmt->error;
                }
            }
        } else {
            if ($_SESSION['email'] == $email) {
                $_SESSION['resposta'] = "Você não pode deletar sua própria conta!";
                header("Location: ../../admin/pessoas/pessoas_fisica.php");
                exit();
            }
            $sql = "DELETE FROM pessoas WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id);

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
