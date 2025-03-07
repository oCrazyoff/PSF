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

        .suggestion-item,
        .suggestion-item-cliente {
            padding: 10px;
            cursor: pointer;
        }

        .suggestion-item:hover,
        .suggestion-item-cliente:hover {
            background-color: #f0f0f0;
        }

        .info-content {
            display: flex;
            justify-content: center;
            gap: 1em;
        }

        #produto-input {
            padding: 15px !important;
        }

        #produto-input,
        #cliente,
        #funcionario {
            width: -webkit-fill-available;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: .5em;
        }

        #produto-input:focus,
        #cliente:focus,
        #funcionario:focus,
        #product-table-body input[type="number"]:focus {
            outline: none;
            border-color: #3e44b1;
            box-shadow: 0 0 5px #3e44b1;
        }

        #sugestao,
        #sugestao-cliente {
            width: 100%;
            border: none;
            margin-bottom: .5em;
        }

        .tabela-venda {
            width: 80%;
        }

        .suggestion-item:first-child,
        .suggestion-item-cliente:first-child {
            border-top: 1px solid #ccc;
        }

        .suggestion-item,
        .suggestion-item-cliente {
            border-right: 1px solid #ccc;
            border-left: 1px solid #ccc;
        }

        .suggestion-item:last-child,
        .suggestion-item-cliente:last-child {
            border-bottom: 1px solid #ccc;
        }

        .info-venda {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            border-radius: .5em;
            box-shadow: rgba(9, 30, 66, 0.25) 0px 1px 1px, rgba(9, 30, 66, 0.13) 0px 0px 1px 1px;
            padding: 1em;
            width: 20%;
        }

        #funcionario {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: .5em;
            margin-bottom: .5em;
        }

        /* Estilo para o checkbox */
        .checkbox-container {
            display: flex;
            align-items: center;
            margin-top: 1em;
        }

        .checkbox-container input[type="checkbox"] {
            width: 20px;
            height: 20px;
            margin-right: 0.5em;
            accent-color: #3e44b1;
        }

        .checkbox-container label {
            font-size: 16px;
        }

        /* Estilo para os inputs de acréscimo e desconto */
        .input-group {
            display: flex;
            align-items: center;
            margin-top: 1em;
        }

        .input-group input[type="text"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: .5em;
            margin-right: 0.5em;
        }

        .input-group select {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: .5em;
        }

        .informacoes-gerais {
            margin-top: 1em;
            width: 100%;
            box-shadow: rgba(9, 30, 66, 0.25) 0px 1px 1px, rgba(9, 30, 66, 0.13) 0px 0px 1px 1px;
        }

        .info {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .info-total {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 20px;
            font-weight: 600;
        }

        .buttons {
            width: 100%;
            display: flex;
            justify-content: end;
            margin-top: 1em;
        }

        .buttons #enviar-venda {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: none;
            border-radius: .5em;
            background-color: #3e44b1;
            color: white;
            cursor: pointer;
        }

        /* Estilo para o input de quantidade */
        #product-table-body input[type="number"] {
            width: 60px;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: .5em;
            text-align: center;
        }

        #product-table-body input[type="number"]::-webkit-outer-spin-button,
        #product-table-body input[type="number"]::-webkit-inner-spin-button {
            width: 24px;
            /* Aumenta a largura dos botões */
            height: 24px;
            /* Aumenta a altura dos botões */
        }

        #product-table-body input[type="number"]::-moz-inner-spin-button {
            width: 24px;
            /* Aumenta a largura dos botões no Firefox */
            height: 24px;
            /* Aumenta a altura dos botões no Firefox */
        }

        .delete-btn {
            border: none;
            font-size: 20px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <?php include("../../../includes/header.php") ?>
    <?php include("../../../includes/menu.php") ?>
    <?php include("../../../includes/div_erro.php") ?>
    <div class="content">
        <div class="info-content">
            <div class="tabela-venda">
                <div class="input-compra">
                    <input type="text" id="produto-input" placeholder="INSIRA O PRODUTO">
                    <div id="sugestao" class="suggestions"></div>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Id</th>
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
            <div class="info-venda">
                <select name="funcionario" id="funcionario">
                    <option value="" disabled selected>Selecione o Vendedor</option>
                    <?php
                    $sqlFuncionario = "SELECT f.cpf, p.nome FROM funcionarios f INNER JOIN pessoas p ON f.cpf = p.cpf";
                    $resultadoFuncionario = $conn->query($sqlFuncionario);
                    while ($rowFuncionario = $resultadoFuncionario->fetch_assoc()) :
                    ?>
                        <option value="<?php echo $rowFuncionario['cpf'] ?>"
                            <?= ($rowFuncionario['cpf'] == $_SESSION['cpf'] ? 'selected' : '') ?>>
                            <?php echo $rowFuncionario['nome'] ?></option>
                    <?php endwhile; ?>
                </select>
                <div class="checkbox-container">
                    <input type="checkbox" name="cliente-cadastrado" id="cliente-cadastrado">
                    <label for="cliente-cadastrado">Cliente Cadastrado</label>
                </div>
                <div class="input-compra">
                    <input type="text" id="cliente" placeholder="CPF do Cliente">
                    <div id="sugestao-cliente" class="suggestions"></div>
                </div>
                <div class="input-group">
                    <input type="text" id="acrescimo" placeholder="Acréscimo">
                    <select id="acrescimo-tipo">
                        <option value="R$">R$</option>
                        <option value="%">%</option>
                    </select>
                </div>
                <div class="input-group">
                    <input type="text" id="desconto" placeholder="Desconto">
                    <select id="desconto-tipo">
                        <option value="R$">R$</option>
                        <option value="%">%</option>
                    </select>
                </div>
                <div class="informacoes-gerais">
                    <div class="info">
                        <p>
                        <div>Sub-Total:</div>
                        <div>R$ <span id="sub-total">0,00</span></div>
                        </p>
                    </div>
                    <div class="info">
                        <p>
                        <div>Desconto:</div>
                        <div>R$ <span id="desconto-valor">0,00</span></div>
                        </p>
                    </div>
                    <div class="info">
                        <p>
                        <div>Acréscimo:</div>
                        <div>R$ <span id="acrescimo-valor">0,00</span></div>
                        </p>
                    </div>
                    <hr>
                    <div class="info-total">
                        <p>
                        <div>Total:</div>
                        <div>R$ <span id="total">0,00</span></div>
                        </p>
                    </div>
                </div>
                <div class="buttons">
                    <button type="submit" id="enviar-venda">Enviar</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            function updateTotals() {
                let subTotal = 0;
                let desconto = parseFloat($('#desconto').val().replace(',', '.')) || 0;
                let acrescimo = parseFloat($('#acrescimo').val().replace(',', '.')) || 0;
                let descontoTipo = $('#desconto-tipo').val();
                let acrescimoTipo = $('#acrescimo-tipo').val();

                $('#product-table-body tr').each(function() {
                    let precoVenda = parseFloat($(this).find('td').eq(2).text().replace('R$ ', '').replace(
                        ',', '.'));
                    let quantidade = parseInt($(this).find('input').val());
                    subTotal += precoVenda * quantidade;
                });

                if (descontoTipo === '%') {
                    desconto = (subTotal * desconto) / 100;
                }

                if (acrescimoTipo === '%') {
                    acrescimo = (subTotal * acrescimo) / 100;
                }

                let total = subTotal - desconto + acrescimo;

                $('#sub-total').text(subTotal.toFixed(2).replace('.', ','));
                $('#desconto-valor').text(desconto.toFixed(2).replace('.', ','));
                $('#acrescimo-valor').text(acrescimo.toFixed(2).replace('.', ','));
                $('#total').text(total.toFixed(2).replace('.', ','));
            }

            $('#produto-input').on('input', function() {
                var query = $(this).val();
                if (query.length > 0) {
                    $.ajax({
                        url: 'pesquisa_produto.php',
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
                var id_produto = $(this).data('id');
                var produto = $(this).data('produto');
                var precoVenda = $(this).data('preco-venda').toString().replace('.', ',');
                var precoCusto = $(this).data('preco-custo').toString().replace('.', ',');

                var newRow = `
                    <tr>
                        <td>${id_produto}</td>
                        <td>${produto}</td>
                        <td>R$ ${precoCusto}</td>
                        <td>R$ ${precoVenda}</td>
                        <td><input type='number' value='1' class='quantidade'></td>
                        <td><button class='delete-btn'><i class='fa-solid fa-trash-can'></i></button></td>
                    </tr>
                `;
                $('#product-table-body').append(newRow);
                $('#produto-input').val('');
                $('#sugestao').html('');
                updateTotals();
            });

            $(document).on('click', '.delete-btn', function() {
                $(this).closest('tr').remove();
                updateTotals();
            });

            $(document).on('input', '.quantidade', function() {
                updateTotals();
            });

            $('#acrescimo, #desconto, #acrescimo-tipo, #desconto-tipo').on('input change', function() {
                updateTotals();
            });

            $('#cliente').on('input', function() {
                var query = $(this).val();
                if (query.length > 0) {
                    $.ajax({
                        url: 'pesquisa_cliente.php',
                        method: 'POST',
                        data: {
                            cliente: query
                        },
                        success: function(data) {
                            $('#sugestao-cliente').html(data);
                        }
                    });
                } else {
                    $('#sugestao-cliente').html('');
                }
            });

            $(document).on('click', '.suggestion-item-cliente', function() {
                var cliente = $(this).data('cliente');
                $('#cliente').val(cliente);
                $('#sugestao-cliente').html('');
            });
            $('#enviar-venda').on('click', function() {
                let total = $('#total').text().replace('R$ ', '').replace(',', '.');
                let funcionarioCpf = $('#funcionario').val();
                let clienteCpf = $('#cliente').val();

                // Criar um array para armazenar os produtos selecionados
                let produtos = [];

                $('#product-table-body tr').each(function() {
                    let id_produto = $(this).find('td').eq(0).text();
                    let produto = $(this).find('td').eq(1).text(); // Nome do produto
                    let precoCusto = $(this).find('td').eq(2).text().replace('R$ ', '').replace(',', '.');
                    let precoVenda = $(this).find('td').eq(3).text().replace('R$ ', '').replace(',', '.');
                    let quantidade = $(this).find('.quantidade').val();

                    produtos.push({
                        id: id_produto,
                        produto: produto,
                        precoCusto: precoCusto,
                        precoVenda: precoVenda,
                        quantidade: quantidade
                    });
                });

                console.log("Produtos:", produtos); // Verificar se os dados estão corretos no console

                $.ajax({
                    url: '../../../database/vendas/cadastrar_transacao.php',
                    method: 'POST',
                    data: {
                        total: total,
                        clienteCpf: clienteCpf,
                        funcionarioCpf: funcionarioCpf,
                        produtos: JSON.stringify(produtos) // Enviar os produtos como JSON
                    },
                    success: function(response) {
                        alert("Venda cadastrada com sucesso!");
                    },
                    error: function() {
                        alert("Erro ao cadastrar venda!");
                    }
                });
            });

        });
    </script>
</body>

</html>