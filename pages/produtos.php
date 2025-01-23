<?php
include("../auth/config.php");
include("../database/utils/conexao.php");
include("../auth/valida.php");
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Produtos</title>
    <link rel="stylesheet" href="../assets/css/produtos.css">
    <?php include("../includes/link_head.php") ?>
</head>

<body>
    <?php include("../includes/header.php") ?>
    <?php include("../includes/menu.php") ?>
    <div class="content">
        <div class="catalog-container">
            <h1 class="catalog-title">Catálogo de Produtos</h1>
            <div class="product-list">
                <?php
                $sql = "SELECT g.nome AS grupo_nome, p.nome AS produto_nome, p.preco_venda, p.imagem 
                            FROM grupos g 
                            JOIN produtos p ON g.id = p.grupo 
                            WHERE p.status = 1";
                $resultado = $conn->query($sql);

                $grupos = [];
                while ($row = $resultado->fetch_assoc()) {
                    $grupos[$row['grupo_nome']][] = $row;
                }

                foreach ($grupos as $grupo_nome => $produtos) {
                ?>
                <div class="group-container">
                    <h2 class="group-title"><?php echo htmlspecialchars($grupo_nome); ?></h2>
                    <div class="group-products">
                        <?php foreach ($produtos as $produto) { ?>
                        <div class="product-item">
                            <img src="<?= ($produto['imagem'] == null ? "https://developers.elementor.com/docs/assets/img/elementor-placeholder-image.png" : htmlspecialchars($produto['imagem'])) ?>"
                                alt="Imagem do <?php echo htmlspecialchars($produto['produto_nome']); ?>"
                                class="product-image">
                            <h3 class="product-name"><?php echo htmlspecialchars($produto['produto_nome']); ?></h3>
                            <p class="product-price">
                                R$<?php echo htmlspecialchars(number_format($produto['preco_venda'], 2, ',', '.')); ?>
                            </p>
                            <button class="btn-add-cart">Comprar</button>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>