<?php
include("auth/config.php");
session_start();
$_SESSION['_csrf'] = !$_SESSION['_csrf'] ? hash('sha256', random_bytes(32)) : $_SESSION['_csrf'];
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logar</title>
    <?php include("includes/link_head.php") ?>
    <link rel="stylesheet" href="assets/css/form.css?v=<?php echo time(); ?>">
</head>

<body>
    <div class="form-container" id="index">
        <form action="auth/logar.php" method="post">
            <input type="hidden" name="_csrf" value="<?php echo htmlentities($_SESSION['_csrf']) ?>">
            <h2 class="form-title">Login</h2>
            <div class="form-group">
                <label for="email">E-mail</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Digite seu email"
                        required>
                </div>
            </div>
            <div class="form-group">
                <label for="senha">Senha</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input type="password" class="form-control" name="senha" id="senha" placeholder="Digite sua senha"
                        required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-block mt-3">Entrar</button>
            <div class="text-center mt-3">
                <span>Não tem uma conta?</span>
                <a href="pages/cadastrese.php" class="register-link">Cadastre-se</a>
            </div>
        </form>
    </div>
</body>

<script>
        <?php
        if (isset($_SESSION['resposta'])) {
            echo "alert('" . $_SESSION['resposta'] . "')";
            unset($_SESSION['resposta']);
        }
        ?>
    </script>

</html>