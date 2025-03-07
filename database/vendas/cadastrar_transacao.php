<?php
include("../utils/conexao.php");
include("../../auth/valida.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cliente = $_POST['clienteCpf'];
    $funcionario = $_POST['funcionarioCpf'];
    $tipo = 1;
    $status = 0;
    $total = $_POST['total'];
    $produtos = $_POST['produtos'];

    var_dump($_POST);
    die;
    

    $sql = "INSERT INTO transacoes (cliente_cpf, vendedor_cpf, tipo, preco_total, status) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssisi", $cliente, $funcionario, $tipo, $total, $status);

    if ($stmt->execute()) {
        $_SESSION['resposta'] = "Transação cadastrada com sucesso!";
    } else {
        $_SESSION['resposta'] = "Erro ao cadastrar Transação: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    $_SESSION['resposta'] = "Método não permitido";
}
