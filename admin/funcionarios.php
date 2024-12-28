<?php
include("../database/utils/valida.php");
include("../database/utils/conexao.php");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuários</title>
    <?php include("../includes/link_head.php") ?>
    <link rel="stylesheet" href="../assets/css/table.css?v=<?php echo time(); ?>">
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
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sqlFuncionarios = "SELECT * FROM funcionarios WHERE status = 1";
                    $resultadoFuncionarios = $conn->query($sqlFuncionarios);

                    while ($rowFuncionarios = $resultadoFuncionarios->fetch_assoc()) {

                        $cpf = $rowFuncionarios['cpf'];
                        $salario = $rowFuncionarios['salario'];
                        $data_admicao = $rowFuncionarios['data_admicao'];
                        $data_demicao = $rowFuncionarios['data_demicao'];
                        $status = $rowFuncionarios['status'];
                        $dataAdmicaoFormatada = DateTime::createFromFormat('Y-m-d', $data_admicao)->format('d/m/Y');

                        $sqlPessoas = "SELECT nome, cargo FROM pessoas WHERE cpf = '$cpf' AND status = 1";
                        $resultadoPessoas = $conn->query($sqlPessoas);

                        while ($rowPessoas = $resultadoPessoas->fetch_assoc()) {
                            $nome = $rowPessoas['nome'];
                            $cargoPessoa = $rowPessoas['cargo'];
                        }

                        $sqlCargo = "SELECT cargo FROM cargos WHERE id = '$cargoPessoa' AND status = 1";
                        $resultadoCargo = $conn->query($sqlCargo);

                        while ($rowCargo = $resultadoCargo->fetch_assoc()) {
                            $cargo = $rowCargo['cargo'];
                        }

                        echo "
                            <tr>
                                <td>" . $cpf . "</td>
                                <td>" . $nome . "</td>
                                <td>R$ " . number_format($salario, 2, ',', '.') . "</td>
                                <td>" . $dataAdmicaoFormatada . "</td>
                                <td>" . (empty($data_demicao) ? "Funcionário Ativo" : (DateTime::createFromFormat('Y-m-d', $data_demicao)->format('d/m/Y'))) . "</td>
                                <td>" . $cargo . "</td>
                                <td>" . ($status == 1 ? "Ativo" : "Inativo") . "</td>
                            </tr>
                            ";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>