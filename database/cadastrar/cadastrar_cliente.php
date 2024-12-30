<?php 
include("../../database/utils/conexao.php");

$nome = $_POST["nome"];
$cpf = $_POST["cpf"];
$email = $_POST["email"];
$senha = $_POST["senha"];
$confirma_senha = $_POST["confirma_senha"];

if($senha != $confirma_senha){
    $resposta = "Usuário ou senha incorreto!";
    header("Location: ../../pages/cadastrese.php?resposta=$resposta");
    die();
}

$sql = "INSERT INTO pessoas (nome, cpf, email, senha) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $nome, $cpf, $email, $senha);

if($stmt->execute()){
    $resposta = "Usuário cadastrado com sucesso!";
    header("Location: ../../index.php?resposta=$resposta");
    die();
} else {
    $resposta = "Usuário deu erro!";
    header("Location: ../../index.php?resposta=$resposta");
    die();
}

?>