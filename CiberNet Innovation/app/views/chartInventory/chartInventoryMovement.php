<?php include '../templates/header.php'; ?>

<div class="container">
    <div class="card mt-5 p-4">
        <h2>Gráfico de Inventario</h2>
        <label for="">Seleccione un rango de fechas para visualizar los movimientos de inventario.</label>
        <form id="chartForm" action="" method="POST" class="bg-light p-4">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="start_date" class="form-label">Inicio del Rango:</label>
                    <input type="date" id="start_date" name="start_date" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label for="end_date" class="form-label">Fin del Rango:</label>
                    <input type="date" id="end_date" name="end_date" class="form-control" required>
                </div>
            </div>
            <div class="text-center">
                <br>
                <button type="button" id="drawGraphic" class="btn btn-primary">Generar Gráfico</button>
            </div>
        </form>

        <div id="error-message" class="p-4" style="display: none;"></div>
        <canvas id="inventoryChart" style="display: none;"></canvas>

        <div id="buttonsDownloads" style="margin-top: 10px; text-align: center; display: none;">
            <button class="btn btn-success" onclick="downloadImage('png')">Descargar PNG</button>
            <button class="btn btn-success" onclick="downloadImage('jpeg')">Descargar JPEG</button>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
<script>
    $(document).ready(function() {
        let inventoryChart;

        $('#drawGraphic').on('click', function() {
            var startDate = $('#start_date').val();
            var endDate = $('#end_date').val();

            if (startDate && endDate) {
                $('#error-message').hide();
                $('#inventoryChart').show();

                $.ajax({
                    url: 'chartInventory.php',
                    type: 'POST',
                    data: {
                        action: 'generateInventoryChart',
                        start_date: startDate,
                        end_date: endDate
                    },
                    success: function(response) {
                        console.log(response);

                        if (inventoryChart) {
                            inventoryChart.destroy();
                        }

                        const ctx = document.getElementById('inventoryChart').getContext('2d');
                        $('#inventoryChart').attr('width', '800');
                        $('#inventoryChart').attr('height', '400');

                        inventoryChart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: response.productNames,
                                datasets: [{
                                    label: 'Movimientos de Inventario',
                                    data: response.netInventoryMovements,
                                    backgroundColor: response.netInventoryMovements.map(() => 
                                        '#' + Math.floor(Math.random()*16777215).toString(16)
                                    ),
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                responsive: true,
                                plugins: {
                                    title: {
                                        display: true,
                                        text: 'Movimientos de Inventario',
                                        font: {
                                            size: 16
                                        }
                                    },
                                    tooltip: {
                                        callbacks: {
                                            label: function(context) {
                                                return `Movimiento: ${context.parsed.y}`;
                                            }
                                        }
                                    }
                                },
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        title: {
                                            display: true,
                                            text: 'Total de Movimientos'
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

                        $('#buttonsDownloads').show();
                    },
                    error: function(xhr, status, error) {
                        console.error("Error al actualizar gráfico:", error);
                        $('#error-message').text('Error al cargar el gráfico. Por favor, vuelva a intentarlo.').show();
                    }
                });
            } else {
                $('#error-message').text('Seleccione un rango de fechas.').show();
            }
        });
    });

    function downloadImage(type) {
        const canvas = document.getElementById('inventoryChart');
        const ctx = canvas.getContext('2d');

        ctx.save();
        ctx.globalCompositeOperation = 'destination-over';
        ctx.fillStyle = '#FFFFFF';
        ctx.fillRect(0, 0, canvas.width, canvas.height);

        if (type === 'png') {
            canvas.toBlob(function(blob) {
                saveAs(blob, "ReporteMovimientosInventario.png");
            });
        } else if (type === 'jpeg') {
            canvas.toBlob(function(blob) {
                saveAs(blob, "ReporteMovimientosInventario.jpg");
            }, 'image/jpeg');
        }

        ctx.restore();
    }
</script>


<?php include '../templates/footer.php'; ?>
