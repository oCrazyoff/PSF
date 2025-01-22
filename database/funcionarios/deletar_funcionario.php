<?php
include("../utils/conexao.php");
include("../../auth/valida.php");

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    $status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_NUMBER_INT);
    $deletar = filter_input(INPUT_POST, 'deletar', FILTER_SANITIZE_NUMBER_INT);

    if (isset($_POST["id"]) and !empty($_POST)) {
        if ($deletar != 1) {
            $hoje = date('Y-m-d');

            if ($status == 1) {
                $sql = "UPDATE funcionarios SET status = 0, data_demissao = ? WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ss", $hoje, $id);

                if ($stmt->execute()) {
                    $_SESSION['resposta'] = "Funcionário foi demitido com sucesso!";
                } else {
                    $_SESSION['resposta'] = "Erro ao demitir Funcionário: " . $stmt->error;
                }
            } else {
                $sql = "UPDATE funcionarios SET status = 1, data_demissao = null WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $id);

                if ($stmt->execute()) {
                    $_SESSION['resposta'] = "Funcionário foi reintegrado com sucesso!";
                } else {
                    $_SESSION['resposta'] = "Erro ao reintegrar Funcionário: " . $stmt->error;
                }
            }
        } else {
            $sql = "DELETE FROM funcionarios WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $id);

            if ($stmt->execute()) {
                $_SESSION['resposta'] = "Funcionário foi deletado com sucesso!";
            } else {
                $_SESSION['resposta'] = "Erro ao deletar Funcionário: " . $stmt->error;
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
header("Location: ../../admin/funcionarios/funcionarios.php");
exit;
