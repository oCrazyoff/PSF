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
    <title>Pessoas Físicas</title>
    <?php include("../includes/link_head.php") ?>
    <link rel="stylesheet" href="../assets/css/table.css?v=<?php echo time(); ?>">
</head>

<body>
    <?php include("../includes/header.php") ?>
    <?php include("../includes/menu.php") ?>
    <div class="content">
        <table>
            <h1>Lista de Pessoas Físicas</h1>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>E-mail</th>
                    <th>Data de Nascimento</th>
                    <th>Endereço</th>
                    <th>Contato</th>
                    <th>Tipo</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sqlPessoas = "SELECT nome, cpf, email, data_nascimento, endereco, contato, tipo_pessoa, status FROM pessoas WHERE status = 1 AND tipo_pessoa = (SELECT id FROM tipo_pessoa WHERE id = 1)";
                $resultadoPessoas = $conn->query($sqlPessoas);

                while ($rowPessoas = $resultadoPessoas->fetch_assoc()) {

                    $nome = $rowPessoas['nome'];
                    $cpf = $rowPessoas['cpf'];
                    $email = $rowPessoas['email'];
                    $data_nascimento = $rowPessoas['data_nascimento'];
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
                                <td>" . (empty($nome) ? "Não cadastrada" : $nome) . "</td>
                                <td>" . (empty($cpf) ? "Não cadastrada" : $cpf) . "</td>
                                <td>" . (empty($email) ? "Não cadastrada" : $email) . "</td>
                                <td>" . (empty($data_nascimento) ? "Não Cadastrada" : (DateTime::createFromFormat('Y-m-d', $data_nascimento)->format('d/m/Y'))) . "</td>
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