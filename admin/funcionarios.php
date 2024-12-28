<?php
include("../database/utils/valida.php");
$usuarios = [
    [
        'cpf' => '123.456.789-00',
        'nome' => 'João Silva',
        'salario' => 2500.00,
        'data_admissao' => '2020-01-15',
        'data_demissao' => null, // Funcionario ainda na empresa
        'cargo' => 'Analista',
        'status' => 1, // Ativo
    ],
    [
        'cpf' => '987.654.321-00',
        'nome' => 'Maria Oliveira',
        'salario' => 3500.00,
        'data_admissao' => '2019-04-10',
        'data_demissao' => '2023-12-20', // Funcionario demitido
        'cargo' => 'Gerente',
        'status' => 0, // Inativo
    ],
    [
        'cpf' => '111.222.333-44',
        'nome' => 'Carlos Souza',
        'salario' => 4000.00,
        'data_admissao' => '2021-06-05',
        'data_demissao' => null, // Funcionario ainda na empresa
        'cargo' => 'Coordenador',
        'status' => 1, // Ativo
    ],
    [
        'cpf' => '555.666.777-88',
        'nome' => 'Ana Costa',
        'salario' => 2800.00,
        'data_admissao' => '2022-03-12',
        'data_demissao' => null, // Funcionario ainda na empresa
        'cargo' => 'Assistente',
        'status' => 1, // Ativo
    ]
];
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuários</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/menu.css">
    <link rel="stylesheet" href="../assets/css/table.css">
</head>

<body>
    <?php include("../includes/header.php") ?>
    <div class="content">
        <?php include("../includes/menu.php") ?>
        <div class="container">
            <table>
                <h1>Lista de Funcionários</h1>
                <thead>
                    <tr>
                        <th>CPF</th>
                        <th>Nome</th>
                        <th>Salário</th>
                        <th>Data de Admissão</th>
                        <th>Data de Demissão</th>
                        <th>Cargo</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usuarios as $usuario) { ?>
                        <tr>
                            <td><?php echo $usuario['cpf']; ?></td>
                            <td><?php echo $usuario['nome']; ?></td>
                            <td><?php echo number_format($usuario['salario'], 2, ',', '.'); ?></td>
                            <td><?php echo date("d/m/Y", strtotime($usuario['data_admissao'])); ?></td>
                            <td><?php echo $usuario['data_demissao'] ? date("d/m/Y", strtotime($usuario['data_demissao'])) : 'Ainda na empresa'; ?>
                            </td>
                            <td><?php echo $usuario['cargo']; ?></td>
                            <td><?php echo $usuario['status'] == 1 ? 'Ativo' : 'Inativo'; ?></td>
                            <td>
                                <!-- Ações -->
                                <a href="editar_usuario.php?cpf=<?php echo $usuario['cpf']; ?>" class="editar">
                                    <i class="fas fa-edit"></i> Editar
                                </a>
                                <a href="mudar_status.php?cpf=<?php echo $usuario['cpf']; ?>" class="status">
                                    <i class="fas fa-sync-alt"></i> Trocar Status
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>