<?php
include("../../auth/config.php");
include("../../auth/valida.php");
include("../../database/utils/conexao.php");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuários</title>
    <?php include("../../includes/link_head.php") ?>
    <link rel="stylesheet" href="../../assets/css/table.css?v=<?php echo time(); ?>">
</head>

<body>
    <?php include("../../includes/header.php") ?>
    <?php include("../../includes/menu.php") ?>
    <div class="content">
        <table>
            <div class="titulo">
                <h1>Lista de Funcionários</h1>
                <a href="cadastro_funcionario.php">Novo Funcionário <i class="fa-solid fa-circle-plus"></i></a>
            </div>
            <thead>
                <tr>
                    <th>CPF</th>
                    <th>Nome</th>
                    <th>Salário</th>
                    <th>Data de Admissão</th>
                    <th>Data de Demissão</th>
                    <th>Cargo</th>
                    <th>Status</th>
                    <th colspan="2">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sqlFuncionarios = "SELECT * FROM funcionarios ORDER BY status DESC";
                $resultadoFuncionarios = $conn->query($sqlFuncionarios);

                while ($rowFuncionarios = $resultadoFuncionarios->fetch_assoc()) {

                    $id = $rowFuncionarios['id'];
                    $cpf = $rowFuncionarios['cpf'];
                    $salario = $rowFuncionarios['salario'];
                    $data_admicao = $rowFuncionarios['data_admissao'];
                    $data_demicao = $rowFuncionarios['data_demissao'];
                    $status = $rowFuncionarios['status'];
                    $dataAdmicaoFormatada = DateTime::createFromFormat('Y-m-d', $data_admicao)->format('d/m/Y');

                    $sqlPessoas = "SELECT nome, cargo FROM pessoas WHERE cpf = '$cpf' AND status = 1";
                    $resultadoPessoas = $conn->query($sqlPessoas);

                    while ($rowPessoas = $resultadoPessoas->fetch_assoc()) {
                        $nome = $rowPessoas['nome'];
                        $cargoPessoa = $rowPessoas['cargo'];
                    }

                    $sqlCargo = "SELECT nome FROM cargos WHERE id = '$cargoPessoa' AND status = 1";
                    $resultadoCargo = $conn->query($sqlCargo);

                    while ($rowCargo = $resultadoCargo->fetch_assoc()) {
                        $cargo = $rowCargo['nome'];
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
                                                                <td>
                                    <form class='action' action='edita_funcionario.php' method='post'>
                                        <input type='hidden' name='id' value='$id'>
                                        <button type='submit'><i class='fa-solid fa-pen-to-square'></i></button>
                                    </form>
                                </td>
                                <td>
                                    <form class='action' action='../../database/funcionarios/deletar_funcionario.php' method='post'>
                                        <input type='hidden' name='id' value='$id'>
                                        <input type='hidden' name='status' value='$status'>
                                        <button type='submit'>" . ($status == 1 ? "<i class='fa-solid fa-trash-can'>" : "<i class='fa-solid fa-plus'>") . "</i></i></button>
                                    </form>
                                </td>
                            </tr>
                            ";
                }
                ?>
            </tbody>
        </table>
    </div>
    <script>
    <?php
        if (isset($_SESSION['resposta'])) {
            echo "alert('" . $_SESSION['resposta'] . "')";
            unset($_SESSION['resposta']);
        }
        ?>
    </script>
</body>

</html>