<?php include '../templates/header.php'; ?>

<div class="container">
    <div class="card mt-5 p-4">
        <h2>Comparador de ventas</h2>
        <label for="">Seleccione dos productos para comparar sus ventas en los últimos 3 meses.</label>
        <form id="salesChartForm" method="post" action="?pages=chart&action=generateChart" class="bg-light p-4">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="product1" class="form-label">Producto 1:</label>
                    <select id="product1" name="product1" class="form-control" required>
                        <?php foreach ($products as $product) { ?>
                            <option value="<?= $product['ProductID'] ?>"><?= $product['productName'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="product2" class="form-label">Producto 2:</label>
                    <select id="product2" name="product2" class="form-control" required>
                        <?php foreach ($products as $product) { ?>
                            <option value="<?= $product['ProductID'] ?>"><?= $product['productName'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="text-center">
                <br>
                <button type="submit" class="btn btn-primary">Generar Gráfico</button>
            </div>
        </form>

        <?php if (isset($salesData) && count($salesData) > 0) { ?>
            <h3>Gráfico Comparativo</h3>
            <canvas id="salesChart" style="display: block; width: 800px; height: 400px;"></canvas>

            <div id="buttonsDownloads" style="margin-top: 10px; text-align: center;">
                <button class="btn btn-success" onclick="downloadImage('png')">Descargar PNG</button>
                <button class="btn btn-success" onclick="downloadPDF()">Descargar PDF</button>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
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
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Total de Ventas'
                                }
                            },
                            x: {
                                title: {
                                    display: true,
                                    text: 'Producto'
                                }
                            }
                        }
                    }
                });

                function downloadImage(type) {
                    const canvas = document.getElementById('salesChart');
                    canvas.toBlob(function(blob) {
                        saveAs(blob, `ComparadorVentas.${type}`);
                    });
                }

                function downloadPDF() {
                    const { jsPDF } = window.jspdf;
                    const canvas = document.getElementById('salesChart');
                    const pdf = new jsPDF();
                    pdf.text(10, 10, "Comparador de Ventas - Últimos 3 Meses");
                    pdf.addImage(canvas, 'PNG', 15, 20, 180, 100);
                    pdf.save("ComparadorVentas.pdf");
                }
            </script>
        <?php } ?>
    </div>
</div>

<?php include '../templates/footer.php'; ?>
