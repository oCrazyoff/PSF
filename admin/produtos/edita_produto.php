<?php
include("../../auth/config.php");
include("../../auth/valida.php");
include("../../database/utils/conexao.php");

$id = $_POST['id'];
$sqlProduto = "SELECT * FROM produtos WHERE id = '$id'";
$resultadoProduto = $conn->query($sqlProduto);

while ($rowProduto = $resultadoProduto->fetch_assoc()) {
    $nome = $rowProduto['nome'];
    $codigo_barra = $rowProduto['codigo_barra'];
    $fornecedor = $rowProduto['fornecedor'];
    $marca = $rowProduto['marca'];
    $grupo = $rowProduto['grupo'];
    $subgrupo = $rowProduto['subgrupo'];
    $preco_custo = $rowProduto['preco_custo'];
    $preco_venda = $rowProduto['preco_venda'];
    $quantidade = $rowProduto['quantidade'];
    $validade = $rowProduto['validade'];
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
            <form action="../../database/produtos/editar_produto.php" method="post">
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-pen"></i></span>
                        <input type="text" class="form-control" value="<?php echo $nome ?>" name="nome" id="nome"
                            placeholder="Digite nome do produto" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="codigo">Código de Barras</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-barcode"></i></span>
                        <input type="text" class="form-control" value="<?php echo $codigo_barra ?>" name="codigo"
                            id="codigo" placeholder="Digite o Código de Barras">
                    </div>
                </div>
                <div class="form-group">
                    <label for="fornecedor">Fornecedores</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-truck"></i></span>
                        <select name="fornecedor" id="fornecedor">
                            <?php
                            $sqlFornecedores = "SELECT * FROM fornecedores WHERE status = 1";
                            $resultadoFornecedores = $conn->query($sqlFornecedores);
                            while ($rowFornecedores = $resultadoFornecedores->fetch_assoc()) {
                                $sqlPessoas = "SELECT nome_fantasia FROM pessoas WHERE cnpj = '" . $rowFornecedores['cnpj'] . "'";
                                $resultadoPessoas = $conn->query($sqlPessoas);
                                $nomeFornecedor = $resultadoPessoas->fetch_assoc();
                                echo "
                                <option value='" . $rowFornecedores['id'] . "' " . (($fornecedor == $rowFornecedores['id']) ? 'selected' : '') . ">" . $nomeFornecedor['nome_fantasia'] . "</option>
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
                        <select name="marca" id="marca">
                            <?php
                            $sqlMarca = "SELECT * FROM marcas WHERE status = 1";
                            $resultadoMarca = $conn->query($sqlMarca);
                            while ($rowMarca = $resultadoMarca->fetch_assoc()) {
                                echo "
                                <option value='" . $rowMarca['id'] . "' " . (($marca == $rowMarca['id']) ? 'selected' : '') . ">" . $rowMarca['nome'] . "</option>
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
                        <select name="grupo" id="grupo">
                            <?php
                            $sqlGrupo = "SELECT * FROM grupos WHERE status = 1";
                            $resultadoGrupo = $conn->query($sqlGrupo);
                            while ($rowGrupo = $resultadoGrupo->fetch_assoc()) {
                                echo "
                                <option value='" . $rowGrupo['id'] . "' " . (($grupo == $rowGrupo['id']) ? 'selected' : '') . ">" . $rowGrupo['nome'] . "</option>
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
                        <select name="subgrupo" id="subgrupo">
                            <?php
                            $sqlSubgrupo = "SELECT * FROM subgrupo WHERE status = 1";
                            $resultadoSubgrupo = $conn->query($sqlSubgrupo);
                            while ($rowSubgrupo = $resultadoSubgrupo->fetch_assoc()) {
                                echo "
                                <option value='" . $rowSubgrupo['id'] . "' " . (($subgrupo == $rowSubgrupo['id']) ? 'selected' : '') . ">" . $rowSubgrupo['nome'] . "</option>
                                ";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="preco_custo">Preço de Custo</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-money-bill"></i></span>
                        <input type="number" step="0.01" class="form-control" value="<?php echo $preco_custo ?>"
                            name="preco_custo" id="preco_custo" placeholder="Digite o Preço de Custo" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="preco_venda">Preço de Venda</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-hand-holding-dollar"></i></span>
                        <input type="number" step="0.01" class="form-control" value="<?php echo $preco_venda ?>"
                            name="preco_venda" id="preco_venda" placeholder="Digite o Preço de Venda" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="quantidade">Quantidade</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-list-ol"></i></span>
                        <input type="number" class="form-control" value="<?php echo $quantidade ?>" name="quantidade"
                            id="quantidade" placeholder="Digite a Quantidade" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="validade">Validade</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-calendar-check"></i></span>
                        <input type="date" class="form-control" value="<?php echo $validade ?>" name="validade"
                            id="validade" placeholder="Digite a Validade">
                    </div>
                </div>
                <input type="hidden" value="<?php echo $id ?>" name="id">
                <button type="submit" class="btn btn-primary btn-block mt-3">Editar</button>
            </form>
        </div>
    </div>

</body>

</html>