<?php
$actions = [
    ['link' => 'admin.php?page=leadbook-leads', 'title' => 'Back To Leads Section'],
];
get_leadbook_header('Add Lead', $actions);

// After Submit A Lead
add_lead($_POST);

// Check If Business Exists
$businesses = get_all_businesses();
if ($businesses == null) {
    leadbook_redirect('businesses', 'add', 'Please add a business first', 'error');
}
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card" style="padding: 0; max-width: 100%;">
                <div class="card-header">
                    <h5 class="card-title">Add Lead</h5>
                </div>
                <div class="card-body">
                    <form class="row g-3 me-2" action="<?php echo esc_html(post_url()); ?>" method="post">
                        <input type="hidden" name="action" value="add">
                        <div class="col-md-12">
                            <label for="Purpose">Purpose*</label>
                            <input type="text" name="purpose" id="Purpose" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="name">Name*</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="email">Email*</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label for="mobile">Mobile*</label>
                            <input type="text" name="mobile" id="mobile" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label for="whatsapp">WhatsApp Number</label>
                            <input type="text" name="whatsapp" id="whatsapp" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="alt_mobile">Alternate Mobile</label>
                            <input type="text" name="alt_mobile" id="alt_mobile" class="form-control">
                        </div>
                        <div class="col-md-12">
                            <label for="address">Address</label>
                            <input type="text" name="address" id="address" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label for="city">City</label>
                            <input type="text" name="city" id="city" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label for="state">State</label>
                            <input type="text" name="state" id="state" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label for="country">Country</label>
                            <input type="text" name="country" id="country" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label for="pincode">Pincode</label>
                            <input type="text" name="pincode" id="pincode" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="source">Source</label>
                            <select name="source" id="source" class="form-select">
                                <option value="In Shop">In Shop</option>
                                <option value="Facebook">Facebook</option>
                                <option value="Instagram">Instagram</option>
                                <option value="Google">Google</option>
                                <option value="Call">Call</option>
                                <option value="WhatsApp">WhatsApp</option>
                                <option value="Website">Website</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-select" required>
                                <option value="New">New</option>
                                <option value="Pending">Pending</option>
                                <option value="Interested">Interested</option>
                                <option value="Success">Success</option>
                                <option value="Reject">Reject</option>
                                <option value="Expaire">Expaire</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="business_id">Business ID</label>
                            <select type="text" name="business_id" id="business_id" class="form-select">
                                <?php foreach (get_all_businesses() as $business): ?>
                                    <option value="<?php echo esc_html($business->ID); ?>"><?php echo esc_html($business->name); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="created_by">Created By</label>
                            <select name="created_by" id="created_by" class="form-control" required>
                                <?php foreach (get_users() as $user): ?>
                                    <option value="<?php echo esc_html($user->ID); ?>"><?php echo esc_html($user->first_name); ?> <?php echo esc_html($user->last_name); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="managed_by">Managed By</label>
                            <select name="managed_by" id="managed_by" class="form-control" required>
                                <?php foreach (get_users() as $user): ?>
                                    <option value="<?php echo esc_html($user->ID); ?>"><?php echo esc_html($user->first_name); ?> <?php echo esc_html($user->last_name); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-12 my-3">
                            <button type="submit" class="btn btn-primary">Save Now</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>