<?php
include("../utils/conexao.php");
include("../../auth/valida.php");

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    $razao_social = $_POST["razao_social"];
    $nome_fantasia = $_POST["nome_fantasia"];
    $cnpj = $_POST["cnpj"];
    $email = $_POST["email"];
    $endereco = $_POST["endereco"];
    $contato = $_POST["contato"];
    $tipo_pessoa = 2;
    $cargo = $_POST["cargo"];

    if ((isset($_POST["cnpj"])) and (!empty($_POST))) {

        $sql = "INSERT INTO pessoas (razao_social, nome_fantasia, cnpj, email, endereco, contato, tipo_pessoa, cargo) VALUES (?,?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssss", $razao_social, $nome_fantasia, $cnpj, $email, $endereco, $contato, $tipo_pessoa, $cargo);

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

header("Location: ../../admin/pessoas/pessoas_juridica.php");
exit();