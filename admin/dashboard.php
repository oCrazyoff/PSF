<?php
include("../handler/utils/valida.php");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Início</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/menu.css">
    <!-- Link para Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* Estilo do Dashboard */
        .dashboard {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            padding: 20px;
        }

        .card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 30%;
            margin-bottom: 20px;
        }

        .card h3 {
            margin-bottom: 20px;
            color: #4e54c8;
        }

        /* Estilo do Gráfico */
        .chart-container {
            width: 100%;
            height: 400px;
        }
    </style>
</head>

<body>
    <?php include("../includes/header.php") ?>
    <div class="content">
        <?php include("../includes/menu.php") ?>

        <!-- Dashboard de Vendas -->
        <div class="dashboard">
            <!-- Cartões de Vendas -->
            <div class="card">
                <h3>Total de Vendas</h3>
                <p>R$ 20.000,00</p>
            </div>
            <div class="card">
                <h3>Vendas Hoje</h3>
                <p>R$ 2.500,00</p>
            </div>
            <div class="card">
                <h3>Novos Clientes</h3>
                <p>150 Clientes</p>
            </div>
        </div>

        <!-- Gráfico de Vendas -->
        <div class="chart-container">
            <canvas id="salesChart"></canvas>
        </div>
    </div>

    <script>
        // Dados fictícios do gráfico de vendas
        const ctx = document.getElementById('salesChart').getContext('2d');
        const salesChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
                datasets: [{
                    label: 'Vendas (R$)',
                    data: [1000, 2000, 1500, 2500, 3000, 3500, 4000, 4500, 5000, 5500, 6000, 7000],
                    borderColor: '#4e54c8',
                    backgroundColor: 'rgba(78, 84, 200, 0.1)',
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'R$ ' + value;
                            }
                        }
                    }
                }
            }
        });
    </script>
</body>

</html>