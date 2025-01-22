<?php
include("../utils/conexao.php");
include("../../auth/valida.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cnpjAtual = filter_input(INPUT_POST, 'cnpjAtual', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_NUMBER_INT);
    $deletar = filter_input(INPUT_POST, 'deletar', FILTER_SANITIZE_NUMBER_INT);
    if ((isset($_POST["cnpjAtual"])) and (!empty($_POST))) {
        if($deletar != 1){
            if ($status == 1) {
                if($cnpjAtual == $_SESSION['cnpj']){
                    $_SESSION['resposta'] = "Você não pode desativar a si mesmo!";
                    header("Location: ../../admin/pessoas/pessoas_juridica.php");
                    exit();
                }
                $sql = "UPDATE pessoas SET status = 0 WHERE cnpj = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $cnpjAtual);
    
                if ($stmt->execute()) {
                    $_SESSION['resposta'] = "Pessoa foi desativada com sucesso!";
                } else {
                    $_SESSION['resposta'] = "Erro ao desativar Pessoa: " . $stmt->error;
                }
            } else {
                $sql = "UPDATE pessoas SET status = 1 WHERE cnpj = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $cnpjAtual);
    
                if ($stmt->execute()) {
                    $_SESSION['resposta'] = "Pessoa foi reintegrada com sucesso!";
                } else {
                    $_SESSION['resposta'] = "Erro ao reintegrar Pessoa: " . $stmt->error;
                }
            }
        } else {
            if($cnpjAtual == $_SESSION['cnpj']){
                $_SESSION['resposta'] = "Você não pode deletar a si mesmo!";
                header("Location: ../../admin/pessoas/pessoas_juridica.php");
                exit();
            }
            $sql = "DELETE FROM pessoas WHERE cnpj = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $cnpjAtual);

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