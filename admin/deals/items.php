<input type="hidden" name="description" id="description" required>
<div class="table-responsive">
    <table class="table table-bordered" id="invoiceTable">
        <thead>
            <tr>
                <th>Item</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody class="text-center"></tbody>
    </table>
</div>
<div class="btn btn-primary btn-sm" onclick="addItem()">Add Item</div>
<!-- <button class="btn btn-primary btn-sm" onclick="loadData()">Load Data</button> -->
<style>
th, td { border: 1px solid #ccc; padding: 0px; text-align: left; }
.item, .quantity, .price { width: 100%; }
</style>
<script>
    let invoiceData = JSON.parse('<?php echo isset($items)? $items : '[]'; ?>');

    window.onload = () => {
        loadData(invoiceData);
    }

    function addItem(item = {
        name: '',
        quantity: 0,
        price: 0
    }) {
        const table = document.getElementById("invoiceTable").getElementsByTagName('tbody')[0];
        const row = table.insertRow();
        row.innerHTML = `
        <td><input type="text" class="item" value="${item.name}" oninput="updateTotal(this)"></td>
        <td><input type="number" class="quantity" value="${item.quantity}" oninput="updateTotal(this)"></td>
        <td><input type="number" class="price" value="${item.price}" oninput="updateTotal(this)"></td>
        <td class="total">${(item.quantity * item.price).toFixed(2)}</td>
        <td><button class="btn btn-danger btn-sm" onclick="removeItem(this)">X</button></td>
    `;
        updateGrandTotal();
        return false;
    }

    function updateTotal(input) {
        const row = input.parentElement.parentElement;
        const quantity = row.querySelector('.quantity').value || 0;
        const price = row.querySelector('.price').value || 0;
        const total = quantity * price;
        row.querySelector('.total').textContent = total.toFixed(2);
        updateGrandTotal();
    }

    function removeItem(button) {
        const row = button.parentElement.parentElement;
        row.remove();
        updateGrandTotal();
    }
    function updateGrandTotal() {
        let total = 0;
        document.querySelectorAll('.total').forEach(cell => {
            total += parseFloat(cell.textContent) || 0;
        });
        // document.getElementById('totalPrice').textContent = total.toFixed(2);
        document.getElementById('amount').value = total.toFixed(2);
        itemsList();
    }

    function loadData(invoiceData = []) {
        document.querySelector("tbody").innerHTML = "";
        invoiceData.forEach(item => addItem(item));
        updateGrandTotal();        
    }

    function itemsList() {
        const items = [];
        document.querySelectorAll('#invoiceTable tbody tr').forEach(row => {
            const item = {
                name: row.querySelector('.item').value,
                quantity: row.querySelector('.quantity').value,
                price: row.querySelector('.price').value
            };
            items.push(item);
        });
        document.getElementById('description').value = JSON.stringify(items);
        return false;
    }

    function printInvoice() {
        window.print();
    }
</script>