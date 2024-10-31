<?php include '../templates/header.php'; ?>

<div class="container mt-4">
    <div class="row">
        <!-- Datos del Cliente -->
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    Datos del Cliente
                </div>
                <div class="card-body">
                    <form>
                        <div class="form-group">
                            <label for="customerName">Cliente</label>
                            <input type="text" id="customerName" class="form-control" placeholder="Nombre del Cliente">
                        </div>
                    </form>
                </div>
            </div>

            <!-- Datos del Producto -->
            <div class="card mt-3">
                <div class="card-header">
                    Datos Producto
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="productSelect">Producto</label>
                        <select id="productSelect" class="form-control" onchange="loadProductData()">
                            <option value="">Selecciona un producto</option>
                            <?php foreach ($products as $product) : ?>
                                <option value="<?php echo htmlspecialchars(json_encode([$product['ProductID'], $product['productPrice'], $product['stock']])); ?>">
                                    <?php echo $product['productName']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <input type="hidden" id="productID" class="form-control">
                    <div class="form-group">
                        <label for="productName">Descripción</label>
                        <input type="text" id="productName" class="form-control" placeholder="Producto" readonly>
                    </div>
                    <div class="form-group">
                        <label for="productPrice">Precio</label>
                        <input type="text" id="productPrice" class="form-control" placeholder="00.0" readonly>
                    </div>
                    <div class="form-group">
                        <label for="productStock">Cantidad</label>
                        <input type="number" id="saleDetailQty" class="form-control" placeholder="0">
                    </div>
                    <div class="form-group">
                        <label for="productStock">Stock</label>
                        <input type="number" id="stock" class="form-control" placeholder="0" readonly>
                    </div>
                    <button type="button" class="btn btn-primary" onclick="addProductToTable()">Agregar Producto</button>
                </div>
            </div>
        </div>

        <!-- Detalles de la Venta -->
        <div class="col-md-7">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nro</th>
                                <th>Código</th>
                                <th>Descripción</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>SubTotal</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Aquí se agregarán las filas dinámicamente -->
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-between">
                        <button class="btn btn-success" onclick="generateSale()">Generar Venta</button>
                        <button class="btn btn-danger" onclick="clearAll()">Cancelar</button>
                        <h4 class="text-right">$ <span id="total">0.00</span></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function addProductToTable() {
        const productId = document.getElementById('productID').value;
        const productName = document.getElementById('productName').value;
        const productPrice = parseFloat(document.getElementById('productPrice').value);
        const productQty = parseInt(document.getElementById('saleDetailQty').value);
        const stock = parseInt(document.getElementById('stock').value);

        // Verificar que la cantidad no sea mayor al stock disponible
        if (productQty > stock) {
            alert(`La cantidad ingresada (${productQty}) supera el stock disponible (${stock}).`);
            return;
        }

        if (!productId || !productName || !productPrice || productQty <= 0) {
            alert('Por favor, completa los datos del producto y asegúrate de que la cantidad sea mayor que 0.');
            return;
        }

        const subtotal = productPrice * productQty;
        const table = document.querySelector("table tbody");
        const row = document.createElement("tr");

        row.innerHTML = `
        <td>${table.querySelectorAll("tr").length + 1}</td>
        <td>${productId}</td>
        <td>${productName}</td>
        <td>${productPrice.toFixed(2)}</td>
        <td>${productQty}</td>
        <td>${subtotal.toFixed(2)}</td>
        <td><button class="btn btn-danger" onclick="removeRow(this)">Eliminar</button></td>
    `;

        table.appendChild(row);
        updateTotal();
    }


    function removeRow(button) {
        const row = button.parentNode.parentNode;
        row.parentNode.removeChild(row);
        updateTotal();
    }

    function updateTotal() {
        let total = 0;
        document.querySelectorAll("table tbody tr").forEach(row => {
            const subtotal = parseFloat(row.cells[5].textContent);
            total += subtotal;
        });
        document.getElementById("total").textContent = total.toFixed(2);
    }

    function generateSale() {
        const saleDetails = [];
        const tableRows = document.querySelectorAll("table tbody tr");

        if (tableRows.length === 0) {
            alert("No hay productos en la venta. Agrega al menos un producto para proceder.");
            return;
        }

        // Recopilar los detalles de cada producto en la tabla
        tableRows.forEach(row => {
            const productId = row.cells[1].textContent;
            const qty = row.cells[4].textContent;
            const unitPrice = row.cells[3].textContent;

            saleDetails.push({
                productId,
                qty,
                unitPrice
            });
        });

        // Recopilar los datos de venta y hacer la solicitud al servidor
        fetch('saleSave.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    customerName: document.getElementById('customerName').value,
                    saleTotal: document.getElementById('total').textContent,
                    saleDetails: saleDetails
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Venta generada exitosamente');
                    clearAll(); // Limpia los campos después de la venta
                    location.reload();
                } else {
                    alert(data.message || 'Error al generar la venta');
                }
            })
            .catch(error => console.error('Error:', error));
    }


    function loadProductData() {
        const select = document.getElementById('productSelect');
        const selectedOption = select.options[select.selectedIndex].value;

        if (selectedOption) {
            const [productId, productPrice, stock] = JSON.parse(selectedOption);

            document.getElementById('productID').value = productId;
            document.getElementById('productName').value = select.options[select.selectedIndex].text;
            document.getElementById('productPrice').value = productPrice;
            document.getElementById('stock').value = stock;
        } else {
            document.getElementById('productID').value = '';
            document.getElementById('productName').value = '';
            document.getElementById('productPrice').value = '';
            document.getElementById('stock').value = '';
        }
    }

    function clearAll() {
        document.getElementById('customerName').value = '';
        document.getElementById('productID').value = '';
        document.getElementById('productName').value = '';
        document.getElementById('productPrice').value = '';
        document.getElementById('saleDetailQty').value = '';
        document.getElementById('stock').value = '';
        document.getElementById('productSelect').selectedIndex = 0;
        document.querySelector("table tbody").innerHTML = '';
        document.getElementById("total").textContent = "0.00";
    }
</script>

<?php include '../templates/footer.php'; ?>