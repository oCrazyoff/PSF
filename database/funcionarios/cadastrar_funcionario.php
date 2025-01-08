<?php
include("../utils/conexao.php");
include("../../auth/valida.php");

$nome = $_POST["nome"];
$cpf = $_POST["cpf"];
$email = $_POST["email"];
$data_nascimento = $_POST["data_nascimento"];
$endereco = $_POST["endereco"];
$contato = $_POST["contato"];
$salario = floatval($_POST["salario"]);
$data_admissao = $_POST["data_admissao"];
$cargo = $_POST["cargo"];

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