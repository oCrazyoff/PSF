<?php
include("../auth/valida.php");
include("../database/utils/conexao.php");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pessoas Jurídicas</title>
    <?php include("../includes/link_head.php") ?>
    <link rel="stylesheet" href="../assets/css/table.css?v=<?php echo time(); ?>">
</head>

<body>
    <?php include("../includes/header.php") ?>
    <div class="content">
        <?php include("../includes/menu.php") ?>
        <div class="container">
            <table>
                <h1>Lista de Pessoas Jurídicas</h1>
                <thead>
                    <tr>
                        <th>Razão Social</th>
                        <th>nome Fantasia</th>
                        <th>CNPJ</th>
                        <th>Informações Fiscais</th>
                        <th>E-mail</th>
                        <th>Endereço</th>
                        <th>Contato</th>
                        <th>Tipo</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sqlPessoas = "SELECT cnpj, razao_social, nome_fantasia, informacoes_fiscais, email, endereco, contato, tipo_pessoa, status FROM pessoas WHERE status = 1 AND tipo_pessoa = (SELECT id FROM tipo_pessoa WHERE id = 2)";
                    $resultadoPessoas = $conn->query($sqlPessoas);

                    while ($rowPessoas = $resultadoPessoas->fetch_assoc()) {

                        $razao_social = $rowPessoas['razao_social'];
                        $nome_fantasia = $rowPessoas['nome_fantasia'];
                        $cnpj = $rowPessoas['cnpj'];
                        $informacoes_fiscais = $rowPessoas['informacoes_fiscais'];
                        $email = $rowPessoas['email'];
                        $endereco = $rowPessoas['endereco'];
                        $contato = $rowPessoas['contato'];
                        $tipo_pessoa = $rowPessoas['tipo_pessoa'];
                        $status = $rowPessoas['status'];

                        $sqlTipo_pessoa = "SELECT tipo FROM tipo_pessoa WHERE id = '$tipo_pessoa'";
                        $resultadoTipo_pessoa = $conn->query($sqlTipo_pessoa);

                        while ($rowTipo_pessoa = $resultadoTipo_pessoa->fetch_assoc()) {
                            $tipo = $rowTipo_pessoa['tipo'];
                        }

                        echo "
                            <tr>
                                <td>" . $razao_social . "</td>
                                <td>" . $nome_fantasia . "</td>
                                <td>" . $cnpj . "</td>
                                <td>" . $informacoes_fiscais . "</td>
                                <td>" . $email . "</td>
                                <td>" . $endereco . "</td>
                                <td>" . $contato . "</td>
                                <td>" . $tipo . "</td>
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