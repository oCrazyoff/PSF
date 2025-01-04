<?php
include("../../auth/valida.php");
include("../../auth/config.php");
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Produto</title>
    <?php include("../../includes/link_head.php") ?>
    <link rel="stylesheet" href="../../assets/css/form.css?v=<?php echo time(); ?>">
</head>

<body>
    <?php include("../../includes/header.php") ?>
    <?php include("../../includes/menu.php") ?>
    <div class="content">
        <div class="form-container">
            <form id="large-form" action="../../database/produtos/cadastrar_produto.php" method="post">
                <h2 class="form-title">Cadastrar Produto</h2>
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-pen"></i></span>
                        <input type="text" class="form-control" name="nome" id="nome"
                            placeholder="Digite nome do produto" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="codigo">Código de Barras</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-barcode"></i></span>
                        <input type="text" class="form-control" name="codigo" id="codigo"
                            placeholder="Digite o Código de Barras" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="fornecedor">Fornecedores</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-truck"></i></span>
                        <input type="text" class="form-control" name="fornecedor" id="fornecedor"
                            placeholder="Digite nome do Fornecedor" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="marca">Marca</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-tags"></i></span>
                        <input type="text" class="form-control" name="marca" id="marca"
                            placeholder="Digite o nome da Marca" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="grupo">Grupo</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-boxes-stacked"></i></span>
                        <input type="text" class="form-control" name="grupo" id="grupo"
                            placeholder="Digite nome do Grupo" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="grupo">Sub Grupo</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-dolly"></i></span>
                        <input type="text" class="form-control" name="sub_grupo" id="sub_grupo"
                            placeholder="Digite nome do Sub Grupo" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="preco_custo">Preço de Custo</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-money-bill"></i></span>
                        <input type="text" class="form-control" name="preco_custo" id="preco_custo"
                            placeholder="Digite o Preço de Custo" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="preco_venda">Preço de Venda</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-hand-holding-dollar"></i></span>
                        <input type="text" class="form-control" name="preco_venda" id="preco_venda"
                            placeholder="Digite o Preço de Venda" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="quantidade">Quantidade</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-list-ol"></i></span>
                        <input type="number" class="form-control" name="quantidade" id="quantidade"
                            placeholder="Digite a Quantidade" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="validade">Validade</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-calendar-check"></i></span>
                        <input type="date" class="form-control" name="validade" id="validade"
                            placeholder="Digite a Validade" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-block mt-3">Cadastrar</button>
            </form>
        </div>
    </div>

</body>

</html>