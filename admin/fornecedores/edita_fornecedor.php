<?php
include("../../auth/config.php");
include("../../auth/valida.php");
include("../../database/utils/conexao.php");

$cnpj = $_POST['cnpj'];
$sqlFornecedores = "SELECT cnpj, razao_social, nome_fantasia, endereco, contato FROM pessoas WHERE cnpj = '$cnpj'";
$resultadoFornecedores = $conn->query($sqlFornecedores);

while ($rowFornecedores = $resultadoFornecedores->fetch_assoc()) {
    $cnpj = $rowFornecedores["cnpj"];
    $razao_social = $rowFornecedores["razao_social"];
    $nome_fantasia = $rowFornecedores["nome_fantasia"];
    $endereco = $rowFornecedores["endereco"];
    $contato = $rowFornecedores["contato"];
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar <?php echo $razao_social ?></title>
    <?php include("../../includes/link_head.php") ?>
    <link rel="stylesheet" href="../../assets/css/form.css?v=<?php echo time(); ?>">
</head>

<body>
    <?php include("../../includes/header.php") ?>
    <?php include("../../includes/menu.php") ?>
    <div class="content">
        <div class="form-container" id="large-form">
            <h2 class="form-title">Editar <?php echo $razao_social ?></h2>
            <form action="../../database/fornecedores/editar_fornecedor.php" method="post">
                <div class="form-group">
                    <label for="cnpj">CNPJ</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-regular fa-id-card"></i></span>
                        <input type="text" class="form-control" value="<?php echo $cnpj ?>" name="cnpj" id="cnpj"
                            placeholder="Digite o CNPJ" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="razao_social">Razão Social</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-signature"></i></span>
                        <input type="text" class="form-control" value="<?php echo $razao_social ?>" name="razao_social"
                            id="razao_social" placeholder="Digite a Razão Social">
                    </div>
                </div>
                <div class="form-group">
                    <label for="nome_fantasia">Nome Fantásia</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                        <input type="text" class="form-control" value="<?php echo $nome_fantasia ?>" name="nome_fantasia"
                            id="nome_fantasia" placeholder="Digite o Nome Fantásia">
                    </div>
                </div>
                <div class="form-group">
                    <label for="endereco">Endereço</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-location-dot"></i></span>
                        <input type="text" step="0.01" class="form-control" value="<?php echo $endereco ?>"
                            name="endereco" id="endereco" placeholder="Digite o Endereço" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="contato">Contato</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-phone"></i></span>
                        <input type="text" class="form-control" value="<?php echo $contato ?>" name="contato"
                            id="contato" placeholder="Digite o Contato">
                    </div>
                </div>
                <input type="hidden" value="<?php echo $cnpj ?>" name="cnpjAtual">
                <button type="submit" class="btn btn-primary btn-block mt-3">Editar</button>
            </form>
        </div>
    </div>

</body>

</html>