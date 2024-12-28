<?php
include("../database/utils/valida.php");
include("../database/utils/conexao.php");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos</title>
    <?php include("../includes/link_head.php") ?>
    <link rel="stylesheet" href="../assets/css/table.css">
</head>

<body>
    <?php include("../includes/header.php") ?>
    <div class="content">
        <?php include("../includes/menu.php") ?>
        <div class="container">
            <table>
                <h1>Lista de Produtos</h1>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Codigo de Barras</th>
                        <th>Fornecedor</th>
                        <th>Marca</th>
                        <th>Grupo</th>
                        <th>Preço de Custo</th>
                        <th>Preço de Venda</th>
                        <th>Quantidade</th>
                        <th>Lucro</th>
                        <th>Validade</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php
                        $sql = "SELECT * FROM produtos";
                        $resultado = $conn->query($sql);

                        while ($row = $resultado->fetch_assoc()) {
                            echo "
                                <td>" . $row['nome'] . "</td>
                                <td>" . $row['codigo_barra'] . "</td>
                                <td>" . $row['fornecedor'] . "</td>
                                <td>" . $row['marca'] . "</td>
                                <td>" . $row['grupo'] . "</td>
                                <td>" . $row['preco_custo'] . "</td>
                                <td>" . $row['preco_venda'] . "</td>
                                <td>" . $row['quantidade'] . "</td>
                                <td>" . $row['lucro'] . "</td>
                                <td>" . $row['validade'] . "</td>
                                <td>" . $row['status'] . "</td>
                                ";
                        }
                        ?>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>