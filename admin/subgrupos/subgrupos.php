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
    <title>Sub Grupos</title>
    <?php include("../../includes/link_head.php") ?>
    <link rel="stylesheet" href="../../assets/css/table.css?v=<?php echo time(); ?>">
</head>

<body>
    <?php include("../../includes/header.php") ?>
    <?php include("../../includes/menu.php") ?>
    <?php include("../../includes/div_erro.php") ?>
    <div class="content">
        <table>
            <div class="titulo">
                <h1>Lista de Sub Grupos</h1>
                <a href="cadastro_subgrupo.php">Novo Sub Grupo <i class="fa-solid fa-circle-plus"></i></a>
            </div>
            <thead>
                <tr>
                    <th>Grupo</th>
                    <th>Sub Grupo</th>
                    <th>Situação</th>
                    <th colspan="3">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT s.id, s.nome, s.status, g.nome AS grupo_nome FROM subgrupo s INNER JOIN grupos g ON s.grupo_id = g.id ORDER BY s.status DESC";
                $resultado = $conn->query($sql);
                while ($row = $resultado->fetch_assoc()) {
                    $id = $row['id'];
                    $status = $row['status'];
                    echo "
                    <tr>
                        <td>" . htmlentities($row['grupo_nome']) . "</td>
                        <td>" . htmlentities($row['nome']) . "</td>
                        <td>" . ($status == 1 ? "Ativo" : "Inativo") . "</td>
                        <td>
                            <form class='action' action='edita_subgrupo.php' method='post'>
                                <input type='hidden' name='id' value='$id'>
                                <button type='submit'><i class='fa-solid fa-pen-to-square'></i></button>
                            </form>
                        </td>
                        <td>
                            <form class='action' action='../../database/subgrupos/deletar_subgrupo.php' method='post'>
                            <input type='hidden' name='deletar' value='0'>
                                <input type='hidden' name='id' value='$id'>
                                <input type='hidden' name='status' value='$status'>
                                <button type='submit'>" . (($status == 1) ? "<i class='fa-solid fa-trash-can'></i>" : "<i class='fa-solid fa-plus'></i>") . "</button>
                            </form>
                        </td>
                        <td>
                            <form class='action' action='../../database/subgrupos/deletar_subgrupo.php' method='post' style='display:" . (($status == 1) ? "none" : "block") . "'>
                                <input type='hidden' name='deletar' value='1'>
                                <input type='hidden' name='id' value='$id'>
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