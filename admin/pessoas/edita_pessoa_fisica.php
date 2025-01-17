<?php
include("../../auth/config.php");
include("../../auth/valida.php");
include("../../database/utils/conexao.php");

$cpf = $_POST['cpfAtual'];
$email = $_POST['emailAtual'];

$sqlPessoasFisica = "SELECT nome, cpf, email, data_nascimento, contato, endereco FROM pessoas WHERE cpf = ? OR email = ?";
$stmtPessoasFisica = $conn->prepare($sqlPessoasFisica);
$stmtPessoasFisica->bind_param("ss", $cpf, $email);

if ($stmtPessoasFisica->execute()) {
    $stmtPessoasFisica->bind_result($nome, $cpf, $email, $data_nascimento, $contato, $endereco);
    if ($stmtPessoasFisica->fetch()) {
        $partes = explode(", ", $endereco);

        $cep = $partes[0];
        $logradouro = $partes[1];
        $numero = $partes[2];
        $bairro = $partes[3];
        $complemento = count($partes) == 7 ? $partes[4] : "";
        $cidade = count($partes) == 7 ? $partes[5] : $partes[4];
        $estado = count($partes) == 7 ? $partes[6] : $partes[5];
    } else {
        $_SESSION['resposta'] = "Erro ao editar usuario";
        header("Location: pessoas_fisica.php");
        exit;
    }
    $stmtPessoasFisica->free_result();
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar <?= $nome ?></title>
    <?php include("../../includes/link_head.php") ?>
    <link rel="stylesheet" href="../../assets/css/form.css?v=<?php echo time(); ?>">
</head>

<body>
    <?php include("../../includes/header.php") ?>
    <?php include("../../includes/menu.php") ?>
    <div class="content">
        <div class="form-container" id="large-form">
            <h2 class="form-title">Informações Pessoais</h2>
            <form action="../../database/pessoas/cadastrar_pessoa_fisica.php" method="post">
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                        <input type="text" class="form-control" value="<?= $nome ?>" name="nome" id="nome"
                            placeholder="Digite o nome" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="cpf">CPF</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-address-card"></i></span>
                        <input type="text" class="form-control" value="<?= $cpf ?>" name="cpf" id="cpf" maxlength="14"
                            placeholder="000.000.000-00">
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                        <input type="text" class="form-control" value="<?= $email ?>" name="email" id="email"
                            placeholder="Digite o email">
                    </div>
                </div>
                <div class="form-group">
                    <label for="data_nascimento">Data de nascimento</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-calendar-days"></i></span>
                        <input type="date" class="form-control" value="<?= $data_nascimento ?>" name="data_nascimento"
                            id="data_nascimento" placeholder="Digite a Data de nascimento" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="contato">Contato</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-phone"></i></span>
                        <input type="text" class="form-control" value="<?= $contato ?>" name="contato" id="contato"
                            placeholder="Digite o contato">
                    </div>
                </div>
        </div>
        <div class="form-container" id="large-form">
            <h2 class="form-title">Endereço</h2>
            <div class="card-form">
                <div class="form-group">
                    <label for="cep">CEP</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                        <input type="text" class="form-control" value="<?= $cep ?>" name="cep" id="cep" maxlength="9"
                            placeholder="00000-000" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="rua">Logradouro</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                        <input type="text" class="form-control" value="<?= $logradouro ?>" name="rua" id="rua"
                            placeholder="Digite o Logradouro" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="numero">Número</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                        <input type="number" class="form-control" value="<?= $numero ?>" name="numero" id="numero"
                            placeholder="Digite o número" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="bairro">Bairro</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                        <input type="text" class="form-control" value="<?= $bairro ?>" name="bairro" id="bairro"
                            placeholder="Digite o bairro" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="complemento">Complemento(opcional)</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                        <input type="text" class="form-control" value="<?= $complemento ?>" name="complemento"
                            id="complemento" placeholder="Digite o completo">
                    </div>
                </div>
                <div class="form-group">
                    <label for="estado">Estado</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                        <input type="text" class="form-control" value="<?= $estado ?>" name="estado" id="estado"
                            placeholder="Digite o estado" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="cidade">Cidade</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                        <input type="text" class="form-control" value="<?= $cidade ?>" name="cidade" id="cidade"
                            placeholder="Digite o cidade" required>
                    </div>
                </div>
            </div>
        </div>
        <div class="btn-submit-container">
            <button type="submit" class="btn-block-large">Editar</button>
        </div>
        </form>
</body>
<?php
include("../../auth/validacoesFrontEnd.php");
?>

</html>