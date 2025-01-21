<?php
include("../utils/conexao.php");
include("../../auth/valida.php");

if($_SERVER["REQUEST_METHOD"] === 'POST'){
    $id = $_POST['id'];
    $status = $_POST["status"];

    if(isset($_POST["id"]) and !empty($_POST)){
        $deletar = $_POST["deletar"];
        if($deletar != 1){
            if($status == 1){
                $sql = "UPDATE subgrupo SET status = 0 WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $id);
                
                if ($stmt->execute()) {
                    $_SESSION['resposta'] = "Sub-grupo foi desativado com sucesso!";
                } else {
                    $_SESSION['resposta'] = "Erro ao desativar Sub-grupo: " . $stmt->error;
                }
            } else {
                $sql = "UPDATE subgrupo SET status = 1 WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $id);
                
                if ($stmt->execute()) {
                    $_SESSION['resposta'] = "Sub-grupo foi reintegrado com sucesso!";
                } else {
                    $_SESSION['resposta'] = "Erro ao desativar Sub-grupo: " . $stmt->error;
                }
            }
        } else {
            $sql = "DELETE FROM subgrupo WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $id);
            
            if ($stmt->execute()) {
                $_SESSION['resposta'] = "Sub-grupo foi deletado com sucesso!";
            } else {
                $_SESSION['resposta'] = "Erro ao deletar Sub-grupo: " . $stmt->error;
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
header("Location: ../../admin/subgrupos/subgrupos.php");
exit;
