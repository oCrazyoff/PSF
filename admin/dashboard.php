<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard de Vendas</title>
    <link rel="stylesheet" href="../assets/css/dashboard.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div class="dashboard-container">
        <header>
            <h1 class="form-title">Dashboard de Vendas</h1>
        </header>
        <div class="cards">
            <div class="card">
                <h2>Lucro</h2>
                <p class="value">R$ 50.000</p>
            </div>
            <div class="card">
                <h2>Vendas</h2>
                <p class="value">2.500</p>
            </div>
            <div class="card">
                <h2>Clientes</h2>
                <p class="value">1.200</p>
            </div>
        </div>
        <div class="chart-container">
            <canvas id="salesChart"></canvas>
        </div>
    </div>

    <script>
        var ctx = document.getElementById('salesChart').getContext('2d');
        var salesChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun'],
                datasets: [{
                    label: 'Vendas Mensais',
                    data: [500, 700, 800, 900, 650, 950],
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>

</html>