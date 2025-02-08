<?php
include("../../../database/utils/conexao.php");

$cliente = isset($_POST['cliente']) ? $_POST['cliente'] : '';

$sql_cliente = "SELECT id, cpf, nome FROM pessoas WHERE cpf LIKE '%$cliente%' LIMIT 5";

$result_cliente = $conn->query($sql_cliente);

if ($result_cliente->num_rows > 0) {
    while ($row = $result_cliente->fetch_assoc()) {
        echo "<div class='suggestion-item-cliente' data-cliente='" . $row['cpf'] . "'>" . $row['cpf'] . " - " . $row['nome'] . "</div>";
    }
} else {
    echo "<div class='suggestion-item-cliente'>Nenhum cliente encontrado</div>";
}
