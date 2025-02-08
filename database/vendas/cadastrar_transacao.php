<?php
include("../utils/conexao.php");
include("../../auth/valida.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cliente = $_POST['clienteCpf'];
    $funcionario = $_POST['funcionarioCpf'];
    $tipo = 1;
    $status = 0;
    $total = $_POST['total'];

    // Verifique se a conexão com o banco de dados está funcionando
    if ($conn->connect_error) {
        $_SESSION['resposta'] = "Erro na conexão com o banco de dados: " . $conn->connect_error;
        header("Location: ../../admin/vendas/caixa/caixa.php");
        exit();
    }

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

    // Redirecionar de volta para a página do caixa
    header("Location: ../../admin/vendas/caixa/caixa.php");
    exit();
} else {
    $_SESSION['resposta'] = "Método não permitido";
    header("Location: ../../admin/vendas/caixa/caixa.php");
    exit();
}
