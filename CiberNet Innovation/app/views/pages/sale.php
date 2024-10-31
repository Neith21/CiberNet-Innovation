<?php include '../templates/header.php'; ?>

<?php
require_once __DIR__ . '/../../../app/controllers/SaleController.php';

$controller = new SaleController();
$products = $controller->index();
?>

<div class="container mt-4">
    <form method="POST" id="saleForm" action="saleSave.php">
        <div class="row">
            <!-- Datos del Cliente -->
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        Datos del Cliente
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="customerName">Cliente</label>
                            <input type="text" name="customerName" id="customerName" class="form-control" placeholder="Nombre del Cliente">
                        </div>
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
                        <input type="hidden" name="productID" id="productID" class="form-control">
                        <div class="form-group">
                            <label for="productName">Descripción</label>
                            <input type="text" name="productName" id="productName" class="form-control" placeholder="Producto" readonly>
                        </div>
                        <div class="form-group">
                            <label for="productPrice">Precio</label>
                            <input type="text" name="productPrice" id="productPrice" class="form-control" placeholder="00.0" readonly>
                        </div>
                        <div class="form-group">
                            <label for="saleDetailQty">Cantidad</label>
                            <input type="number" name="saleDetailQty" id="saleDetailQty" class="form-control" placeholder="0">
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
                        <table class="table table-bordered" id="detailsTable">
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
                            <button type="submit" class="btn btn-success" onclick="prepareSaleDetails()">Generar Venta</button>
                            <button type="button" class="btn btn-danger" onclick="clearAll()">Cancelar</button>
                            <h4 class="text-right">$ <span id="total">0.00</span></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    // Almacena los detalles de la venta
    let saleDetails = [];

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
        const table = document.querySelector("#detailsTable tbody");
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

        // Agregar el detalle al array
        saleDetails.push({
            productId,
            productName,
            productPrice,
            productQty,
            subtotal
        });

        // Limpiar los campos del producto
        clearProductFields();
    }

    function removeRow(button) {
        const row = button.parentNode.parentNode;
        const productId = row.cells[1].textContent; // Obtiene el ID del producto para remover del array

        // Eliminar el detalle del array
        saleDetails = saleDetails.filter(detail => detail.productId !== productId);

        row.parentNode.removeChild(row);
        updateTotal();
    }

    function updateTotal() {
        let total = 0;
        document.querySelectorAll("#detailsTable tbody tr").forEach(row => {
            const subtotal = parseFloat(row.cells[5].textContent);
            total += subtotal;
        });
        document.getElementById("total").textContent = total.toFixed(2);
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
            clearProductFields();
        }
    }

    function clearProductFields() {
        document.getElementById('productID').value = '';
        document.getElementById('productName').value = '';
        document.getElementById('productPrice').value = '';
        document.getElementById('saleDetailQty').value = '';
        document.getElementById('stock').value = '';
        document.getElementById('productSelect').selectedIndex = 0;
    }

    function clearAll() {
        document.getElementById('customerName').value = '';
        clearProductFields();
        document.querySelector("#detailsTable tbody").innerHTML = '';
        document.getElementById("total").textContent = "0.00";
        saleDetails = []; // Limpiar detalles de venta
    }

    function prepareSaleDetails() {
    const saleDetailsInput = document.createElement('input');
    saleDetailsInput.type = 'hidden';
    saleDetailsInput.name = 'saleDetails'; // Nombre del campo para recibir en PHP
    saleDetailsInput.value = JSON.stringify(saleDetails); // Convertir a JSON para enviarlo

    const totalInput = document.createElement('input');
    totalInput.type = 'hidden';
    totalInput.name = 'total'; // Agregar el total
    totalInput.value = document.getElementById("total").textContent; // Obtener el total mostrado en la interfaz

    document.getElementById('saleForm').appendChild(saleDetailsInput);
    document.getElementById('saleForm').appendChild(totalInput);
}

</script>

<?php include '../templates/footer.php'; ?>