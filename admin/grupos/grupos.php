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
    <title>Grupos</title>
    <?php include("../../includes/link_head.php") ?>
    <link rel="stylesheet" href="../../assets/css/table.css?v=<?php echo time(); ?>">
</head>

<body>
    <?php include("../../includes/header.php") ?>
    <?php include("../../includes/menu.php") ?>
    <div class="content">
        <table>
            <div class="titulo">
                <h1>Lista de Grupos</h1>
                <a href="cadastro_grupo.php">Novo Grupo <i class="fa-solid fa-circle-plus"></i></a>
            </div>
            <thead>
                <tr>
                    <th>Grupo</th>
                    <th>Situação</th>
                    <th colspan="2">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM grupos ORDER BY status DESC";
                $resultado = $conn->query($sql);
                while ($row = $resultado->fetch_assoc()) {
                    $id = $row['id'];
                    $status = $row['status'];
                    echo "
                    <tr>
                        <td>" . $row['nome'] . "</td>
                        <td>" . ($status == 1 ? "Ativo" : "Inativo") . "</td>
                        <td>
                            <form class='action' action='edita_grupo.php' method='post'>
                                <input type='hidden' name='id' value='$id'>
                                <button type='submit'><i class='fa-solid fa-pen-to-square'></i></button>
                            </form>
                        </td>
                        <td>
                            <form class='action' action='../../database/grupos/deletar_grupo.php' method='post'>
                                <input type='hidden' name='id' value='$id'>
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