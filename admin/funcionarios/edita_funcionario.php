<?php
include("../../auth/config.php");
include("../../auth/valida.php");
include("../../database/utils/conexao.php");

$cpf = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_SPECIAL_CHARS);

$sql = "SELECT f.id AS idFuncionario, f.salario,f.data_admissao,f.data_demissao,f.status AS statusFuncionario, p.id AS idPessoas, p.nome, p.email, p.data_nascimento, p.endereco, p.contato, p.cargo 
        FROM funcionarios f 
        JOIN pessoas p ON f.cpf = p.cpf 
        WHERE f.cpf = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $cpf);

if ($stmt->execute()) {
    $stmt->bind_result($idFuncionario, $salario, $data_admissao, $data_demissao, $statusFuncionario, $idPessoas, $nome, $email, $data_nascimento, $endereco, $contato, $cargoFuncionario);
    $stmt->fetch();
    if ($endereco != null || $endereco != "") {
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
}
$stmt->close();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar <?= $nome ?></title>
    <?php include("../../includes/link_head.php") ?>
    <link rel="stylesheet" href="../../assets/css/form.css?v=<?= time(); ?>">
</head>

<body>
    <?php include("../../includes/header.php") ?>
    <?php include("../../includes/menu.php") ?>
    <div class="content">
        <div class="form-container" id="large-form">
            <h2 class="form-title">Editar <?= htmlentities($nome) ?></h2>
            <form action="../../database/funcionarios/editar_funcionario.php" method="post">
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                        <input type="text" class="form-control" value="<?= htmlentities($nome) ?>" name="nome" id="nome"
                            placeholder="Digite o Nome" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="cpf">CPF</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-address-card"></i></span>
                        <input type="text" class="form-control" value="<?= htmlentities($cpf) ?>" name="cpf" id="cpf"
                            placeholder="Digite o CPF" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                        <input type="text" class="form-control" value="<?= htmlentities($email) ?>" name="email" id="email"
                            placeholder="Digite o Email" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="data_nascimento">Data de Nascimento</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-regular fa-calendar-days"></i></span>
                        <input type="date" class="form-control" value="<?= htmlentities($data_nascimento) ?>"
                            name="data_nascimento" id="data_nascimento" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="contato">Contato</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-phone"></i></span>
                        <input type="text" class="form-control" value="<?= htmlentities($contato) ?>" name="contato"
                            id="contato" placeholder="Digite o Contato" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="salario">Salário</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-money-bill"></i></span>
                        <input type="number" step="0.01" class="form-control" value="<?= htmlentities($salario) ?>"
                            name="salario" id="salario" placeholder="Digite o Salário" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="data_admissao">Data de Admissão</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-calendar-check"></i></span>
                        <input type="date" class="form-control" value="<?= htmlentities($data_admissao)  ?>"
                            name="data_admissao" id="data_admissao" placeholder="Digite a Data de Admissão" required>
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
                                <option value='" . htmlentities($rowCargo['id']) . "'" . (($rowCargo['id'] == $cargoFuncionario) ? "selected" : "") . ">" . htmlentities($rowCargo['nome']) . "</option>
                                ";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <input type="hidden" name="idFuncionario" value="<?= $idFuncionario ?>">
                <input type="hidden" name="idPessoa" value="<?= $idPessoas ?>">
        </div>
        <div class="form-container" id="large-form">
            <h2 class="form-title">Endereço</h2>
            <div class="card-form">
                <div class="form-group">
                    <label for="cep">CEP</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                        <input type="text" class="form-control" value="<?= htmlentities($cep) ?>" name="cep" id="cep" maxlength="9"
                            placeholder="00000-000" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="rua">Logradouro</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                        <input type="text" class="form-control" value="<?= htmlentities($logradouro) ?>" name="logradouro" id="logradouro"
                            placeholder="Digite o Logradouro" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="numero">Número</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                        <input type="number" class="form-control" value="<?= htmlentities($numero) ?>" name="numero" id="numero"
                            placeholder="Digite o número" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="bairro">Bairro</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                        <input type="text" class="form-control" value="<?= htmlentities($bairro) ?>" name="bairro" id="bairro"
                            placeholder="Digite o bairro" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="complemento">Complemento(opcional)</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                        <input type="text" class="form-control" value="<?= htmlentities($complemento) ?>" name="complemento"
                            id="complemento" placeholder="Digite o completo">
                    </div>
                </div>
                <div class="form-group">
                    <label for="estado">Estado</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                        <input type="text" class="form-control" value="<?= htmlentities($estado) ?>" name="estado" id="estado"
                            placeholder="Digite o estado" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="cidade">Cidade</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                        <input type="text" class="form-control" value="<?= htmlentities($cidade) ?>" name="cidade" id="cidade"
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

<script>
    document.getElementById('data_admissao').value = "<?php echo date('Y-m-d'); ?>";
</script>
<?php
include("../../auth/validacoesFrontEnd.php");
?>

</html>