<?php
include("../utils/conexao.php");
include("../../auth/valida.php");

$id = $_POST['id'];
$status = $_POST["status"];
$deletar = $_POST["deletar"];

if($deletar == 0){
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

$conn->close();
$stmt->close();
header("Location: ../../admin/marcas/marcas.php");
exit;
