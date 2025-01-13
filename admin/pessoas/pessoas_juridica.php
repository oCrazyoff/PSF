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
    <title>Pessoas Jurídicas</title>
    <?php include("../../includes/link_head.php") ?>
    <link rel="stylesheet" href="../../assets/css/table.css?v=<?php echo time(); ?>">
</head>

<body>
    <?php include("../../includes/header.php") ?>
    <?php include("../../includes/menu.php") ?>
    <div class="content">
        <table>
            <div class="titulo">
                <h1>Lista de Pessoas Jurídicas</h1>
                <a href="cadastro_produto.php">Nova Pessoa <i class="fa-solid fa-circle-plus"></i></a>
            </div>
            <thead>
                <tr>
                    <th>Razão Social</th>
                    <th>CNPJ</th>
                    <th>E-mail</th>
                    <th>Endereço</th>
                    <th>Contato</th>
                    <th>Cargo</th>
                    <th>Situação</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sqlPessoas = "SELECT * FROM pessoas WHERE tipo_pessoa = 2";
                $resultadoPessoas = $conn->query($sqlPessoas);

                while ($rowPessoas = $resultadoPessoas->fetch_assoc()) {

                    $razao_social = $rowPessoas['razao_social'];
                    $cnpj = $rowPessoas['cnpj'];
                    $email = $rowPessoas['email'];
                    $endereco = $rowPessoas['endereco'];
                    $contato = $rowPessoas['contato'];
                    $cargo = $rowPessoas['cargo'];
                    $status = $rowPessoas['status'];

                    $sqlCargo = "SELECT nome FROM cargos WHERE id = '$cargo'";
                    $resultadoCargo = $conn->query($sqlCargo);

                    while ($rowCargo = $resultadoCargo->fetch_assoc()) {
                        $cargo = $rowCargo['nome'];
                    }

                    echo "
                            <tr>
                                <td>" . (empty($razao_social) ? "N/A" : $razao_social) . "</td>
                                <td>" . (empty($cnpj) ? "N/A" : $cnpj) . "</td>
                                <td>" . (empty($email) ? "N/A" : $email) . "</td>
                                <td>" . (empty($endereco) ? "N/A" : $endereco) . "</td>
                                <td>" . (empty($contato) ? "N/A" : $contato) . "</td>
                                <td>" . (empty($cargo) ? "N/A" : $cargo) . "</td>
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