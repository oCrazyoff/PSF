<?php
include("../utils/conexao.php");
include("../../auth/valida.php");

if($_SERVER["REQUEST_METHOD"] === 'POST'){
    $id = $_POST['id'];
    if(isset($_POST['id']) and !empty($_POST)){
        $deletar = $_POST['deletar'];
        $status = $_POST['status'];
        if($deletar != 1){
            if($status == 1){
                $sql = "UPDATE produtos SET status = 0 WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $id);

                if($stmt->execute()){
                    $_SESSION['resposta'] = "Produto foi desativado com sucesso!";
                } else {
                    $_SESSION['resposta'] = "Erro ao desativar produto: " . $stmt->error;
                }
            } else {
                $sql = "UPDATE produtos SET status = 1 WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $id);

                if($stmt->execute()){
                    $_SESSION['resposta'] = "Produto foi ativado com sucesso!";
                } else {
                    $_SESSION['resposta'] = "Erro ao ativar produto: " . $stmt->error;
                }
            }
        } else {
            $sql = "DELETE FROM produtos WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id);

            if($stmt->execute()){
                $_SESSION['resposta'] = "Produto foi deletado com sucesso!";
            } else {
                $_SESSION['resposta'] = "Erro ao deletar produto: " . $stmt->error;
            }
        }
    } else {
        $_SESSION['resposta'] = "Variável POST ínvalida!";
    }
} else {
    $_SESSION['resposta'] = "Método de solicitação ínvalido!";
}

header("Location: ../../admin/produtos/produtos_adm.php");
exit;
