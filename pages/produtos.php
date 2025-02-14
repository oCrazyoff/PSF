<?php
include("../auth/config.php");
include("../database/utils/conexao.php");
session_start();
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
    <?php include("../includes/header.php");?>
    <?php 
    if (isset($_SESSION['nome'])){
        include("../includes/menu.php"); 
    } ?>
    <div class="content">
        <div class="catalog-container">
            <h1 class="catalog-title">Catálogo de Produtos</h1>
            <div class="product-list">
                <?php
                $sql_grupos = "SELECT id, nome FROM grupos";
                $resultado_grupos = $conn->query($sql_grupos);
                $produtos_encontrados = false;

                if ($resultado_grupos->num_rows > 0) {
                    while ($grupo = $resultado_grupos->fetch_assoc()) {
                        $sql_produtos = "SELECT nome, preco_venda, imagem 
                                         FROM produtos 
                                         WHERE grupo = ? AND status = 1";
                        $stmt = $conn->prepare($sql_produtos);
                        $stmt->bind_param("i", $grupo['id']);
                        $stmt->execute();
                        $resultado_produtos = $stmt->get_result();

                        if ($resultado_produtos->num_rows > 0) {
                            $produtos_encontrados = true;
                            ?>
                            <div class="group-container">
                                <h2 class="group-title"><?= htmlspecialchars($grupo['nome']); ?></h2>
                                <div class="group-products">
                                    <?php
                                    while ($produto = $resultado_produtos->fetch_assoc()) {
                                    ?>
                                        <div class="product-item">
                                            <img src="<?= ($produto['imagem'] == null ? "https://developers.elementor.com/docs/assets/img/elementor-placeholder-image.png" : 'data:image/jpeg;base64,' . base64_encode($produto['imagem'])) ?>"
                                                alt="Imagem do <?= htmlspecialchars($produto['nome']); ?>"
                                                class="product-image">
                                            <h3 class="product-name"><?= htmlspecialchars($produto['nome']); ?></h3>
                                            <p class="product-price">
                                                R$<?= htmlspecialchars(number_format($produto['preco_venda'], 2, ',', '.')); ?>
                                            </p>
                                            <button class="btn-add-cart">Comprar</button>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <?php
                        }
                    }
                }

                if (!$produtos_encontrados) {
                    echo "<p class='error-message'>Nenhum produto encontrado!</p>";
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>