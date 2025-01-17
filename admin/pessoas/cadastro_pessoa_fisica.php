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
    <title>Cadastro de Pessoa Física</title>
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
                        <input type="text" class="form-control" name="nome" id="nome"
                            placeholder="Digite o nome" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="cpf">CPF</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-address-card"></i></span>
                        <input type="text" class="form-control" name="cpf" id="cpf" maxlength="14" placeholder="000.000.000-00">
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                        <input type="text" class="form-control" name="email" id="email"
                            placeholder="Digite o email">
                    </div>
                </div>
                <div class="form-group">
                    <label for="data_nascimento">Data de nascimento</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-calendar-days"></i></span>
                        <input type="date" class="form-control" name="data_nascimento" id="data_nascimento"
                            placeholder="Digite a Data de nascimento" required>
                    </div>
                </div>
        </div>
        <div class="form-container" id="large-form">
            <h2 class="form-title">Endereço</h2>
            <div class="form-group">
                <label for="cep">CEP</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                    <input type="text" class="form-control" name="cep" id="cep" maxlength="9" placeholder="00000-000" required>
                </div>
            </div>
            <div class="form-group">
                <label for="rua">Logradouro</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                    <input type="text" class="form-control" name="rua" id="rua" placeholder="Digite o Logradouro" required>
                </div>
            </div>
            <div class="form-group">
                <label for="numero">Número</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                    <input type="number" class="form-control" name="numero" id="numero" placeholder="Digite o número" required>
                </div>
            </div>
            <div class="form-group">
                <label for="bairro">Bairro</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                    <input type="text" class="form-control" name="bairro" id="bairro" placeholder="Digite o bairro" required>
                </div>
            </div>
            <div class="form-group">
                <label for="complemento">Complemento(opcional)</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                    <input type="text" class="form-control" name="complemento" id="complemento" placeholder="Digite o completo">
                </div>
            </div>
            <div class="form-group">
                <label for="estado">Estado</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                    <input type="text" class="form-control" name="estado" id="estado" placeholder="Digite o estado" required>
                </div>
            </div>
            <div class="form-group">
                <label for="cidade">Cidade</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                    <input type="text" class="form-control" name="cidade" id="cidade" placeholder="Digite o cidade" required>
                </div>
            </div>
        </div>
        <div class="form-container" id="large-form">
            <h2 class="form-title">Endereço</h2>
            <div class="form-group">
                <label for="contato">Contato</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-phone"></i></span>
                    <input type="text" class="form-control" name="contato" id="contato"
                        placeholder="Digite o contato">
                </div>
            </div>
        </div>
        <div class="form-container" id="large-form">
            <h2 class="form-title">Informações Administrativas</h2>
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
            <button type="submit" class="btn btn-primary btn-block mt-3">Cadastrar</button>
            </form>
        </div>


</body>
<?php
include("../../auth/validacoesFrontEnd.php");
?>

</html>