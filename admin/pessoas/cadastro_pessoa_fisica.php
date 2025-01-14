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
    <title>Cadastro de Pessoa Física</title>
    <?php include("../../includes/link_head.php") ?>
    <link rel="stylesheet" href="../../assets/css/form.css?v=<?php echo time(); ?>">
</head>

<body>
    <?php include("../../includes/header.php") ?>
    <?php include("../../includes/menu.php") ?>
    <div class="content">
        <div class="form-container" id="large-form">
            <h2 class="form-title">Cadastrar Pessoa Física</h2>
            <form action="../../database/pessoas/cadastrar_pessoa_fisica.php" method="post">
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                        <input type="text" class="form-control" name="nome" id="nome"
                            placeholder="Digite o nome" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="cpf">CPF</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-address-card"></i></span>
                        <input type="text" class="form-control" name="cpf" id="cpf"
                            placeholder="Digite o CPF">
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                        <input type="text" class="form-control" name="email" id="email"
                            placeholder="Digite o email">
                    </div>
                </div>
                <div class="form-group">
                    <label for="data_nascimento">Data de nascimento</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-calendar-days"></i></span>
                        <input type="date" class="form-control" name="data_nascimento" id="data_nascimento"
                            placeholder="Digite a Data de nascimento" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="endereco">Endereço</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-location-dot"></i></span>
                        <input type="text" class="form-control" name="endereco" id="endereco"
                            placeholder="Digite o Endereço">
                    </div>
                </div>
                <div class="form-group">
                    <label for="contato">Contato</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-phone"></i></span>
                        <input type="text" class="form-control" name="contato" id="contato"
                            placeholder="Digite o contato">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block mt-3">Cadastrar</button>
            </form>
        </div>
    </div>

</body>

</html>