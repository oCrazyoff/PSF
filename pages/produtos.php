<?php
include("../database/utils/conexao.php");
include("../auth/valida.php");
include("../auth/config.php");
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
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
                $sql = "SELECT * FROM produtos WHERE status = 1";
                $resultado = $conn->query($sql);

                while ($row = $resultado->fetch_assoc()) {
                ?>
                <div class="product-item">
                    <img src="https://developers.elementor.com/docs/assets/img/elementor-placeholder-image.png"
                        alt="Imagem do <?php echo htmlspecialchars($row['nome']); ?>" class="product-image">
                    <h2 class="product-name"><?php echo htmlspecialchars($row['nome']); ?></h2>
                    <p class="product-price">
                        R$<?php echo htmlspecialchars(number_format($row['preco_venda'], 2, ',', '.')); ?></p>
                    <button class="btn-add-cart">Comprar</button>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>