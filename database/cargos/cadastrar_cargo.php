<?php
include("../utils/conexao.php");
include("../../auth/valida.php");

$nome = $_POST['nome'];

$sql = "INSERT INTO cargos (nome) VALUES (?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $nome);

if ($stmt->execute()) {
    $_SESSION['resposta'] = "Cargo cadastrado com sucesso!";
} else {
    $_SESSION['resposta'] = "Erro ao cadastrar cargo: " . $stmt->error;
}

header("Location: ../../admin/cargos/cargos.php");
exit;
