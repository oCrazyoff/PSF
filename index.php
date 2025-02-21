<?php
session_start();
include("auth/config.php");

$_SESSION['_csrf'] = (isset($_SESSION['_csrf'])) ? $_SESSION['_csrf'] : hash('sha256', random_bytes(32));
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <?php include("includes/link_head.php") ?>
    <?php include("includes/div_erro.php") ?>
    <link rel="stylesheet" href="assets/css/index.css?v=<?php echo time(); ?>">
</head>

<body>
    <div class="form-container" id="index">
        <div class="form-image-cadastrar">
            <h2>PSF System</h2>
            <p>Seja bem vindo ao nosso sistema, não tem uma conta?</p>
            <button class="btn-cadastro">Cadastre-se</button>
        </div>
        <div class="form-image-logar">
            <h2>PSF System</h2>
            <p>Seja bem vindo ao nosso sistema, já tem uma conta?</p>
            <button class="btn-cadastro">Fazer Login</button>
        </div>
        <div class="form-cadastro">
            <form action="database/clientes/cadastrar_cliente.php" method="post">
                <h2 class="form-title">Criar Conta</h2>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                        <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome completo"
                            required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input type="email" class="form-control" name="email" id="email" placeholder="E-mail"
                            required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" class="form-control" name="senha" id="mostrar-senha-input-cadastro" placeholder="Senha"
                            required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" class="form-control" name="confirma_senha" id="mostrar-confirmasenha-input-cadastro"
                            placeholder="Confirme sua senha" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="mostrar-senha-checkbox-cadastro" class="mostra-senha">
                        <input type="checkbox" class="form-check-input" id="mostrar-senha-checkbox-cadastro">
                        Mostrar / Esconder Senha
                    </label>
                </div>
                <button type="submit" class="confirm-button">Cadastrar</button>
            </form>
        </div>
        <div class="form-login">
            <form action="auth/logar.php" method="post">
                <input type="hidden" name="_csrf" value="<?php echo htmlentities($_SESSION['_csrf']) ?>">
                <h2 class="form-title">Login</h2>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input type="email" class="form-control" name="email" id="email" placeholder="E-mail"
                            required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" class="form-control" name="senha" id="mostrar-senha-input-login" placeholder="Senha"
                            required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="mostrar-senha-checkbox-login" class="mostra-senha">
                        <input type="checkbox" class="form-check-input" id="mostrar-senha-checkbox-login">
                        Mostrar / Esconder Senha
                    </label>
                </div>
                <button type="submit" class="confirm-button">Entrar</button>
            </form>
        </div>
    </div>
</body>
<script>
    document.querySelector('.form-image-cadastrar button').addEventListener('click', function() {
        document.querySelector('.form-image-cadastrar').classList.add('slide-out-to-left');
        document.querySelector('.form-image-logar').classList.add('slide-in-from-right');
        document.querySelector('.form-image-logar').classList.remove('hidden');
        document.querySelector('.form-image-logar').classList.add('visible');
        setTimeout(function() {
            document.querySelector('.form-image-cadastrar').classList.add('hidden');
            document.querySelector('.form-image-cadastrar').classList.remove('visible', 'slide-out-to-left');
            document.querySelector('.form-image-logar').classList.remove('slide-in-from-right');
        }, 250);
    });

    document.querySelector('.form-image-logar button').addEventListener('click', function() {
        document.querySelector('.form-image-logar').classList.add('slide-out-to-right');
        document.querySelector('.form-image-cadastrar').classList.add('slide-in-from-left');
        document.querySelector('.form-image-cadastrar').classList.remove('hidden');
        document.querySelector('.form-image-cadastrar').classList.add('visible');
        setTimeout(function() {
            document.querySelector('.form-image-logar').classList.add('hidden');
            document.querySelector('.form-image-logar').classList.remove('visible', 'slide-out-to-right');
            document.querySelector('.form-image-cadastrar').classList.remove('slide-in-from-left');
        }, 250);
    });
</script>
<script src="assets/js/mostrar-senha.js"></script>

</html>