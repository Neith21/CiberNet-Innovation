<?php include '../templates/header.php'; ?>
<div class="container">
    <div class="card mt-5 p-4">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <h2>Comparador de ventas</h2>
    <label for="">Seleccione dos productos para comprara sus ventas en los últimos 3 meses.</label>
    <form method="post" action="?pages=chart&action=generateChart">
        <label for="product1">Producto 1:</label>
        <select name="product1" required>
            <?php foreach ($products as $product) { ?>
                <option value="<?= $product['ProductID'] ?>"><?= $product['productName'] ?></option>
            <?php } ?>
        </select>

        <label for="product2">Producto 2:</label>
        <select name="product2" required>
            <?php foreach ($products as $product) { ?>
                <option value="<?= $product['ProductID'] ?>"><?= $product['productName'] ?></option>
            <?php } ?>
        </select>

        <button type="submit">Generar Gráfico</button>
    </form>

    <?php if (isset($salesData) && count($salesData) > 0) { ?>
        <h3>Gráfico Comparativo</h3>
        <canvas id="salesChart"></canvas>
        <script>
            const ctx = document.getElementById('salesChart').getContext('2d');
            const salesChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: [<?= '"' . implode('","', array_column($salesData, 'productName')) . '"' ?>],
                    datasets: [{
                        label: 'Ventas en los últimos 3 meses',
                        data: [<?= implode(',', array_column($salesData, 'totalSales')) ?>],
                        backgroundColor: ['#36a2eb', '#ff6384'],
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
    <?php } ?>
    </div>
</div>
<?php include '../templates/footer.php'; ?>