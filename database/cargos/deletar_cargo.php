<?php
include("../utils/conexao.php");
include("../../auth/valida.php");

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    $id = $_POST["id"];
    $status = $_POST["status"];
    if ((isset($_POST["id"])) and (!empty($_POST))) {
        $deletar = $_POST["deletar"];
        if($deletar != 1){
            if ($status == 1) {
                $sql = "UPDATE cargos SET status = 0 WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $id);
    
                if ($stmt->execute()) {
                    $_SESSION['resposta'] = "Cargo deletado com sucesso!";
                } else {
                    $_SESSION['resposta'] = "Erro ao deletar cargo: " . $stmt->error;
                }
            } else {
                $sql = "UPDATE cargos SET status = 1 WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $id);
    
                if ($stmt->execute()) {
                    $_SESSION['resposta'] = "Cargo reintegrado com sucesso!";
                } else {
                    $_SESSION['resposta'] = "Erro ao reintegrar cargo: " . $stmt->error;
                }
            }
        } else {
            $sql = "DELETE FROM cargos WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $id);

            $sqlPermissoes = "DELETE FROM permissoes WHERE cargo_id = ?";
            $stmtPermissoes = $conn->prepare($sqlPermissoes);
            $stmtPermissoes->bind_param("s", $id);
    
            if ($stmt->execute() AND $stmtPermissoes->execute()) {
                $_SESSION['resposta'] = "Cargo deletado com sucesso!";
            } else {
                $_SESSION['resposta'] = "Erro ao deletar cargo: " . $stmt->error;
            }
        }

    } else {
        $_SESSION['resposta'] = "Variável POST ínvalida!";
    }
} else {
    $_SESSION['resposta'] = "Método de solicitação ínvalido!";
}

header("Location: ../../admin/cargos/cargos.php");
exit;
