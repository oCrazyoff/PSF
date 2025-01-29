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
    <title>Cadastrar Funcionário</title>
    <?php include("../../includes/link_head.php") ?>
    <link rel="stylesheet" href="../../assets/css/form.css?v=<?php echo time(); ?>">
</head>

<body>
    <?php include("../../includes/header.php") ?>
    <?php include("../../includes/menu.php") ?>
    <div class="content">
        <div class="form-container" id="large-form">
            <h2 class="form-title">Dados Pessoais</h2>
            <form action="../../database/funcionarios/cadastrar_funcionario.php" method="post">
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                        <input type="text" class="form-control" name="nome" id="nome" placeholder="Digite o Nome"
                            required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="cpf">CPF</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-address-card"></i></span>
                        <input type="text" class="form-control" name="cpf" id="cpf" placeholder="Digite o CPF" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                        <input type="text" class="form-control" name="email" id="email" placeholder="Digite o Email"
                            required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="data_nascimento">Data de Nascimento</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-regular fa-calendar-days"></i></span>
                        <input type="date" class="form-control" name="data_nascimento" id="data_nascimento" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="contato">Contato</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-phone"></i></span>
                        <input type="text" class="form-control" name="contato" id="contato"
                            placeholder="Digite o Contato" required>
                    </div>
                </div>
                <div class="form-group">
                <label for="salario">Salário</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-money-bill"></i></span>
                    <input type="number" step="0.01" class="form-control" name="salario" id="salario"
                        placeholder="Digite o Salário" required>
                </div>
            </div>
            <div class="form-group">
                <label for="data_admissao">Data de Admissão</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-calendar-check"></i></span>
                    <input type="date" class="form-control" name="data_admissao" id="data_admissao"
                        placeholder="Digite a Data de Admissão" required>
                </div>
            </div>
            <div class="form-group">
                <label for="cargo">Cargo</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-briefcase"></i></span>
                    <select name="cargo" id="cargo" required>
                        <option value="" disabled selected>Selecione uma opção</option>
                        <?php
                        $sqlCargo = "SELECT id, nome FROM cargos WHERE status = 1";
                        $resultadoCargo = $conn->query($sqlCargo);
                        while ($rowCargo = $resultadoCargo->fetch_assoc()) {
                            echo "
                                <option value='" . $rowCargo['id'] . "'>" . $rowCargo['nome'] . "</option>
                                ";
                        }
                        ?>
                    </select>
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
            <button type="submit" class="btn-block-large">Cadastrar</button>
        </div>
        </form>
    </div>
</body>

<script>
    document.getElementById('data_admissao').value = "<?php echo date('Y-m-d'); ?>";
</script>

</html>