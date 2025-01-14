<?php
include("../../auth/config.php");
include("../../auth/valida.php");
include("../../database/utils/conexao.php");

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    $emailAtual = $_POST['emailAtual'];
    $cpfAtual = $_POST["cpfAtual"];

    if ($cpfAtual != null){
        $sqlPessoas = "SELECT nome, cpf, email, data_nascimento, endereco, contato, cargo FROM pessoas WHERE cpf = '$cpfAtual'";
    } else if($emailAtual != null){
        $sqlPessoas = "SELECT nome, cpf, email, data_nascimento, endereco, contato, cargo FROM pessoas WHERE email = '$emailAtual'";
    } else {
        $_SESSION['resposta'] = "Usuário não possui nem email e nem cpf!";
        header("Location: ../../admin/pessoas/pessoas_fisica.php");
        exit();
    }
} else {
    $_SESSION['resposta'] = "Método de solicitação ínvalido!";
    header("Location: ../../admin/pessoas/pessoas_fisica.php");
    exit();
}


$resultadoPessoas = $conn->query($sqlPessoas);

while ($rowPessoas = $resultadoPessoas->fetch_assoc()) {
    $nome = $rowPessoas["nome"];
    $cpf = $rowPessoas["cpf"];
    $email = $rowPessoas["email"];
    $data_nascimento = $rowPessoas["data_nascimento"];
    $endereco = $rowPessoas["endereco"];
    $contato = $rowPessoas["contato"];
    $cargo = $rowPessoas["cargo"];
}

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
        <div class="form-container" id="large-form">
            <h2 class="form-title">Editar <?php echo $nome ?></h2>
            <form action="../../database/pessoas/editar_pessoa_fisica.php" method="post">
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                        <input type="text" class="form-control" value="<?php echo $nome ?>" name="nome" id="nome"
                            placeholder="Digite o nome" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="cpf">CPF</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-address-card"></i></span>
                        <input type="text" class="form-control" value="<?php echo $cpf ?>" name="cpf"
                            id="cpf" placeholder="Digite o CPF">
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                        <input type="text" class="form-control" value="<?php echo $email ?>" name="email"
                            id="email" placeholder="Digite o Nome Fantásia">
                    </div>
                </div>
                <div class="form-group">
                    <label for="data_nascimento">Data de nascimento</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-calendar-days"></i></span>
                        <input type="date" class="form-control" name="data_nascimento" id="data_nascimento" value="<?php echo $data_nascimento ?>" placeholder="Digite a Data de nascimento" required>
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
                <div class="form-group">
                    <label for="cargo">Cargo</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-briefcase"></i></span>
                        <select name="cargo" id="cargo" required>
                            <?php
                            $sqlCargo = "SELECT id, nome FROM cargos WHERE status = 1";
                            $resultadoCargo = $conn->query($sqlCargo);
                            while ($rowCargo = $resultadoCargo->fetch_assoc()) {
                                echo "
                                <option value='" . $rowCargo['id'] . "' " . (($rowCargo['id'] == $cargo) ? "selected" : "") . " >" . $rowCargo['nome'] . "</option>
                                ";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <input type="hidden" value="<?php echo $email ?>" name="emailAtual">
                <input type="hidden" value="<?php echo $cpf ?>" name="cpfAtual">
                <button type="submit" class="btn btn-primary btn-block mt-3">Editar</button>
            </form>
        </div>
    </div>

</body>

</html>