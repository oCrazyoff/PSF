<?php
include("../utils/conexao.php");
include("../../auth/valida.php");

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    $nome = $_POST["nome"];
    $cpf = $_POST["cpf"];
    $email = $_POST["email"];
    $data_nascimento = $_POST["data_nascimento"];
    $endereco = $_POST["endereco"];
    $contato = $_POST["contato"];
    $tipo_pessoa = 1;
    $cargo = $_POST["cargo"];

    if (!DateTime::createFromFormat('Y-m-d', $data_nascimento)) {
        $_SESSION['resposta'] = "Data de nascimento inválida!";
        header("Location: ../../admin/pessoas/pessoas_fisica.php");
        exit;
    }

    if ((isset($_POST["cpf"])) and (!empty($_POST))) {

        $sql = "INSERT INTO pessoas (nome, cpf, email,data_nascimento, endereco, contato, tipo_pessoa, cargo) VALUES (?,?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssss", $nome, $cpf, $email, $data_nascimento, $endereco, $contato, $tipo_pessoa, $cargo);

        if($stmt->execute()){
            $_SESSION['resposta'] = "Pessoa cadastrada com sucessso!";
        } else {
            $_SESSION['resposta'] = "Erro ao cadastrar pessoa: " . $stmt->error;
        }
    } else {
        $_SESSION['resposta'] = "Variável POST ínvalida!";
    }
} else {
    $_SESSION['resposta'] = "Método de solicitação ínvalido!";
}

header("Location: ../../admin/pessoas/pessoas_fisica.php");
exit();
