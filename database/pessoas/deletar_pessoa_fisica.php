<?php
include("../utils/conexao.php");
include("../../auth/valida.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cpfAtual = $_POST["cpfAtual"];
    $status = $_POST["status"];
    if ((isset($_POST["cpfAtual"])) and (!empty($_POST))) {
        if ($status == 1) {
            $sql = "UPDATE pessoas SET status = 0 WHERE cpf = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $cpfAtual);

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
        $_SESSION['resposta'] = "Variável POST ínvalida!";
    }
} else {
    $_SESSION['resposta'] = "Método de solicitação ínvalido!";
}

header("Location: ../../admin/pessoas/pessoas_fisica.php");
exit();