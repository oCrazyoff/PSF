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
    <link rel="stylesheet" href="../assets/css/table.css?v=<?php echo time(); ?>">
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
                    <?php
                    $sql = "SELECT * FROM produtos WHERE status = 1";
                    $resultado = $conn->query($sql);

                    while ($row = $resultado->fetch_assoc()) {
                        $nome = $row['nome'];
                        $codigo_barra = $row['codigo_barra'];
                        $fornecedor = $row['fornecedor'];
                        $marca = $row['marca'];
                        $grupo = $row['grupo'];
                        $preco_custo = $row['preco_custo'];
                        $preco_venda = $row['preco_venda'];
                        $quantidade = $row['quantidade'];
                        $lucro = $preco_venda - $preco_custo;
                        $validade = $row['validade'];
                        $status = $row['status'];
                        $validadeFormatada = DateTime::createFromFormat('Y-m-d', $validade)->format('d/m/Y');

                        echo "
                            <tr>
                                <td>" . $nome . "</td>
                                <td>" . $codigo_barra . "</td>
                                <td>" . $fornecedor . "</td>
                                <td>" . $marca . "</td>
                                <td>" . $grupo . "</td>
                                <td>R$ " . number_format($preco_custo, 2, ',', '.') . "</td>
                                <td>R$ " . number_format($preco_venda, 2, ',', '.') . "</td>
                                <td>" . $quantidade . "</td>
                                <td>R$ " . number_format($lucro, 2, ',', '.') . "</td>
                                <td>" . $validadeFormatada . "</td>
                                <td>" . ($status == 1 ? "Ativo" : "Inativo") . "</td>
                            </tr>
                                ";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>