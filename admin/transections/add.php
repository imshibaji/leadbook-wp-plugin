<?php
$actions = [
    ['link' => 'admin.php?page=leadbook-transections', 'title' => 'Back To Transections Section'],
];
get_leadbook_header($title, $actions);

add_transection($_POST);
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card" style="padding: 0; max-width: 100%;">
                <div class="card-header">
                    <h5 class="card-title">Add Transection</h5>
                </div>
                <div class="card-body">
                    <form class="row g-3" method="post" action="<?php echo esc_html(post_url()); ?>">
                        <input type="hidden" name="action" value="add">
                        <div class="form-group col-12">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="form-control" required></textarea>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="name">Type</label>
                            <select name="type" id="type" class="form-control">
                                <option value="debit">Debit</option>
                                <option value="credit">Credit</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="total">Paid Amount</label>
                            <input type="number" name="amount" id="amount" class="form-control" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="business_id">Business ID</label>
                            <select name="business_id" id="business_id" class="form-control" required>
                                <?php foreach(get_all_businesses() as $business): ?>
                                    <option value="<?php echo esc_html($business->ID); ?>"><?php echo esc_html($business->name); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="created_by">Created By</label>
                            <select name="created_by" id="created_by" class="form-control" required>
                                <?php foreach(get_users() as $user): ?>
                                    <option value="<?php echo esc_html($user->ID); ?>"><?php echo esc_html($user->first_name); ?> <?php echo esc_html($user->last_name); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="managed_by">Managed By</label>
                            <select name="managed_by" id="managed_by" class="form-control" required>
                                <?php foreach(get_users() as $user): ?>
                                    <option value="<?php echo esc_html($user->ID); ?>"><?php echo esc_html($user->first_name); ?> <?php echo esc_html($user->last_name); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Transection</button>
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