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
    <title>Cadastrar Fornecedores</title>
    <?php include("../includes/link_head.php") ?>
    <link rel="stylesheet" href="../assets/css/form.css">
</head>

<body>
    <?php include("../includes/header.php") ?>
    <?php include("../includes/menu.php") ?>
    <div class="content">
        <div class="form-container">
            <form action="../database/cadastrar/cadastrar_fornecedor.php" method="post">
                <h2 class="form-title">Cadastrar Fornecedor</h2>
                <div class="form-group">
                    <label for="cnpj">CNPJ</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-regular fa-id-card"></i></span>
                        <input type="text" class="form-control" name="cnpj" id="cnpj" placeholder="Digite sua CNPJ"
                            required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="razao_social">Razão Social</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-file-signature"></i></span>
                        <input type="text" class="form-control" name="razao_social" id="razao_social"
                            placeholder="Digite sua Razão Social" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="nome_fantasia">Nome Fantasia</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-pen-to-square"></i></span>
                        <input type="text" class="form-control" name="nome_fantasia" id="nome_fantasia"
                            placeholder="Digite seu Nome Fantásia" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="endereco">Endereço</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-location-dot"></i></span>
                        <input type="text" class="form-control" name="endereco" id="endereco"
                            placeholder="Digite seu Endereço" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="contato">Contato</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-phone"></i></span>
                        <input type="text" class="form-control" name="contato" id="contato"
                            placeholder="Digite seu Contato" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block mt-3">Cadastrar</button>
            </form>
        </div>
    </div>
</body>

</html>