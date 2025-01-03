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
    <title>Pessoas Jurídicas</title>
    <?php include("../includes/link_head.php") ?>
    <link rel="stylesheet" href="../assets/css/table.css?v=<?php echo time(); ?>">
</head>

<body>
    <?php include("../includes/header.php") ?>
    <?php include("../includes/menu.php") ?>
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
                    <th>Tipo</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sqlPessoas = "SELECT cnpj, razao_social, email, endereco, contato, tipo_pessoa, status FROM pessoas WHERE status = 1 AND tipo_pessoa = (SELECT id FROM tipo_pessoa WHERE id = 2)";
                $resultadoPessoas = $conn->query($sqlPessoas);

                while ($rowPessoas = $resultadoPessoas->fetch_assoc()) {

                    $razao_social = $rowPessoas['razao_social'];
                    $cnpj = $rowPessoas['cnpj'];
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
                                <td>" . (empty($razao_social) ? "Não cadastrada" : $razao_social) . "</td>
                                <td>" . (empty($cnpj) ? "Não cadastrada" : $cnpj) . "</td>
                                <td>" . (empty($email) ? "Não cadastrada" : $email) . "</td>
                                <td>" . (empty($endereco) ? "Não cadastrada" : $endereco) . "</td>
                                <td>" . (empty($contato) ? "Não cadastrada" : $contato) . "</td>
                                <td>" . (empty($tipo) ? "Não cadastrada" : $tipo) . "</td>
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