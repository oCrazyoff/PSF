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
                <a href="cadastro_pessoa_juridica.php">Nova Pessoa <i class="fa-solid fa-circle-plus"></i></a>
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
                    <th colspan="2">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sqlPessoas = "SELECT * FROM pessoas WHERE tipo_pessoa = 2 ORDER BY status DESC";
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
                                <td>
                                    <form class='action' action='edita_pessoa_juridica.php' method='post'>
                                        <input type='hidden' name='emailAtual' value='$email'>
                                        <button type='submit'><i class='fa-solid fa-pen-to-square'></i></button>
                                    </form>
                                </td>
                                <td>
                                    <form class='action' action='../../database/pessoas/deletar_pessoa_juridica.php' method='post'>
                                        <input type='hidden' name='cnpjAtual' value='$cnpj'>
                                        <input type='hidden' name='status' value='$status'>
                                        <button type='submit'>" . (($status == 1) ? "<i class='fa-solid fa-trash-can'></i>" : "<i class='fa-solid fa-plus'></i>") . "</button>
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

<script>
    <?php
    if (isset($_SESSION['resposta'])) {
        echo "alert('" . $_SESSION['resposta'] . "')";
        unset($_SESSION['resposta']);
    }
    ?>
</script>

</html>