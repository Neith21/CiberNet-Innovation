<?php include '../templates/header.php'; ?>

<?php
require_once __DIR__ . '/../../../app/controllers/SaleController.php';

$controller = new SaleController();
$products = $controller->getProducts();
?>

<div class="container mt-4">
    <form method="POST" id="saleForm" action="saleSave.php" onsubmit="return validateSale()">
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
                            <input type="text" id="productSelect" class="form-control" placeholder="Escribe para buscar..." onfocus="showProductList()" oninput="filterProducts()">
                            <div id="productList" class="list-group"></div>
                        </div>
                        <input type="hidden" name="productID" id="productID">
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
                            <input type="number" name="saleDetailQty" id="saleDetailQty" class="form-control" placeholder="0" value="1">
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
                            <button type="submit" class="btn btn-success">Generar Venta</button>
                            <button type="button" class="btn btn-danger" onclick="clearAll()">Cancelar</button>
                            <input type="hidden" name="total" id="totalHidden">
                            <input type="hidden" name="saleDetails" id="saleDetailsHidden">
                            <h4 class="text-right">$ <span id="total">0.00</span></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    let saleDetails = [];
    let products = <?php echo json_encode($products); ?>; // Lista de productos para autocompletar

    function addProductToTable() {
        const productId = document.getElementById('productID').value;
        const productName = document.getElementById('productName').value;
        const productPrice = parseFloat(document.getElementById('productPrice').value);
        const productQty = parseInt(document.getElementById('saleDetailQty').value);
        const stock = parseInt(document.getElementById('stock').value);

        if (saleDetails.some(detail => detail.productId === productId)) {
            alert("El producto ya ha sido agregado.");
            return;
        }

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

        saleDetails.push({
            productId,
            productName,
            productPrice,
            productQty,
            subtotal
        });

        clearProductFields();
    }


    function updateRowSubtotal(input) {
        const row = input.parentNode.parentNode;
        const productPrice = parseFloat(row.cells[3].textContent);
        const qty = parseInt(input.value);
        row.cells[5].textContent = (productPrice * qty).toFixed(2);
        updateTotal();
    }

    function updateTotal() {
        let total = 0;
        document.querySelectorAll("#detailsTable tbody tr").forEach(row => {
            const subtotal = parseFloat(row.cells[5].textContent);
            total += subtotal;
        });
        document.getElementById("total").textContent = total.toFixed(2);
        document.getElementById("totalHidden").value = total.toFixed(2);
    }

    function removeRow(button) {
        const row = button.parentNode.parentNode;
        const productId = row.cells[1].textContent;
        saleDetails = saleDetails.filter(detail => detail.productId !== productId);
        row.parentNode.removeChild(row);
        updateTotal();
    }

    function clearProductFields() {
        document.getElementById('productID').value = '';
        document.getElementById('productName').value = '';
        document.getElementById('productPrice').value = '';
        document.getElementById('saleDetailQty').value = 1;
        document.getElementById('stock').value = '';
        document.getElementById('productSelect').value = '';
        document.getElementById('productList').innerHTML = '';
    }

    function clearAll() {
        document.getElementById('customerName').value = '';
        clearProductFields();
        document.querySelector("#detailsTable tbody").innerHTML = '';
        document.getElementById("total").textContent = "0.00";
        saleDetails = [];
    }

    function filterProducts() {
        const input = document.getElementById('productSelect').value.toLowerCase();
        const productList = document.getElementById('productList');
        productList.innerHTML = '';

        products.forEach(product => {
            if (product.productName.toLowerCase().includes(input)) {
                const item = document.createElement('div');
                item.classList.add('list-group-item');
                item.textContent = product.productName;
                item.onclick = () => selectProduct(product);
                productList.appendChild(item);
            }
        });

        // Ocultar la lista si no hay entrada en el campo de búsqueda
        if (input === '') {
            productList.innerHTML = '';
        }
    }

    function showProductList() {
        const productList = document.getElementById('productList');
        productList.innerHTML = '';

        products.forEach(product => {
            const item = document.createElement('div');
            item.classList.add('list-group-item');
            item.textContent = product.productName;
            item.onclick = () => selectProduct(product);
            productList.appendChild(item);
        });
    }

    function selectProduct(product) {
        document.getElementById('productID').value = product.ProductID;
        document.getElementById('productName').value = product.productName;
        document.getElementById('productPrice').value = product.productPrice;
        document.getElementById('stock').value = product.stock;
        document.getElementById('saleDetailQty').value = 1;
        document.getElementById('productSelect').value = product.productName;
        document.getElementById('productList').innerHTML = '';
    }

    function validateSale() {
    if (saleDetails.length === 0) {
        alert("No puedes generar una venta sin productos.");
        return false;
    }

    // Convierte saleDetails a JSON y almacénalo en el campo oculto
    document.getElementById("saleDetailsHidden").value = JSON.stringify(saleDetails);

    // Pregunta al usuario si realmente quiere generar la venta
    return confirm("¿Estás seguro de que deseas generar esta venta?");
}
</script>

<?php include '../templates/footer.php'; ?>