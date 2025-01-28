<?php
$actions = [
    ['link' => 'admin.php?page=leadbook-deals', 'title' => 'Back To Deals Section'],
];
get_leadbook_header($title, $actions);

$data = get_deal(get_current_id());

update_deal($_POST);
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card" style="padding: 0; max-width: 100%;">
                <div class="card-header">
                    <h5 class="card-title">Edit Deal</h5>
                </div>
                <div class="card-body">
                    <form class="row g-3" method="post" action="<?php echo esc_html(post_url()); ?>">
                        <input type="hidden" name="action" value="edit">
                        <input type="hidden" name="id" value="<?php echo esc_html($data->ID) ?? ''; ?>">
                        <div class="form-group col-12">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="<?php echo esc_html($data->name ?? ''); ?>" required>
                        </div>
                        <div class="form-group col-12">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="form-control" required><?php echo esc_html($data->description ?? ''); ?></textarea>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="amount">Amount</label>
                            <div class="input-group">
                                <select class="input-group-text" name="currency_code" id="currency" required>
                                    <option <?php echo esc_html($data->currency_code ?? '') == 'INR' ? 'selected' : ''; ?> value="INR">INR</option>
                                    <option <?php echo esc_html($data->currency_code ?? '') == 'USD' ? 'selected' : ''; ?> value="USD">USD</option>
                                    <option <?php echo esc_html($data->currency_code ?? '') == 'EUR' ? 'selected' : ''; ?> value="EUR">EUR</option>
                                    <option <?php echo esc_html($data->currency_code ?? '') == 'GBP' ? 'selected' : ''; ?> value="GBP">GBP</option>
                                </select>
                                <input type="number" name="amount" id="amount" class="form-control" value="<?php echo esc_html($data->amount ?? ''); ?>" required>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="discount">Discount</label>
                            <div class="input-group">
                                <input type="number" name="discount" id="discount" class="form-control" value="<?php echo esc_html($data->discount ?? ''); ?>" required>
                                <select class="input-group-text" name="discount_type" id="discount_type" required>
                                    <option <?php echo esc_html($data->discount_type ?? '') == 'percentage' ? 'selected' : ''; ?> value="percentage">Percentage</option>
                                    <option <?php echo esc_html($data->discount_type ?? '') == 'amount' ? 'selected' : ''; ?> value="amount">Amount</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="advance">Advance / Pay Amount</label>
                            <input type="number" name="advance" id="advance" class="form-control" value="<?php echo esc_html($data->advance ?? ''); ?>" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="balance">Due Amount</label>
                            <input type="number" name="balance" id="balance" class="form-control" value="<?php echo esc_html($data->balance ?? '0'); ?>" readonly>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="due_date">Due Date</label>
                            <input type="date" name="due_date" id="due_date" class="form-control" value="<?php echo esc_html(date('Y-m-d', strtotime($data->due_date ?? ''))); ?>" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="total">Paid Amount</label>
                            <input type="number" name="total" id="total" class="form-control" value="<?php echo esc_html($data->total ?? '0'); ?>" readonly>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control" required>
                                <option <?php echo esc_html($data->status ?? '') == 'pending' ? 'selected' : ''; ?> value="pending">Pending</option>
                                <option <?php echo esc_html($data->status ?? '') == 'paid' ? 'selected' : ''; ?> value="paid">Paid</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="lead_id">Lead ID</label>
                            <select name="lead_id" id="lead_id" class="form-control" required>
                                <?php foreach (get_all_leads() as $lead): ?>
                                    <option value="<?php echo esc_html($lead->ID); ?>"><?php echo esc_html($lead->name); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="business_id">Business ID</label>
                            <select name="business_id" id="business_id" class="form-control" required>
                                <?php foreach (get_all_businesses() as $business): ?>
                                    <option value="<?php echo esc_html($business->ID); ?>"><?php echo esc_html($business->name); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="created_by">Created By</label>
                            <select name="created_by" id="created_by" class="form-control" required>
                                <?php foreach (get_users() as $user): ?>
                                    <option value="<?php echo esc_html($user->ID); ?>"><?php echo esc_html($user->first_name); ?> <?php echo esc_html($user->last_name); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="managed_by">Managed By</label>
                            <select name="managed_by" id="managed_by" class="form-control" required>
                                <?php foreach (get_users() as $user): ?>
                                    <option value="<?php echo esc_html($user->ID); ?>"><?php echo esc_html($user->first_name); ?> <?php echo esc_html($user->last_name); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Deal</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var $ = jQuery;
    $(document).ready(function() {
        $('#amount, #discount, #advance, #discount_type, #balance').on('keyup', function() {
            calculate();
        });
        $('#amount, #discount, #advance, #discount_type, #balance').on('change', function() {
            calculate();
        });
        function calculate(){
            var amount = Number($('#amount').val());
            var discount = Number($('#discount').val() || 0);
            var advance = Number($('#advance').val() || 0);
            var balance = Number($('#balance').val() || 0);
            var discountType = $('#discount_type').val();
            var discountCal = (amount * discount) / 100;
            var balanceAmount = (discountType === 'percentage' ?  (amount-discountCal): (amount-discount));            
            var balance = balanceAmount - advance;
            $('#balance').val(balance);
            var total = (advance == 0 ? balance : advance);
            $('#total').val(total);
        }
    });
</script>