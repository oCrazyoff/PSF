<?php
include("../../auth/config.php");
include("../../auth/valida.php");
include("../../database/utils/conexao.php");

$emailAtual = $_POST['emailAtual']; 
$sqlPessoasJuridica = "SELECT razao_social, nome_fantasia, cnpj, email, endereco, contato, cargo FROM pessoas WHERE email = ?";
$stmtPessoasJuridica = $conn->prepare($sqlPessoasJuridica);
$stmtPessoasJuridica->bind_param("s", $emailAtual);

if ($stmtPessoasJuridica->execute()) {
    $stmtPessoasJuridica->bind_result($razao_social, $nome_fantasia, $cnpj, $email, $endereco, $contato, $cargo);
    if ($stmtPessoasJuridica->fetch()) {
        if ($endereco != null or $endereco != "") {
            $partes = explode(", ", $endereco);

            $cep = $partes[0];
            $logradouro = $partes[1];
            $numero = $partes[2];
            $bairro = $partes[3];
            $complemento = count($partes) == 7 ? $partes[4] : "";
            $cidade = count($partes) == 7 ? $partes[5] : $partes[4];
            $estado = count($partes) == 7 ? $partes[6] : $partes[5];
        } else {
            $cep = "";
            $logradouro = "";
            $numero = "";
            $bairro = "";
            $complemento = "";
            $cidade = "";
            $estado = "";
        }
    } else {
        $_SESSION['resposta'] = "Erro ao editar usuario";
        header("Location: pessoas_juridica.php");
        exit;
    }
    $stmtPessoasJuridica->free_result();
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
        </div>
        <div class="form-container" id="large-form">
            <h2 class="form-title">Endereço</h2>
            <div class="card-form">
                <div class="form-group">
                    <label for="cep">CEP</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                        <input type="text" class="form-control" value="<?= ($cep ? $cep : "") ?>" name="cep" id="cep" maxlength="9"
                            placeholder="00000-000" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="rua">Logradouro</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                        <input type="text" class="form-control" value="<?= ($logradouro ? $logradouro : "") ?>" name="logradouro" id="logradouro"
                            placeholder="Digite o Logradouro" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="numero">Número</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                        <input type="number" class="form-control" value="<?= ($numero ? $numero : "") ?>" name="numero" id="numero"
                            placeholder="Digite o número" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="bairro">Bairro</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                        <input type="text" class="form-control" value="<?= ($bairro ? $bairro : "") ?>" name="bairro" id="bairro"
                            placeholder="Digite o bairro" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="complemento">Complemento(opcional)</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                        <input type="text" class="form-control" value="<?= ($complemento ? $complemento : "") ?>" name="complemento"
                            id="complemento" placeholder="Digite o completo">
                    </div>
                </div>
                <div class="form-group">
                    <label for="estado">Estado</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                        <input type="text" class="form-control" value="<?= ($estado ? $estado : "") ?>" name="estado" id="estado"
                            placeholder="Digite o estado" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="cidade">Cidade</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                        <input type="text" class="form-control" value="<?= ($cidade ? $cidade : "") ?>" name="cidade" id="cidade"
                            placeholder="Digite o cidade" required>
                    </div>
                </div>
            </div>
        </div>
        <div class="btn-submit-container">
            <button type="submit" class="btn-block-large">Editar</button>
        </div>
        </form>
    </div>
</body>
<?php
include("../../auth/validacoesFrontEnd.php");
?>

</html>