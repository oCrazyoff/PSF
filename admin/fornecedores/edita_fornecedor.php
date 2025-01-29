<?php
include("../../auth/config.php");
include("../../auth/valida.php");
include("../../database/utils/conexao.php");

$cnpj = $_POST['cnpj'];
$sql = "SELECT * FROM pessoas WHERE cnpj = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $cnpj);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if ($row['endereco'] != null || $row['endereco'] != "") {
    $partes = explode(", ", $row['endereco']);
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

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar <?= htmlentities($row['nome_fantasia']) ?></title>
    <?php include("../../includes/link_head.php") ?>
    <link rel="stylesheet" href="../../assets/css/form.css">
</head>

<body>
    <?php include("../../includes/header.php") ?>
    <?php include("../../includes/menu.php") ?>
    <div class="content">
        <div class="form-container" id="large-form">
            <h2 class="form-title">Editar <?= htmlentities($row['nome_fantasia']) ?></h2>
            <form action="../../database/fornecedores/editar_fornecedor.php" method="post">
                <div class="form-group">
                    <label for="cnpj">CNPJ</label>
                    <div class="input-group">
                        <input type="hidden" name="cnpjAntigo" value="<?= htmlentities($row['cnpj']) ?>">
                        <span class="input-group-text"><i class="fa-regular fa-id-card"></i></span>
                        <input type="text" class="form-control" value="<?= htmlentities($row['cnpj']) ?>" name="cnpj"
                            id="cnpj" placeholder="Digite sua CNPJ" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="razao_social">Razão Social</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-file-signature"></i></span>
                        <input type="text" class="form-control" value="<?= htmlentities($row['razao_social']) ?>"
                            name="razao_social" id="razao_social" placeholder="Digite sua Razão Social" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="nome_fantasia">Nome Fantasia</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-pen-to-square"></i></span>
                        <input type="text" class="form-control" value="<?= htmlentities($row['nome_fantasia']) ?>"
                            name="nome_fantasia" id="nome_fantasia" placeholder="Digite seu Nome Fantásia" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="contato">Contato</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-phone"></i></span>
                        <input type="text" class="form-control" value="<?= htmlentities($row['contato']) ?>"
                            name="contato" id="contato" placeholder="Digite seu Contato" required>
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
                        <input type="text" class="form-control" value="<?= htmlentities($cep) ?>" name="cep" id="cep"
                            maxlength="9" placeholder="00000-000" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="logradouro">Logradouro</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                        <input type="text" class="form-control" value="<?= htmlentities($logradouro) ?>"
                            name="logradouro" id="logradouro" placeholder="Digite o Logradouro" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="numero">Número</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                        <input type="number" class="form-control" value="<?= htmlentities($numero) ?>" name="numero"
                            id="numero" placeholder="Digite o número" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="bairro">Bairro</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                        <input type="text" class="form-control" value="<?= htmlentities($bairro) ?>" name="bairro"
                            id="bairro" placeholder="Digite o bairro" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="complemento">Complemento(opcional)</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                        <input type="text" class="form-control" value="<?= htmlentities($complemento) ?>"
                            name="complemento" id="complemento" placeholder="Digite o completo">
                    </div>
                </div>
                <div class="form-group">
                    <label for="estado">Estado</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                        <input type="text" class="form-control" value="<?= htmlentities($estado) ?>" name="estado"
                            id="estado" placeholder="Digite o estado" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="cidade">Cidade</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                        <input type="text" class="form-control" value="<?= htmlentities($cidade) ?>" name="cidade"
                            id="cidade" placeholder="Digite o cidade" required>
                    </div>
                </div>
            </div>
        </div>
        <div class="btn-submit-container">
            <button type="submit" class="btn-block-large">Editar</button>
        </div>
        </form>
    </div>
    </div>
</body>

</html>