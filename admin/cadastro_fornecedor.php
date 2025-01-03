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
    <?php include("../includes/link_head.php")?>
    <link rel="stylesheet" href="../assets/css/form.css">
</head>

<body>
    <?php include("../includes/header.php") ?>
    <?php include("../includes/menu.php") ?>
    <div class="content">
        <div class="form-container" id="index">
            <form action="auth/logar.php" method="post">
                <h2 class="form-title">Login</h2>
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input type="text" class="form-control" name="nome" id="nome" placeholder="Digite seu Nome" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="cnpj">CNPJ</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="text" class="form-control" name="cnpj" id="cnpj" placeholder="Digite sua CNPJ" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="razao_social">Razão Social</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="text" class="form-control" name="razao_social" id="razao_social" placeholder="Digite sua Razão Social" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="nome_fantasia">Nome Fantasia</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="text" class="form-control" name="nome_fantasia" id="nome_fantasia" placeholder="Digite seu Nome Fantásia" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block mt-3">Entrar</button>
                <div class="text-center mt-3">
                    <span>Não tem uma conta?</span>
                    <a href="pages/cadastrese.php" class="register-link">Cadastre-se</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>