<?php
include("../../auth/config.php");
include("../../auth/valida.php");
include("../../database/utils/conexao.php");

$id = $_POST['id'];

$sql = "SELECT * FROM funcionarios WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $id);
$stmt->execute();
$resultado = $stmt->get_result();
$rowFuncionarios = $resultado->fetch_assoc();
$stmt->close();

$cpf = $rowFuncionarios['cpf'];

$sqlPessoas = "SELECT * FROM pessoas WHERE cpf = ?";
$stmt = $conn->prepare($sqlPessoas);
$stmt->bind_param("s", $cpf);
$stmt->execute();
$resultado = $stmt->get_result();
$rowPessoas = $resultado->fetch_assoc();
$stmt->close();

$idPessoa = $rowPessoas['id'];

$nome = $rowPessoas['nome'];
$email = $rowPessoas['email'];
$data_nascimento = $rowPessoas['data_nascimento'];
$endereco = $rowPessoas['endereco'];
$contato = $rowPessoas['contato'];
$salario = $rowFuncionarios['salario'];
$data_admissao = $rowFuncionarios['data_admissao'];
$cargo = $rowPessoas['cargo'];
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
            <form action="../../database/funcionarios/editar_funcionario.php" method="post">
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                        <input type="text" class="form-control" value="<?php echo $nome ?>" name="nome" id="nome"
                            placeholder="Digite o Nome" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="cpf">CPF</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-address-card"></i></span>
                        <input type="text" class="form-control" value="<?php echo $cpf ?>" name="cpf" id="cpf"
                            placeholder="Digite o CPF" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                        <input type="text" class="form-control" value="<?php echo $email ?>" name="email" id="email"
                            placeholder="Digite o Email" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="data_nascimento">Data de Nascimento</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-regular fa-calendar-days"></i></span>
                        <input type="date" class="form-control" value="<?php echo $data_nascimento ?>"
                            name="data_nascimento" id="data_nascimento" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="endereco">Endereço</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-map-location"></i></span>
                        <input type="text" class="form-control" value="<?php echo $endereco ?>" name="endereco"
                            id="endereco" placeholder="Digite o Endereço" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="contato">Contato</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-phone"></i></span>
                        <input type="text" class="form-control" value="<?php echo $contato ?>" name="contato"
                            id="contato" placeholder="Digite o Contato" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="salario">Salário</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-money-bill"></i></span>
                        <input type="number" step="0.01" class="form-control" value="<?php echo $salario ?>"
                            name="salario" id="salario" placeholder="Digite o Salário" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="data_admissao">Data de Admissão</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-calendar-check"></i></span>
                        <input type="date" class="form-control" value="<?php echo $data_admissao ?>"
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
                                <option value='" . $rowCargo['id'] . "' " . (($rowCargo['id'] == $cargo) ? "selected" : "") . " >" . $rowCargo['nome'] . "</option>
                                ";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <input type="hidden" name="idFuncionario" value="<?php echo $id ?>">
                <input type="hidden" name="idPessoa" value="<?php echo $idPessoa ?>">
                <button type="submit" class="btn btn-primary btn-block mt-3">Editar</button>
            </form>
        </div>
    </div>
</body>

<script>
document.getElementById('data_admissao').value = "<?php echo date('Y-m-d'); ?>";
</script>

</html>