<?php 
include("../auth/valida.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Produto</title>
    <?php include("../includes/link_head.php") ?>
    <link rel="stylesheet" href="../assets/css/form.css">
</head>

<body>
<?php include("../includes/header.php") ?>
<?php include("../includes/menu.php") ?>  
<div class="content">
<div class="form-container">
        <form action="auth/logar.php" method="post">
            <h2 class="form-title">Cadastrar Produto</h2>
            <div class="form-group">
                <label for="email">Nome</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-pen"></i></span>
                    <input type="text" class="form-control" name="nome" id="nome" placeholder="Digite nome do produto"
                        required>
                </div>
            </div>
            <div class="form-group">
                <label for="codigo">Código de Barras</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-barcode"></i></span>
                    <input type="text" class="form-control" name="codigo" id="codigo" placeholder="Digite o Código de Barras"
                        required>
                </div>
            </div>
            <div class="form-group">
                <label for="email">Fornecedor</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-truck"></i></span>
                    <input type="text" class="form-control" name="fornecedor" id="fornecedor" placeholder="Digite nome do Fornecedor"
                        required>
                </div>
            </div>
            <div class="form-group">
                <label for="senha">Código de Barras</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-barcode"></i></span>
                    <input type="text" class="form-control" name="codigo" id="codigo" placeholder="Digite o Código de Barras"
                        required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-block mt-3">Cadastrar</button> 
        </form>
    </div>
</div>
</body>
</html>