<?php
include("../../auth/config.php");
include("../../auth/valida.php");
include("../../database/utils/conexao.php");

$id = $_POST['id'];

$sql = "SELECT * FROM produtos WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$produto = $result->fetch_assoc();
$stmt->close();

$imgSrc = 'data:image/jpeg;base64,' . base64_encode($produto['imagem']);

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar <?= $produto['nome'] ?> </title>
    <?php include("../../includes/link_head.php") ?>
    <link rel="stylesheet" href="../../assets/css/form.css?v=<?php echo time(); ?>">
</head>

<body>
    <?php include("../../includes/header.php") ?>
    <?php include("../../includes/menu.php") ?>
    <div class="content">
        <div class="form-container" id="large-form">
            <h2 class="form-title">Imagem do Produto</h2>
            <form action="../../database/produtos/editar_produto.php" method="post" enctype="multipart/form-data">
                <div class="input-file">
                    <div class="form-group">
                        <div class="input-group">
                            <img id="preview"
                                src=" <?= (($produto['imagem'] != null || $produto['imagem'] != "") ? $imgSrc : "../../assets/img/placeholder.png") ?> "
                                alt="Pré-visualização da Imagem">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="imagem">Arquivo da imagem</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-solid fa-image"></i></span>
                            <input type="file" class="form-control" name="imagem" id="imagem"
                                accept="image/png, image/jpeg">
                        </div>
                    </div>
                </div>
        </div>
        <div class="form-container" id="large-form">
            <h2 class="form-title">Informações Gerais</h2>
            <div class="card-form">
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-pen"></i></span>
                        <input type="text" class="form-control" value="<?= $produto['nome'] ?>" name="nome" id="nome"
                            placeholder="Digite nome do produto" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="codigo">Código de Barras</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-barcode"></i></span>
                        <input type="text" class="form-control" value="<?= $produto['codigo_barra'] ?>" name="codigo"
                            id="codigo" placeholder="Digite o Código de Barras">
                    </div>
                </div>
                <div class="form-group">
                    <label for="fornecedor">Fornecedores</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-truck"></i></span>
                        <select name="fornecedor" id="fornecedor" required>
                            <?php
                            $sqlForn = "SELECT * FROM fornecedores WHERE status = 1";
                            $resultadoForn = $conn->query($sqlForn);
                            while ($rowForn = $resultadoForn->fetch_assoc()) {
                                $sqlPess = "SELECT nome_fantasia FROM pessoas where cnpj = '" . $rowForn['cnpj'] . "'";
                                $resultadoPess = $conn->query($sqlPess);
                                $nomeForn =  $resultadoPess->fetch_assoc();
                                echo "
                                <option value='" . $rowForn['id'] . "'" . (($rowForn['id'] == $produto['fornecedor']) ? "selected" : "") . ">" . $nomeForn['nome_fantasia'] . "</option>
                                ";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="marca">Marca</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-tags"></i></span>
                        <select name="marca" id="marca" required>
                            <?php
                            $sqlMarca = "SELECT * FROM marcas WHERE status = 1";
                            $resultadoMarca = $conn->query($sqlMarca);
                            while ($rowMarca = $resultadoMarca->fetch_assoc()) {
                                echo "
                                <option value='" . $rowMarca['id'] . "'" . (($rowMarca['id'] == $produto['marca']) ? "selected" : "") . ">" . $rowMarca['nome'] . "</option>
                                ";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="grupo">Grupo</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-boxes-stacked"></i></span>
                        <select name="grupo" id="grupo" required>
                            <?php
                            $sqlGrupo = "SELECT * from grupos WHERE status = 1";
                            $resultadoGrupo = $conn->query($sqlGrupo);
                            while ($rowGrupo = $resultadoGrupo->fetch_assoc()) {
                                echo "
                                <option value='" . $rowGrupo['id'] . "'" . (($rowGrupo['id'] == $produto['grupo']) ? "selected" : "") . ">" . $rowGrupo['nome'] . "</option>
                                ";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="subgrupo">Sub Grupo</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-dolly"></i></span>
                        <select name="subgrupo" id="subgrupo" required>
                            <?php
                            $sqlSubgrupo = "SELECT * FROM subgrupo WHERE status = 1";
                            $resultadoSubgrupo = $conn->query($sqlSubgrupo);
                            while ($rowSubgrupo = $resultadoSubgrupo->fetch_assoc()) {
                                echo "
                                <option value='" . $rowSubgrupo['id'] . "'" . (($rowSubgrupo['id'] == $produto['subgrupo']) ? "selected" : "") . ">" . $rowSubgrupo['nome'] . "</option>
                                ";
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-container" id="large-form">
            <h2 class="form-title">Preço e Estoque</h2>
            <div class="card-form">
                <div class="form-group">
                    <label for="preco_custo">Preço de Custo</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-money-bill"></i></span>
                        <input type="number" step="0.01" class="form-control" value="<?= $produto['preco_custo'] ?>"
                            name="preco_custo" id="preco_custo" placeholder="Digite o Preço de Custo" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="preco_venda">Preço de Venda</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-hand-holding-dollar"></i></span>
                        <input type="number" step="0.01" class="form-control" value="<?= $produto['preco_venda'] ?>"
                            name="preco_venda" id="preco_venda" placeholder="Digite o Preço de Venda" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="quantidade">Quantidade</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-list-ol"></i></span>
                        <input type="number" class="form-control" value="<?= $produto['quantidade'] ?>"
                            name="quantidade" id="quantidade" placeholder="Digite a Quantidade" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="validade">Validade</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-calendar-check"></i></span>
                        <input type="date" class="form-control" value="<?= $produto['validade'] ?>" name="validade"
                            id="validade" placeholder="Digite a Validade" required>
                    </div>
                </div>
            </div>
        </div>
        <div class="btn-submit-container">
            <input type="hidden" name="id" value="<?= $produto['id'] ?>">
            <button type="submit" class="btn-block-large">Editar</button>
        </div>
        </form>
    </div>
    </div>
    <script>
        document.getElementById('imagem').addEventListener('change', function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview').src = e.target.result;
                document.getElementById('preview').style.display = 'block';
            };
            reader.readAsDataURL(this.files[0]);
        });
    </script>
    <script>
        <?php
        if (isset($_SESSION['resposta'])) {
            echo "alert('" . $_SESSION['resposta'] . "')";
            unset($_SESSION['resposta']);
        }
        ?>
    </script>
</body>

</html>