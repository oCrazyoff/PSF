<?php
include("../../auth/config.php");
include("../../auth/valida.php");
include("../../database/utils/conexao.php");

$emailAtual = $_POST['emailAtual'];
$sqlPessoas = "SELECT razao_social, nome_fantasia, cnpj, email, endereco, contato, cargo FROM pessoas WHERE email = '$emailAtual'";
$resultadoPessoas = $conn->query($sqlPessoas);

while ($rowPessoas = $resultadoPessoas->fetch_assoc()) {
    $razao_social = $rowPessoas["razao_social"];
    $nome_fantasia = $rowPessoas["nome_fantasia"];
    $cnpj = $rowPessoas["cnpj"];
    $email = $rowPessoas["email"];
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
    <title>Editar <?php echo $nome_fantasia ?></title>
    <?php include("../../includes/link_head.php") ?>
    <link rel="stylesheet" href="../../assets/css/form.css?v=<?php echo time(); ?>">
</head>

<body>
    <?php include("../../includes/header.php") ?>
    <?php include("../../includes/menu.php") ?>
    <div class="content">
        <div class="form-container" id="large-form">
            <h2 class="form-title">Editar <?php echo $nome_fantasia ?></h2>
            <form action="../../database/pessoas/editar_pessoa_juridica.php" method="post">
                <div class="form-group">
                    <label for="razao_social">Razão Social</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                        <input type="text" class="form-control" value="<?php echo $razao_social ?>" name="razao_social" id="razao_social" placeholder="Digite a razão social" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="nome_fantasia">Nome Fantásia</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                        <input type="text" class="form-control" value="<?php echo $nome_fantasia ?>" name="nome_fantasia" id="nome_fantasia" placeholder="Digite o nome fantásia" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="cnpj">CNPJ</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-address-card"></i></span>
                        <input type="text" class="form-control" value="<?php echo $cnpj ?>" name="cnpj"
                            id="cnpj" placeholder="Digite o CNPJ">
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
                <input type="hidden" value="<?php echo $cnpj ?>" name="cnpjAtual">
                <button type="submit" class="btn btn-primary btn-block mt-3">Editar</button>
            </form>
        </div>
    </div>

</body>

</html>