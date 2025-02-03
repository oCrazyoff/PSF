<?php
include("../../../auth/config.php");
include("../../../auth/valida.php");
include("../../../database/utils/conexao.php");

$sql = "SELECT t.id, p.nome AS pessoa, v.nome AS vendedor, t.tipo, t.preco_total, t.data_transacao, t.status 
        FROM transacoes t
        JOIN pessoas p ON t.pessoa_id = p.id
        JOIN pessoas v ON t.vendedor_id = v.id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transações</title>
    <?php include("../../../includes/link_head.php") ?>
    <link rel="stylesheet" href="../../../assets/css/table.css?v=<?php echo time(); ?>">
</head>

<body>
    <?php include("../../../includes/header.php") ?>
    <?php include("../../../includes/menu.php") ?>
    <div class="content">
        <div class="titulo">
            <h1>Transações</h1>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Pessoa</th>
                    <th>Vendedor</th>
                    <th>Tipo</th>
                    <th>Preço Total</th>
                    <th>Data da Transação</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["pessoa"] . "</td>";
                        echo "<td>" . $row["vendedor"] . "</td>";
                        echo "<td>" . ($row["tipo"] == 0 ? "Compra" : "Venda") . "</td>";
                        echo "<td>" . $row["preco_total"] . "</td>";
                        echo "<td>" . $row["data_transacao"] . "</td>";
                        echo "<td>" . ($row["status"] == 0 ? "Pendente" : ($row["status"] == 1 ? "Completa" : "Cancelada")) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>Nenhuma transação encontrada</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>