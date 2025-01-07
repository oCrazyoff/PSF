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
    <title>Pessoas Físicas</title>
    <?php include("../../includes/link_head.php") ?>
    <link rel="stylesheet" href="../../assets/css/table.css?v=<?php echo time(); ?>">
</head>

<body>
    <?php include("../../includes/header.php") ?>
    <?php include("../../includes/menu.php") ?>
    <div class="content">
        <table>
            <div class="titulo">
                <h1>Lista de Pessoas Físicas</h1>
                <a href="cadastro_produto.php">Nova Pessoa <i class="fa-solid fa-circle-plus"></i></a>
            </div>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>E-mail</th>
                    <th>Data de Nascimento</th>
                    <th>Endereço</th>
                    <th>Contato</th>
                    <th>Cargo</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sqlPessoas = "SELECT * FROM pessoas WHERE tipo_pessoa = 1";
                $resultadoPessoas = $conn->query($sqlPessoas);

                while ($rowPessoas = $resultadoPessoas->fetch_assoc()) {

                    $nome = $rowPessoas['nome'];
                    $cpf = $rowPessoas['cpf'];
                    $email = $rowPessoas['email'];
                    $data_nascimento = $rowPessoas['data_nascimento'];
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
                                <td>" . (empty($nome) ? "N/A" : $nome) . "</td>
                                <td>" . (empty($cpf) ? "N/A" : $cpf) . "</td>
                                <td>" . (empty($email) ? "N/A" : $email) . "</td>
                                <td>" . (empty($data_nascimento) ? "N/A" : (DateTime::createFromFormat('Y-m-d', $data_nascimento)->format('d/m/Y'))) . "</td>
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