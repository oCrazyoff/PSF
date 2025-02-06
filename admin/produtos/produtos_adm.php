<?php
include("../../auth/config.php");
include("../../auth/valida.php");
include("../../database/utils/conexao.php");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos</title>
    <?php include("../../includes/link_head.php"); ?>
    <link rel="stylesheet" href="../../assets/css/table.css">
</head>

<body>
    <?php include("../../includes/header.php") ?>
    <?php include("../../includes/menu.php") ?>
    <?php include("../../includes/div_erro.php") ?>
    <div class="content">
        <table>
            <div class="titulo">
                <h1>Lista de Produtos</h1>
                <a href="cadastro_produto.php">Novo Produto <i class="fa-solid fa-circle-plus"></i></a>
            </div>
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
                    <th>Situação</th>
                    <th colspan="3">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM produtos ORDER BY status DESC";
                $resultado = $conn->query($sql);

                while ($row = $resultado->fetch_assoc()) {
                    $id = $row['id'];
                    $nome = htmlentities($row['nome']);
                    $codigo_barra = $row['codigo_barra'];
                    $fornecedor = $row['fornecedor'];
                    $marca = $row['marca'];
                    $grupo = $row['grupo'];
                    $subgrupo = $row['subgrupo'];
                    $preco_custo = $row['preco_custo'];
                    $preco_venda = $row['preco_venda'];
                    $quantidade = $row['quantidade'];
                    $lucro = $preco_venda - $preco_custo;
                    $status = $row['status'];

                    if ($row['validade'] != "0000-00-00") {
                        $validade = $row['validade'];
                        $validade = DateTime::createFromFormat('Y-m-d', $validade)->format('d/m/Y');
                    } else {
                        $validade = null;
                    }

                    $sqlGrupo = "SELECT nome FROM grupos WHERE id = '$grupo'";
                    $resultadoGrupo = $conn->query($sqlGrupo);
                    if ($rowGrupo = $resultadoGrupo->fetch_assoc()) {
                        $nomeGrupo = $rowGrupo['nome'];
                    } else {
                        $nomeGrupo = null;
                    }

                    $sqlSubgrupo = "SELECT nome FROM subgrupo WHERE id = '$subgrupo'";
                    $resultadoSubgrupo = $conn->query($sqlSubgrupo);
                    if ($rowSubgrupo = $resultadoSubgrupo->fetch_assoc()) {
                        $nomeSubgrupo = $rowSubgrupo['nome'];
                    } else {
                        $nomeSubgrupo = null;
                    }

                    $sqlMarca = "SELECT nome FROM marcas WHERE id = '$marca'";
                    $resultadoMarca = $conn->query($sqlMarca);
                    if ($rowMarca = $resultadoMarca->fetch_assoc()) {
                        $nomeMarca = $rowMarca['nome'];
                    } else {
                        $nomeMarca = null;
                    }

                    $sqlFornecedor = "SELECT razao_social FROM pessoas WHERE cnpj = (SELECT cnpj FROM fornecedores WHERE id = '$fornecedor')";
                    $resultadoFornecedor = $conn->query($sqlFornecedor);
                    if ($rowFornecedor = $resultadoFornecedor->fetch_assoc()) {
                        $nomeFornecedor = $rowFornecedor['razao_social'];
                    } else {
                        $nomeFornecedor = null;
                    }

                    echo "
                            <tr>
                                <td>" . $nome . "</td>
                                <td>" . ((empty($codigo_barra) ? "N/A" : $codigo_barra)) . "</td>
                                <td>" . (($nomeFornecedor == null) ? "N/A" : $nomeFornecedor) . "</td>
                                <td>" . (($nomeMarca == null) ? "N/A" : $nomeMarca) . "</td>
                                <td>" . (($nomeGrupo == null) ? "N/A" : $nomeGrupo)  . "</td>
                                <td>" . (($nomeSubgrupo == null) ? "N/A" : $nomeSubgrupo) . "</td>
                                <td>R$ " . number_format($preco_custo, 2, ',', '.') . "</td>
                                <td>R$ " . number_format($preco_venda, 2, ',', '.') . "</td>
                                <td>" . $quantidade . "</td>
                                <td>R$ " . number_format($lucro, 2, ',', '.') . "</td>
                                <td>" . (($validade == null) ? "N/A" : $validade) . "</td>
                                <td>" . ($status == 1 ? "Ativo" : "Inativo") . "</td>
                                <td>
                                    <form class='action' action='edita_produto.php' method='post'>
                                        <input type='hidden' name='id' value='$id'>
                                        <button type='submit'><i class='fa-solid fa-pen-to-square'></i></button>
                                    </form>
                                </td>
                                <td>
                                    <form class='action' action='../../database/produtos/deletar_produto.php' method='post'>
                                        <input type='hidden' name='id' value='$id'>
                                        <input type='hidden' name='status' value='$status'>
                                        <button type='submit'>" . (($status == 1) ? "<i class='fa-solid fa-trash-can'></i>" : "<i class='fa-solid fa-plus'></i>") . "</button>
                                    </form>
                                </td>
                                <td>
                                    <form class='action' action='../../database/produtos/deletar_produto.php' method='post' style='display:" . (($status == 1) ? "none" : "block") . "'>
                                        <input type='hidden' name='deletar' value='1'>
                                        <input type='hidden' name='id' value='$id'>
                                        <input type='hidden' name='status' value='$status'>
                                        <button type='submit'><i style='color:red'class='fa-solid fa-trash-can'></i></button>
                                    </form>
                                </td>
                            </tr>
                            ";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>