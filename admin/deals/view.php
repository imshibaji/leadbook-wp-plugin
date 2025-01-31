<?php
$actions = [
    ['link' => 'admin.php?page=leadbook-deals', 'title' => 'Back To Deals Section'],
];
get_leadbook_header($title, $actions);
// list_header('View Invoice');
$data = get_deal(get_current_id());
$business = get_business_by_deal_id($data->ID);
$lead = get_lead_by_deal_id($data->ID);
?>
<div class="container">
    <div class="card" style="padding: 0; max-width: 100%;">
        <div class="card-body" style="min-height:550px">
            <div id="invoice">
                <table style="width:100%;">
                    <tr>
                        <th style="width:60%">
                            <h1><?php echo esc_html($business->name) ?></h1>
                            <h6><?php echo get_business_contact_info($business); ?></h6>
                            <h6><?php echo get_business_complete_address($business); ?></h6>
                        </th>
                        <th style="width:40%; text-align:right">
                            <h6>Invoice Id: <?php echo '#000-' . esc_html($data->ID); ?></h6>
                            <h6>Invoice Date: <?php echo esc_html(date('d M, Y', strtotime($data->created_at))); ?></h6>
                        </th>
                    </tr>
                </table>
                <hr />
                <h6></h6>
                <table style="width: 100%;">
                    <tr>
                        <th style="text-align: center; background-color: #f4f4f4; padding:5px" colspan="3">Customer Information:</th>
                    </tr>
                    <tr>
                        <td>Name: <strong><?php echo esc_html($lead->name) ?></strong></td>
                        <td><?php if($lead->email): ?>Email: <strong><?php echo esc_html($lead->email) ?></strong><?php endif; ?></td>
                        <td>Mobile: <strong><?php echo esc_html($lead->mobile) ?></strong></td>
                    </tr>
                </table>
                <hr />
                <table class="invoice-table" style="width:100%">
                    <thead>
                        <tr style="text-align:center;">
                            <th style="width:5%">No</th>
                            <th style="width:60%">Details</th>
                            <th style="width:5%">Qty</th>
                            <th style="width:30%; text-align:right">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $items = ddjs($data->description);
                        $items = json_decode($items);
                        ?>
                        <?php foreach ($items as $k => $item): ?>
                            <tr style="text-align:center;">
                                <td><?php echo ($k + 1); ?></td>
                                <td style="text-align:left;"><?php echo $item->name; ?></td>
                                <td><?php echo $item->quantity; ?></td>
                                <td style="text-align:right; padding-right:12px"><?php echo $item->price; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th style="text-align:right;" colspan="3">Total Payble</th>
                            <th style="text-align:right; padding-right:12px"><?php echo esc_html($data->amount) ?></th>
                        </tr>
                        <?php if ($data->discount > 0): ?>
                            <tr>
                                <th style="text-align:right;" colspan="3">Discount</th>
                                <th style="text-align:right; padding-right:12px">
                                    <?php echo esc_html($data->discount) ?>
                                    <?php echo ($data->discount_type=='amount')? 'AMT': '%'; ?>
                                </th>
                            </tr>
                        <?php endif; ?>
                        <tr>
                            <th style="text-align:right;" colspan="3">Advance</th>
                            <th style="text-align:right; padding-right:12px"><?php echo esc_html($data->advance) ?></th>
                        </tr>
                        <?php if ($data->tax_amount > 0): ?>
                            <tr>
                                <th style="text-align:right;" colspan="3">Tax: <?php echo esc_html($data->tax_name) ?></th>
                                <th style="text-align:right; padding-right:12px">
                                    <?php echo esc_html($data->tax_amount) ?>
                                    <?php echo ($data->tax_type=='amount')? 'AMT': '%'; ?>
                                </th>
                            </tr>
                        <?php endif; ?>
                        <tr>
                            <th style="text-align:right;" colspan="3">Paid Amt</th>
                            <th style="text-align:right; padding-right:12px"><?php echo esc_html($data->total) ?></th>
                        </tr>
                        <?php if($data->balance>0): ?>
                        <tr>
                            <th style="text-align:right;" colspan="3">Due Amount</th>
                            <th style="text-align:right; padding-right:12px"><?php echo esc_html($data->balance) ?></th>
                        </tr>
                        <tr>
                            <th style="text-align:right;" colspan="3">Due Date</th>
                            <th style="text-align:right; padding-right:12px"><?php echo esc_html(date('d M, Y', strtotime($data->due_date))) ?></th>
                        </tr>
                        <?php endif; ?>
                        <tr>
                            <td style="text-align:center;" colspan="4">
                                Payment Status: <strong><?php echo deal_payment_status($data); ?></strong>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="text-end my-3">
                <button onclick="downloadPDF(<?php echo esc_html($data->ID); ?>)" class="btn btn-primary">PDF Invoice Download</button>
                <button onclick="printInvoice()" class="btn btn-info">Print Invoice</button>
                <a class="btn btn-warning" href="<?php echo esc_html(leadbook_navigate('deals', ['action' => 'edit', 'id' => $data->ID])); ?>">Edit Invoice</a>
            </div>
        </div>
    </div>
</div>
<style id="invoice_css">
#invoice{
    padding: 20px;
}
.invoice-table,
.invoice-table th,
.invoice-table td {
    border: 1px solid black;
    padding: 5px;
}

.invoice-table th {
    font-weight: bold;
}
@media print {
    #invoice{
        padding: 20px;
    }
    .invoice-table,
    .invoice-table th,
    .invoice-table td {
        border: 1px solid black;
        padding: 5px;
    }

    .invoice-table th {
        font-weight: bold;
    }
    .no-print {
        display: none !important; /* Hide the print button */
    }
}
</style>
<script src="<?php echo LEADBOOK_ASSETS ?>/js/html2pdf.bundle.min.js"></script>
<script>
    function downloadPDF(id) {
            // Create a temporary div to hold selected elements
            let pdfContainer = document.createElement("div");

            // ✅ Add specific elements to the PDF
            let invoice = document.querySelector("#invoice").cloneNode(true);
            let extraContent = document.querySelector("#invoice_css").cloneNode(true);

            // Apply the PDF styling
            // invoice.classList.add("pdf-style");
            // extraContent.classList.add("pdf-style");

            // Append cloned elements to the temporary container
            pdfContainer.appendChild(invoice);
            pdfContainer.appendChild(extraContent);

            // Convert the temporary div to PDF
            html2pdf().from(pdfContainer).save("Invoice-"+(id || 1)+".pdf");
    }
    function printInvoice() {
        var divToPrint = document.querySelector("#invoice");
        var cssToPrint = document.querySelector('#invoice_css');
        if (!divToPrint) {
            alert("Invoice content not found!");
            return;
        }
        if (!cssToPrint) {
            alert("Invoice CSS content not found!");
            return;
        }

        var originalContent = document.body.innerHTML; // Save original page content
        document.body.innerHTML = divToPrint.outerHTML; // Replace body with invoice
        document.body.innerHTML += cssToPrint.outerHTML;

        window.print(); // Open print dialog

        document.body.innerHTML = originalContent; // Restore original content
        location.reload(); // Reload to restore scripts/styles
    }
</script>