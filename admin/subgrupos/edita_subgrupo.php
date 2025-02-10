<?php
include("../../auth/config.php");
include("../../auth/valida.php");
include("../../database/utils/conexao.php");

$id = $_POST['id'];

$sql = "SELECT * FROM subgrupo WHERE id = $id";
$resultado = $conn->query($sql);
$row = $resultado->fetch_assoc();
$nome = $row['nome'];
$grupo_id = $row['grupo_id'];
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar <?php echo $nome ?></title>
    <?php include("../../includes/link_head.php") ?>
    <link rel="stylesheet" href="../../assets/css/form.css?v=<?php echo time(); ?>">
</head>

<body>
    <?php include("../../includes/header.php") ?>
    <?php include("../../includes/menu.php") ?>
    <div class="content">
        <div class="form-container">
            <form action="../../database/subgrupos/editar_subgrupo.php" method="post">
                <h2>Editar <?php echo $row['nome'] ?></h2>
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-pen"></i></span>
                        <input type="text" class="form-control" value="<?php echo $row['nome'] ?>" name="nome" id="nome"
                            placeholder="Digite nome do grupo" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="grupo">Grupo</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-list"></i></span>
                        <select name="grupo" id="grupo" required>
                            <?php
                            $sqlGrupo = "SELECT id, nome FROM grupos WHERE status = 1";
                            $resultadoGrupo = $conn->query($sqlGrupo);
                            while ($rowGrupo = $resultadoGrupo->fetch_assoc()) {
                                echo "
                                <option value='" . $rowGrupo['id'] . "'" . (($rowGrupo['id'] == $grupo_id) ? "selected" : "") . ">" . $rowGrupo['nome'] . "</option>
                                ";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <input type="hidden" value="<?php echo $id ?>" name="id">
                <button type="submit" class="btn btn-primary btn-block mt-3">Editar</button>
            </form>
        </div>
    </div>
</body>

</html>