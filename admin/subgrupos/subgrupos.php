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
    <div class="content">
        <table>
            <div class="titulo">
                <h1>Lista de Sub Grupos</h1>
                <a href="cadastro_subgrupo.php">Novo Sub Grupo <i class="fa-solid fa-circle-plus"></i></a>
            </div>
            <thead>
                <tr>
                    <th>Sub Grupo</th>
                    <th>Situação</th>
                    <th colspan="2">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM subgrupo ORDER BY status DESC";
                $resultado = $conn->query($sql);
                while ($row = $resultado->fetch_assoc()) {
                    $id = $row['id'];
                    $status = $row['status'];
                    echo "
                    <tr>
                        <td>" . $row['nome'] . "</td>
                        <td>" . ($status == 1 ? "Ativo" : "Inativo") . "</td>
                        <td>
                            <form class='action' action='edita_subgrupo.php' method='post'>
                                <input type='hidden' name='id' value='$id'>
                                <button type='submit'><i class='fa-solid fa-pen-to-square'></i></button>
                            </form>
                        </td>
                        <td>
                            <form class='action' action='../../database/subgrupos/deletar_subgrupo.php' method='post'>
                                <input type='hidden' name='id' value='$id'>
                                <button type='submit'><i class='fa-solid fa-trash-can'></i></button>
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