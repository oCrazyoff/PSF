<?php
include("../../auth/config.php");
include("../../auth/valida.php");
include("../../database/utils/conexao.php");

$id = $_POST['id'];

$sql = "SELECT * FROM cargos WHERE id = $id";
$resultado = $conn->query($sql);
$row = $resultado->fetch_assoc();
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
            <form action="../../database/cargos/edita_cargo.php" method="post">
                <h2>Editar <?php echo $row['nome'] ?></h2>
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-pen"></i></span>
                        <input type="text" class="form-control" value="<?php echo $row['nome'] ?>" name="nome" id="nome"
                            placeholder="Digite nome do cargo" required>
                    </div>
                </div>
                <input type="hidden" value="<?php echo $id ?>" name="id">
                <button type="submit" class="btn btn-primary btn-block mt-3">Editar</button>
            </form>
        </div>
    </div>
</body>

</html>