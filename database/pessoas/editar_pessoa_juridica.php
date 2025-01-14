<?php
include("../utils/conexao.php");
include("../../auth/valida.php");

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $cnpjAtual = $_POST["cnpjAtual"];
    if((isset($_POST["cnpjAtual"])) and (!empty($_POST))){
        $razao_social = $_POST["razao_social"];
        $nome_fantasia = $_POST["nome_fantasia"];
        $cnpj = $_POST["cnpj"];
        $email = $_POST["email"];
        $endereco = $_POST["endereco"];
        $contato = $_POST["contato"];
        $cargo = $_POST["cargo"];

        $sql = "UPDATE pessoas SET razao_social = ?, nome_fantasia = ?, cnpj = ?, email = ?, endereco = ?, contato = ?, cargo = ? WHERE cnpj = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssss",$razao_social, $nome_fantasia, $cnpj, $email, $endereco, $contato, $cargo, $cnpjAtual);

        if($stmt->execute()){
            $_SESSION['resposta'] = "Pessoa editada com sucessso!";
        } else {
            $_SESSION['resposta'] = "Erro ao editar pessoa: " . $stmt->error;
        }

    } else {
        $_SESSION['resposta'] = "Variável POST ínvalida!";
    }
} else {
    $_SESSION['resposta'] = "Método de solicitação ínvalido!";
}

header("Location: ../../admin/pessoas/pessoas_juridica.php");
exit();