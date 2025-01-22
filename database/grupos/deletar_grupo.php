<?php
include("../utils/conexao.php");
include("../../auth/valida.php");

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    $status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_NUMBER_INT);
    $deletar = filter_input(INPUT_POST, 'deletar', FILTER_SANITIZE_NUMBER_INT);

    if (isset($_POST["id"]) and !empty($_POST)) {
        if ($deletar != 1) {
            if ($status == 1) {
                $sql = "UPDATE grupos SET status = 0 WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $id);

                if ($stmt->execute()) {
                    $_SESSION['resposta'] = "Grupo desativado com sucesso!";
                } else {
                    $_SESSION['resposta'] = "Erro ao desativar grupo: " . $stmt->error;
                }
            } else {
                $sql = "UPDATE grupos SET status = 1 WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $id);

                if ($stmt->execute()) {
                    $_SESSION['resposta'] = "Grupo reintegrado com sucesso!";
                } else {
                    $_SESSION['resposta'] = "Erro ao reintegrar grupo: " . $stmt->error;
                }
            }
        } else {
            $sql = "DELETE FROM grupos WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $id);

            if ($stmt->execute()) {
                $_SESSION['resposta'] = "Grupo foi deletado com sucesso!";
            } else {
                $_SESSION['resposta'] = "Erro ao deletar grupo: " . $stmt->error;
            }
        }
    } else {
        $_SESSION['resposta'] = "Variável POST ínvalida!";
    }
} else {
    $_SESSION['resposta'] = "Método de solicitação ínvalido!";
}

$conn->close();
$stmt->close();
header("Location: ../../admin/grupos/grupos.php");
exit;
