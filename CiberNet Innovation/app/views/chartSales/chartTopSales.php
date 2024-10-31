<?php include '../templates/header.php'; ?>

<style>
    .date-range-container {
        margin-bottom: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .date-input {
        margin: 0 10px;
    }

    label {
        margin-right: 5px;
    }

    #drawGraphic {
        margin-top: 10px;
    }

    .full-height {
        height: 100vh;
        /* Altura de la pantalla completa */
        display: flex;
        /* Usar Flexbox */
        align-items: center;
        /* Centrar verticalmente */
        justify-content: center;
        /* Centrar horizontalmente */
    }

    .danger {
        background-color: #FF4D4D;
    }

    #container {
        display: none; /* Inicialmente oculto */
    }

    #error-message {
        background-color: #f8d7da; /* Color de fondo rojo claro */
        color: #721c24; /* Color de texto rojo oscuro */
        border: 1px solid #f5c6cb; /* Borde color rojo claro */
        padding: 10px; /* Espaciado interno */
        margin-top: 10px; /* Espacio superior */
        border-radius: 15px; /* Bordes redondeados */
        text-align: center; /* Centrar texto */
        font-weight: bold; /* Negrita */
    }

    figure.highcharts-figure {
        margin: 20px 0; /* Margen superior e inferior */
    }

    .form {
        background-color: #ffffff; /* Fondo blanco para el formulario */
        border-radius: 10px; /* Bordes redondeados */
        padding: 20px; /* Espaciado interno */
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Sombra suave */
    }

    h2 {
        color: #333; /* Color del título */
    }

    .btn-primary {
        background-color: #007bff; /* Color primario más suave */
        border-color: #007bff; /* Borde del botón */
    }

    .btn-primary:hover {
        background-color: #0056b3; /* Color al pasar el mouse */
    }

    .btn-success {
        background-color: #28a745; /* Color de éxito */
        border-color: #28a745; /* Borde del botón */
    }

    .btn-success:hover {
        background-color: #218838; /* Color al pasar el mouse */
    }

</style>

    <div class="full-height">
        <center>
            <div class="container-fluid rounded shadow p-4 form">
                <figure class="highcharts-figure">
                    <div id="error-message" class="p-4" style="display: none;"></div>
                    <canvas id="container"></canvas>
                </figure>

                <form id="chartForm" action="" method="POST" class="bg-light p-4">
                    <h2 class="text-center mb-4">Generar Reporte</h2>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="startDate" class="form-label">Inicio del Reporte:</label>
                            <input type="date" id="startDate" name="startDate" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="endDate" class="form-label">Final del Reporte:</label>
                            <input type="date" id="endDate" name="endDate" class="form-control" required>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="button" id="drawGraphic" class="btn btn-primary">Generar Grafico</button>
                    </div>
                </form>

                <!-- Agregamos botones de exportación -->
                <div id="buttonsDownloads" style="margin-top: 10px; text-align: center; display: none;">
                    <button class="btn btn-success" onclick="downloadImage('png')">Descargar PNG</button>
                    <button class="btn btn-success" onclick="downloadImage('jpeg')">Descargar JPEG</button>
                </div>
            </div>
        </center>
    </div>

    <!-- Cambiamos los scripts de Highcharts por Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    
    <script>
        $(document).ready(function() {
            let myChart; // Variable para almacenar la instancia del gráfico

            $('#drawGraphic').on('click', function() {
                var startDate = $('#startDate').val();
                var endDate = $('#endDate').val();

                if (startDate && endDate) {
                    // Oculta el mensaje de error si se está mostrando
                    $('#error-message').hide();

                    $.ajax({
                        url: 'chartSales.php',
                        type: 'POST',
                        data: {
                            action: 'generateChart',
                            start_date: startDate,
                            end_date: endDate
                        },
                        success: function(response) {
                            console.log(response); 

                            // Si ya existe un gráfico, destrúyelo
                            if (myChart) {
                                myChart.destroy();
                            }
                            
                            const ctx = document.getElementById('container').getContext('2d');

                            // Asignar tamaño dinámico al canvas antes de generar el gráfico
                            $('#container').attr('width', '800');  // Ajusta el ancho deseado
                            $('#container').attr('height', '400'); // Ajusta el alto deseado
                            document.getElementById('buttonsDownloads').style.display = 'block';

                            myChart = new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    labels: response.categories,
                                    datasets: [{
                                        label: 'Ventas',
                                        data: response.data,
                                        backgroundColor: response.data.map(() => 
                                            '#' + Math.floor(Math.random()*16777215).toString(16)
                                        ),
                                        borderWidth: 0
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    maintainAspectRatio: false,
                                    plugins: {
                                        title: {
                                            display: true,
                                            text: 'Reporte de los 10 Productos mas Vendidos',
                                            font: {
                                                size: 16
                                            }
                                        },
                                        subtitle: {
                                            display: true,
                                            text: 'Rango de Fecha: ' + startDate + ' a ' + endDate,
                                            align: 'start',
                                            padding: {
                                                bottom: 15
                                            }
                                        },
                                        legend: {
                                            display: false
                                        },
                                        tooltip: {
                                            callbacks: {
                                                label: function(context) {
                                                    return `Total de Ventas: ${context.parsed.y}`;
                                                }
                                            }
                                        }
                                    },
                                    scales: {
                                        y: {
                                            beginAtZero: true,
                                            title: {
                                                display: true,
                                                text: 'Total de Ventas'
                                            },
                                            ticks: {
                                                stepSize: 2
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
                        },
                        error: function(xhr, status, error) {
                            console.error("Error al Actualizar Grafico:", error);
                            $('#error-message').text('Error al cargar el gráfico. Por favor, vuelva a intentarlo.').show();
                        }
                    });
                } else {
                    $('#error-message').text('Seleccione un Rango de Fechas.').show();
                }

            });
        });

        // Funciones de exportación
        function downloadImage(type) {
            const canvas = document.getElementById('container');
            const ctx = canvas.getContext('2d');

            // Guarda el estado del canvas antes de agregar el fondo blanco
            ctx.save();
            
            // Añade fondo blanco temporal
            ctx.globalCompositeOperation = 'destination-over';
            ctx.fillStyle = '#FFFFFF';
            ctx.fillRect(0, 0, canvas.width, canvas.height);


            if (type === 'png') {
                canvas.toBlob(function(blob) {
                    saveAs(blob, "ReporteTop10MasVendidos.png");
                });
            } else if (type === 'jpeg') {
                canvas.toBlob(function(blob) {
                    saveAs(blob, "ReporteTop10MasVendidos.jpg");
                }, 'image/jpeg');
            }
        }
    </script>


<?php include '../templates/footer.php'; ?>