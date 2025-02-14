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
    <title>Fornecedores</title>
    <?php include("../../includes/link_head.php") ?>
    <link rel="stylesheet" href="../../assets/css/table.css">
</head>

<body>
    <?php include("../../includes/header.php") ?>
    <?php include("../../includes/menu.php") ?>
    <?php include("../../includes/div_erro.php") ?>
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
                    <th>Endereço</th>
                    <th>Contato</th>
                    <th>Situação</th>
                    <th colspan="3">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM fornecedores ORDER BY status DESC";
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
                        $endereco = $rowPessoas['endereco'];
                    }

                    echo "
                            <tr>
                                <td>" . ($nome_fantasia != null ? $nome_fantasia : "N/A") . "</td>
                                <td>" . ($cnpj != null ? $cnpj : "N/A") . "</td>
                                <td>" . ($razao_social != null ? $razao_social : "N/A") . "</td>
                                <td>" . ($endereco != null ? $endereco : "N/A") . "</td>
                                <td>" . ($contato != null ? $contato : "N/A"). "</td>
                                <td>" . ($status == 1 ? "Ativo" : "Inativo") . "</td>
                                <td>
                                    <form class='action' action='edita_fornecedor.php' method='post'>
                                        <input type='hidden' name='cnpj' value='$cnpj'>
                                        <button type='submit'><i class='fa-solid fa-pen-to-square'></i></button>
                                    </form>
                                </td>
                                <td>
                                    <form class='action' action='../../database/fornecedores/deletar_fornecedor.php' method='post'>
                                    <input type='hidden' name='deletar' value='0'>
                                        <input type='hidden' name='cnpj' value='$cnpj'>
                                        <input type='hidden' name='status' value='$status'>
                                        <button type='submit'>" . (($status == 1) ? "<i class='fa-solid fa-trash-can'></i>" : "<i class='fa-solid fa-plus'></i>") . "</button>
                                    </form>
                                </td>
                                <td>
                                    <form class='action' action='../../database/fornecedores/deletar_fornecedor.php' method='post' style='display:".(($status == 1) ? "none" : "block")."'>
                                        <input type='hidden' name='deletar' value='1'>
                                        <input type='hidden' name='cnpj' value='$cnpj'>
                                        <input type='hidden' name='status' value='$status'>
                                        <button type='submit'><i style='color:red'class='fa-solid fa-trash-can'></i></button>
                                    </form>
                                </td>
                            </tr>
                                ";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>