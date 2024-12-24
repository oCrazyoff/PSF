<?php
include("../utils/conexao.php");

$email = $_POST["email"];
$senha = $_POST["senha"];

$sql = "SELECT * FROM pessoas WHERE email = ? AND senha = ?";
$stmt = $conn->prepare($sql);

if ($stmt) {
    if ($stmt->bind_param("ss", $email, $senha)) {

        if ($stmt->execute()) {
            header("Location: ../../pages/inicio.php");
        } else {
            header("location: ../index.php?erro=1");
            die;
        }
    } else {
        header("location: ../index.php?erro=2");
        die;
    }
} else {
    header("location: ../index.php?erro=3");
    die;
}
