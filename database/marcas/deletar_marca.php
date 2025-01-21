<?php
include("../utils/conexao.php");
include("../../auth/valida.php");

if($_SERVER["REQUEST_METHOD"]){
    $id = $_POST['id'];
    $status = $_POST["status"];
    if(isset($_POST["id"]) and !empty($_POST)){
        $deletar = $_POST["deletar"];
        if($deletar != 1){
            if($status == 1){
                $sql = "UPDATE marcas SET status = 0 WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $id);
                
                if ($stmt->execute()) {
                    $_SESSION['resposta'] = "Marca foi desativada com sucesso!";
                } else {
                    $_SESSION['resposta'] = "Erro ao desativar marca: " . $stmt->error;
                }
            } else {
                $sql = "UPDATE marcas SET status = 1 WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $id);
                
                if ($stmt->execute()) {
                    $_SESSION['resposta'] = "Marca foi reintegrada com sucesso!";
                } else {
                    $_SESSION['resposta'] = "Erro ao reintegrar marca: " . $stmt->error;
                }
            }
        } else {
            $sql = "DELETE FROM marcas WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $id);
            
            if ($stmt->execute()) {
                $_SESSION['resposta'] = "Marca deletada com sucesso!";
            } else {
                $_SESSION['resposta'] = "Erro ao deletar marca: " . $stmt->error;
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
header("Location: ../../admin/marcas/marcas.php");
exit;
