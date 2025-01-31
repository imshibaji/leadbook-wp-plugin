<?php
$actions = [
    ['link' => 'admin.php?page=leadbook-deals', 'title' => 'Back To Deals Section'],
];
get_leadbook_header($title, $actions);

add_deal($_POST);
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card" style="padding: 0; max-width: 100%;">
                <div class="card-header">
                    <h5 class="card-title">Add Invoice / Quotation</h5>
                </div>
                <div class="card-body">
                    <form class="row" method="post" action="<?php echo esc_html(post_url()); ?>">
                        <input type="hidden" name="action" value="add">
                        <div class="form-group col-md-6">
                            <label for="lead_id">Invoice For</label>
                            <select name="lead_id" id="lead_id" class="form-control" required>
                                <?php foreach (get_all_leads() as $lead): ?>
                                    <option value="<?php echo esc_html($lead->ID); ?>"><?php echo esc_html($lead->name); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="business_id">Business ID</label>
                            <select name="business_id" id="business_id" class="form-control" required>
                                <?php foreach (get_all_businesses() as $business): ?>
                                    <option value="<?php echo esc_html($business->ID); ?>"><?php echo esc_html($business->name); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group col-12">
                            <label for="name">ID / Name of Invoice</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                        <div class="row" style="margin-top: 10px !important; padding: 0;">
                            <div class="col-md-8">
                                <h6>Description</h6>
                                <?php include_once(__DIR__ . '/items.php'); ?>
                            </div>
                            <div class="col-md-4">
                                <div class="row gap-2">
                                    <div class="form-group col p-0">
                                        <label for="amount">Amount</label>
                                        <input type="number" name="amount" id="amount" class="form-control" required>
                                    </div>
                                    <div class="form-group col p-0">
                                        <label for="discount">Discount</label>
                                        <div class="input-group">
                                            <input type="number" name="discount" id="discount" class="form-control" required>
                                            <select style="width: 70px;" class="input-group-text" name="discount_type" id="discount_type" required>
                                                <option value="percentage">%</option>
                                                <option value="amount">AMT</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="advance">Advance / Pay Amount</label>
                                    <input type="number" name="advance" id="advance" class="form-control" required>
                                </div>
                                <div class="row gap-2">
                                    <div class="form-group col p-0">
                                        <label for="balance">Tax Name</label>
                                        <input type="text" name="tax_name" id="tax_name" class="form-control">
                                    </div>
                                    <div class="form-group col p-0">
                                        <label for="total">Tax Amount</label>
                                        <div class="input-group">
                                            <input type="number" name="tax_amount" id="tax_amount" class="form-control" value="0">
                                            <select style="width: 70px;" class="input-group-text" name="tax_type" id="tax_type" required>
                                                <option value="percentage">%</option>
                                                <option value="amount">AMT</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row gap-2">
                                    <div class="form-group col p-0">
                                        <label for="balance">Due Amount</label>
                                        <input type="number" name="balance" id="balance" class="form-control" value="0" readonly>
                                    </div>
                                    <div class="form-group col p-0">
                                        <label for="due_date">Due Date</label>
                                        <input type="date" name="due_date" id="due_date" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="total">Paid Amount</label>
                                    <div class="input-group">
                                        <select style="width:65px" class="input-group-text" name="currency_code" id="currency" required>
                                            <option value="INR">INR</option>
                                            <option value="USD">USD</option>
                                            <option value="EUR">EUR</option>
                                            <option value="GBP">GBP</option>
                                        </select>
                                        <input type="number" name="total" id="total" class="form-control" value="0" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control" required>
                                        <option value="pending">Pending</option>
                                        <option value="paid">Paid</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="created_by">Created By</label>
                            <select name="created_by" id="created_by" class="form-control" required>
                                <?php foreach (get_users() as $user): ?>
                                    <option value="<?php echo esc_html($user->ID); ?>"><?php echo esc_html($user->first_name); ?> <?php echo esc_html($user->last_name); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6 mb-3">
                            <label for="managed_by">Managed By</label>
                            <select name="managed_by" id="managed_by" class="form-control" required>
                                <?php foreach (get_users() as $user): ?>
                                    <option value="<?php echo esc_html($user->ID); ?>"><?php echo esc_html($user->first_name); ?> <?php echo esc_html($user->last_name); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="row gap-2">
                            <div class="col p-0">
                                <button type="submit" style="width: 100%;" class="btn btn-primary">Save Deal</button>
                            </div>
                            <div class="col p-0 btn-group">
                                <a style="width: 100%;" class="btn btn-secondary" href="<?php echo esc_html(leadbook_navigate('deals', ['action' => 'add'])); ?>">
                                    Add New
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var $ = jQuery;
    $(document).ready(function() {
        $('#amount, #discount, #advance, #discount_type, #balance').on('click change paste keyup', function() {
            calculate();
        });
        $(window).on('input change', event => {
            calculate();
        });

        function calculate() {
            var amount = Number($('#amount').val());
            var discount = Number($('#discount').val() || 0);
            var advance = Number($('#advance').val() || 0);
            var balance = Number($('#balance').val() || 0);

            // Discount Calculation
            var discountType = $('#discount_type').val();
            var discountCal = (amount * discount) / 100;
            var balanceAmount = (discountType === 'percentage' ? (amount - discountCal) : (amount - discount));
            var balance = balanceAmount - advance;
            $('#balance').val(balance);

            // Tax Calculation
            var tax = Number($('#tax_amount').val() || 0);
            var taxType = $('#tax_type').val();
            var taxCal = (advance * tax) / 100;
            var taxAmount = (taxType === 'percentage' ? (advance + taxCal) : (advance + tax))
            // var total = (advance == 0 ? balance : taxAmount);
            var totalPaid = taxAmount;
            $('#total').val(totalPaid);
        }
    });
</script>