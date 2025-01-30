<?php
include("../utils/conexao.php");
include("../../auth/valida.php");

$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
$cpf = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS);
$data_nascimento = $_POST["data_nascimento"];
$cep = filter_input(INPUT_POST, 'cep', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$logradouro = filter_input(INPUT_POST, 'logradouro', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$numero = filter_input(INPUT_POST, 'numero', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$bairro = filter_input(INPUT_POST, 'bairro', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$complemento = filter_input(INPUT_POST, 'complemento', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$estado = filter_input(INPUT_POST, 'estado', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$cidade = filter_input(INPUT_POST, 'cidade', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$contato = filter_input(INPUT_POST, 'contato', FILTER_SANITIZE_SPECIAL_CHARS);
$salario = filter_input(INPUT_POST, 'salario', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
$cargo = filter_input(INPUT_POST, 'cargo', FILTER_SANITIZE_NUMBER_INT);
$data_admissao = date("d/m/Y");
$endereco = "$cep, $logradouro, $numero, $bairro, " . ($complemento == null ? "" : $complemento . ", ") . "$estado, $cidade";

$sqlVerificar = "SELECT cpf FROM funcionarios WHERE cpf = ?";
$stmt = $conn->prepare($sqlVerificar);
$stmt->bind_param("s", $cpf);
$stmt->execute();
$stmt->bind_result($cpfVerifica);
$stmt->fetch();
$stmt->close();

if ($cpfVerifica) {
    $_SESSION['resposta'] = "Funcionário ja cadastrado!";
    header("Location: ../../admin/funcionarios/funcionarios.php");
    exit;
} else {
    $sqlVerificarPessoas = "SELECT cpf FROM pessoas WHERE cpf = ?";
    $stmt = $conn->prepare($sqlVerificarPessoas);
    $stmt->bind_param("s", $cpf);
    $stmt->execute();
    $stmt->bind_result($cpfPessoas);
    $stmt->fetch();
    $stmt->close();

    $sqlFuncionarios = "INSERT INTO funcionarios (cpf, salario, data_admissao) VALUES (?, ?, ?)";
    $stmtFuncionarios = $conn->prepare($sqlFuncionarios);
    $stmtFuncionarios->bind_param("sds", $cpf, $salario, $data_admissao);

    if ($cpfPessoas) {
        $sqlPessoas = "UPDATE pessoas SET nome = ?, cpf = ?, email = ?, data_nascimento = ?, endereco = ?, contato = ?, cargo = ? WHERE cpf = ?";
        $stmtPessoas = $conn->prepare($sqlPessoas);
        $stmtPessoas->bind_param("ssssssss", $nome, $cpf, $email, $data_nascimento, $endereco, $contato, $cargo, $cpf);
    } else {
        $sqlPessoas = "INSERT INTO pessoas (nome, cpf, email, data_nascimento, endereco, contato, cargo) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmtPessoas = $conn->prepare($sqlPessoas);
        $stmtPessoas->bind_param("sssssss", $nome, $cpf, $email, $data_nascimento, $endereco, $contato, $cargo);
    }
}

if ($stmtPessoas->execute() && $stmtFuncionarios->execute()) {
    $_SESSION['resposta'] = "Funcionário cadastrado com sucessso!";
} else {
    $_SESSION['resposta'] = "Erro ao cadastrar Funcionário: " . $stmt->error;
}
$stmtPessoas->close();
$stmtFuncionarios->close();

header("Location: ../../admin/funcionarios/funcionarios.php");
exit;