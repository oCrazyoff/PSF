<?php
include("../utils/conexao.php");
include("../../auth/valida.php");

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    $nome = $_POST["nome"];
    $cpf = $_POST["cpf"];
    $email = $_POST["email"];
    $data_nascimento = $_POST["data_nascimento"];
    $cep = $_POST['cep'];
    $logradouro = $_POST['rua'];
    $numero = $_POST['numero'];
    $bairro = $_POST["bairro"];
    $complemento = $_POST['complemento'];
    $estado = $_POST['estado'];
    $cidade = $_POST['cidade'];
    $contato = $_POST["contato"];
    $tipo_pessoa = 1;
    $endereco = "$cep, $logradouro, $numero, $bairro, " . ($complemento == null ? "" : $complemento . ", ") . "$estado, $cidade";
    if (!DateTime::createFromFormat('Y-m-d', $data_nascimento)) {
        $_SESSION['resposta'] = "Data de nascimento inválida!";
        header("Location: ../../admin/pessoas/pessoas_fisica.php");
        exit;
    }

    if ((isset($_POST["cpf"])) and (!empty($_POST))) {

        $sql = "INSERT INTO pessoas (nome, cpf, email,data_nascimento, endereco, contato, tipo_pessoa) VALUES (?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssss", $nome, $cpf, $email, $data_nascimento, $endereco, $contato, $tipo_pessoa);

        if ($stmt->execute()) {
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
