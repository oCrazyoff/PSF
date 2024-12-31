<?php
include("../auth/valida.php");
include("../database/utils/conexao.php");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos</title>
    <?php include("../includes/link_head.php")?>
    <link rel="stylesheet" href="../assets/css/table.css">
</head>

<body>
    <?php include("../includes/header.php") ?>
    <?php include("../includes/menu.php") ?>
    <div class="content">
        <table>
            <h1>Lista de Produtos</h1>
            <a href="cadastro_produto.php">Cadastrar Produto</a>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Codigo de Barras</th>
                    <th>Fornecedor</th>
                    <th>Marca</th>
                    <th>Grupo</th>
                    <th>Subgrupo</th>
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
                    $subgrupo = $row['subgrupo'];
                    $preco_custo = $row['preco_custo'];
                    $preco_venda = $row['preco_venda'];
                    $quantidade = $row['quantidade'];
                    $lucro = $preco_venda - $preco_custo;
                    $validade = $row['validade'];
                    $status = $row['status'];
                    $validadeFormatada = DateTime::createFromFormat('Y-m-d', $validade)->format('d/m/Y');

                    $sqlGrupo = "SELECT grupo FROM grupos WHERE id = '$grupo'";
                    $resultadoGrupo = $conn->query($sqlGrupo);

                    while ($rowGrupo = $resultadoGrupo->fetch_assoc()) {
                        $nomeGrupo = $rowGrupo['grupo'];
                    }

                    $sqlSubgrupo = "SELECT nome FROM subgrupo WHERE id = '$subgrupo'";
                    $resultadoSubgrupo = $conn->query($sqlSubgrupo);

                    while ($rowSubgrupo = $resultadoSubgrupo->fetch_assoc()) {
                        $nomeSubgrupo = $rowSubgrupo['nome'];
                    }

                    $sqlMarca = "SELECT nome FROM marcas WHERE id = '$marca'";
                    $resultadoMarca = $conn->query($sqlMarca);

                    while ($rowMarca = $resultadoMarca->fetch_assoc()) {
                        $nomeMarca = $rowMarca['nome'];
                    }

                    $sqlFornecedor = "SELECT razao_social FROM pessoas WHERE cnpj = (SELECT cnpj FROM fornecedores WHERE id = '$fornecedor')";
                    $resultadoFornecedor = $conn->query($sqlFornecedor);

                    while ($rowFornecedor = $resultadoFornecedor->fetch_assoc()) {
                        $nomeFornecedor = $rowFornecedor['razao_social'];
                    }

                    echo "
                            <tr>
                                <td>" . $nome . "</td>
                                <td>" . $codigo_barra . "</td>
                                <td>" . $nomeFornecedor . "</td>
                                <td>" . $nomeMarca . "</td>
                                <td>" . $nomeGrupo . "</td>
                                <td>" . $nomeSubgrupo . "</td>
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
</body>

</html>