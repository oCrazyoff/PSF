<?php
include("../auth/valida.php");
include("../database/utils/conexao.php");
include("../auth/config.php");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fornecedores</title>
    <?php include("../includes/link_head.php") ?>
    <link rel="stylesheet" href="../assets/css/table.css">
</head>

<body>
    <?php include("../includes/header.php") ?>
    <?php include("../includes/menu.php") ?>
    <div class="content">
        <table>
            <div class="titulo">
                <h1>Lista de Fornecedores</h1>
                <a href="cadastro_fornecedor.php">Novo Fornecedor <i class="fa-solid fa-circle-plus"></i></a>
            </div>
            <thead>
                <tr>
                    <th>Nome Fantasia</th>
                    <th>CNPJ</th>
                    <th>Razão Social</th>
                    <th>Contato</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM fornecedores WHERE status = 1";
                $resultado = $conn->query($sql);

                while ($row = $resultado->fetch_assoc()) {
                    $cnpj = $row['cnpj'];
                    $status = $row['status'];

                    $sqlPessoas = "SELECT * FROM pessoas WHERE cnpj = '$cnpj'";
                    $resultadoPessoas = $conn->query($sqlPessoas);

                    while ($rowPessoas = $resultadoPessoas->fetch_assoc()) {
                        $nome_fantasia = $rowPessoas['nome_fantasia'];
                        $razao_social = $rowPessoas['razao_social'];
                        $contato = $rowPessoas['contato'];
                    }

                    echo "
                            <tr>
                                <td>" . $nome_fantasia . "</td>
                                <td>" . $cnpj . "</td>
                                <td>" . $razao_social . "</td>
                                <td>" . $contato . "</td>
                                <td>" . ($status == 1 ? "Ativo" : "Inativo") . "</td>
                            </tr>
                                ";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>