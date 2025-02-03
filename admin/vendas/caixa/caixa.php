<?php
include("../../../auth/config.php");
include("../../../auth/valida.php");
include("../../../database/utils/conexao.php");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Caixa</title>
    <?php include("../../../includes/link_head.php") ?>
    <link rel="stylesheet" href="../../../assets/css/table.css?v=<?php echo time(); ?>">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .suggestions {
            border: 1px solid #ccc;
            max-height: 150px;
            overflow-y: auto;
        }

        .suggestion-item {
            padding: 10px;
            cursor: pointer;
        }

        .suggestion-item:hover {
            background-color: #f0f0f0;
        }
    </style>
</head>

<body>
    <?php include("../../../includes/header.php") ?>
    <?php include("../../../includes/menu.php") ?>
    <div class="content">
        <div class="input-compra">
            <input type="text" id="produto-input" placeholder="INSIRA O PRODUTO">
            <div id="sugestao" class="suggestions"></div>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Preço de Custo</th>
                    <th>Preço de Venda</th>
                    <th>Quantidade</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody id="product-table-body">
                <!-- Produtos selecionados serão adicionados aqui -->
            </tbody>
        </table>
    </div>
    <script>
        $(document).ready(function() {
            $('#produto-input').on('input', function() {
                var query = $(this).val();
                if (query.length > 0) {
                    $.ajax({
                        url: 'pesquisa.php',
                        method: 'POST',
                        data: {
                            produto: query
                        },
                        success: function(data) {
                            $('#sugestao').html(data);
                        }
                    });
                } else {
                    $('#sugestao').html('');
                }
            });

            $(document).on('click', '.suggestion-item', function() {
                var produto = $(this).data('produto');
                var precoVenda = $(this).data('preco-venda');
                var precoCusto = $(this).data('preco-custo');

                var newRow = `
                    <tr>
                        <td>${produto}</td>
                        <td>${precoCusto}</td>
                        <td>${precoVenda}</td>
                        <td><input type='number'></td>
                        <td><form action='#'><button type='submit'><i class='fa-solid fa-trash-can'></i></button></form></td>
                    </tr>
                `;
                $('#product-table-body').append(newRow);
                $('#produto-input').val('');
                $('#sugestao').html('');
            });
        });
    </script>
</body>

</html>