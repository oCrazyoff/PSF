<?php
include("../utils/conexao.php");
include("../../auth/valida.php");

$nome = $_POST['nome'];

$sql = "INSERT INTO marcas (nome) VALUES (?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $nome);

if ($stmt->execute()) {
    $_SESSION['resposta'] = "Marca cadastrada com sucesso!";
} else {
    $_SESSION['resposta'] = "Erro ao cadastrar marca: " . $stmt->error;
}

header("Location: ../../admin/marcas/marcas.php");
exit;
