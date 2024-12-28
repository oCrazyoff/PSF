<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastre-se</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/form.css">
</head>

<body>
    <div class="form-container">
        <form action="cadastrar.php" method="post">
            <h2 class="form-title">Cadastro</h2>
            <div class="form-group">
                <label for="nome">Nome Completo</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                    <input type="text" class="form-control" name="nome" id="nome" placeholder="Digite seu nome completo"
                        required>
                </div>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
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
            <div class="form-group">
                <label for="confirma-senha">Confirme sua Senha</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input type="password" class="form-control" name="confirma_senha" id="confirma-senha"
                        placeholder="Confirme sua senha" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-block mt-3">Cadastrar</button>
            <div class="text-center mt-3">
                <span>Já tem uma conta?</span>
                <a href="../index.php" class="register-link">Voltar ao Login</a>
            </div>
        </form>
    </div>
</body>

</html>