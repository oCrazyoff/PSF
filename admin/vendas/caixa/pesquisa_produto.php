<?php
include("../../../database/utils/conexao.php");

$produto = isset($_POST['produto']) ? $_POST['produto'] : '';

$sql = "SELECT id, nome, preco_venda, preco_custo FROM produtos WHERE nome LIKE '%$produto%' LIMIT 5";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='suggestion-item' data-id='" . $row['id'] . "' data-produto='" . $row['nome'] . "' data-preco-venda='" . $row['preco_venda'] . "' data-preco-custo='" . $row['preco_custo'] . "'>" . $row['nome'] . "</div>";
    }
} else {
    echo "<div class='suggestion-item'>Nenhum produto encontrado</div>";
}
