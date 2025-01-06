<?php
include("../../auth/valida.php");
include("../../auth/config.php");
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
            <h2 class="form-title">Cadastrar Funcionário</h2>
            <form action="../../database/funcionarios/cadastrar_funcionario.php" method="post">
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-truck"></i></span>
                        <select name="nome" id="nome" required>
                            <option value="" disabled selected>Selecione o Nome</option>
                            <?php
                            $sqlNome = "SELECT id, nome FROM pessoas WHERE status = 1 AND tipo_pessoa = 1 AND cargo = 4";
                            $resultadoNome = $conn->query($sqlNome);
                            while ($rowNome = $resultadoNome->fetch_assoc()) {
                                echo "
                                <option value='" . $rowNome['id'] . "'>" . $rowNome['nome'] . "</option>
                                ";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="cpf">CPF</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-solid fa-truck"></i></span>
                            <select name="cpf" id="cpf" required>
                                <option value="" disabled selected>Selecione o CPF</option>
                                <?php
                                $sqlCPF = "SELECT id, cpf FROM pessoas WHERE status = 1 and tipo_pessoa = 1 AND cargo = 4";
                                $resultadoCPF = $conn->query($sqlCPF);
                                while ($rowCPF = $resultadoCPF->fetch_assoc()) {
                                    echo "
                                <option value='" . $rowCPF['id'] . "'>" . $rowCPF['cpf'] . "</option>
                                ";
                                }
                                ?>
                            </select>
                        </div>
                    <div class="form-group">
                        <label for="salario">Salário</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-solid fa-barcode"></i></span>
                            <input type="text" class="form-control" name="salario" id="salario"
                                placeholder="Digite o salário" required>
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
                            <span class="input-group-text"><i class="fa-solid fa-truck"></i></span>
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
                    <div>
                        <p>Pessoa ainda não cadastrada?<a href="#">Cadatrar Pessoa</a></p>
                    </div>
            </form>
        </div>
    </div>

</body>

</html>