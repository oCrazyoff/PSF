<?php
include("handler/utils/conexao.php");

$email = $_POST["email"];
$senha = $_POST["senha"];

echo ($email . $senha);

$sql("SELECT * FROM pessoas WHERE email = ?, senha = ?");
$stmt = $conn->prepare($sql);

$stmt->bind_param("ss", $email, $senha);
$stmt->execute();
$stmt->bind_result($nome);
$stmt->fetch();

echo($nome);
?>
