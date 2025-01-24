<?php
$actions = [
    ['link' => 'admin.php?page=leadbook-leads', 'title' => 'Back To Leads Section'],
];
get_leadbook_header('Edit Lead', $actions);

// Get Lead Data by ID
$lead = get_lead(get_current_id());

// Update Lead
update_lead($_POST);
?>
<form class="row pe-3" action="<?php echo esc_html(post_url()); ?>" method="post">
    <input type="hidden" name="action" value="edit">
    <input type="hidden" name="id" value="<?php echo esc_html($lead->ID); ?>">
    <div class="col-md-12">
        <label for="Purpose">Purpose*</label>
        <input type="text" name="purpose" id="Purpose" class="form-control" value="<?php echo esc_html($lead->purpose); ?>" required>
    </div>
    <div class="col-md-6">
        <label for="name">Name*</label>
        <input type="text" name="name" id="name" class="form-control" value="<?php echo esc_html($lead->name); ?>" required>
    </div>
    <div class="col-md-6">
        <label for="email">Email*</label>
        <input type="email" name="email" id="email" class="form-control" value="<?php echo esc_html($lead->email); ?>" required>
    </div>
    <div class="col-md-4">
        <label for="mobile">Mobile*</label>
        <input type="text" name="mobile" id="mobile" class="form-control" value="<?php echo esc_html($lead->mobile); ?>" required>
    </div>
    <div class="col-md-4">
        <label for="whatsapp">WhatsApp Number</label>
        <input type="text" name="whatsapp" id="whatsapp" class="form-control" value="<?php echo esc_html($lead->whatsapp); ?>">
    </div>
    <div class="col-md-4">
        <label for="alt_mobile">Alternate Mobile</label>
        <input type="text" name="alt_mobile" id="alt_mobile" class="form-control" value="<?php echo esc_html($lead->alt_mobile); ?>">
    </div>
    <div class="col-md-12">
        <label for="address">Address</label>
        <input type="text" name="address" id="address" class="form-control" value="<?php echo esc_html($lead->address); ?>">
    </div>
    <div class="col-md-3">
        <label for="city">City</label>
        <input type="text" name="city" id="city" class="form-control" value="<?php echo esc_html($lead->city); ?>">
    </div>
    <div class="col-md-3">
        <label for="state">State</label>
        <input type="text" name="state" id="state" class="form-control" value="<?php echo esc_html($lead->state); ?>">
    </div>
    <div class="col-md-3">
        <label for="country">Country</label>
        <input type="text" name="country" id="country" class="form-control" value="<?php echo esc_html($lead->country); ?>">
    </div>
    <div class="col-md-3">
        <label for="pincode">Pincode</label>
        <input type="text" name="pincode" id="pincode" class="form-control" value="<?php echo esc_html($lead->pincode); ?>">
    </div>
    <div class="col-md-4">
        <label for="source">Source</label>
        <select name="source" id="source" class="form-select">
            <option value="<?php echo esc_html($lead->source); ?>"><?php echo esc_html($lead->source); ?></option>
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
            <option value="<?php echo esc_html($lead->status) ?? ''; ?>"><?php echo esc_html($lead->status) ?? ''; ?></option>
            <option value="New">New</option>
            <option value="Pending">Pending</option>
            <option value="Interested">Interested</option>
            <option value="Success">Success</option>
            <option value="Reject">Reject</option>
            <option value="Expaire">Expaire</option>
        </select>
    </div>
    <div class = "col-md-4">
        <label for="business_id">Business ID</label>
        <select type="text" name="business_id" id="business_id" class="form-select">
            <?php foreach(get_all_businesses() as $business): ?>
                <option <?php echo esc_html(($lead->business_id == $business->ID)? 'selected' : ''); ?> value="<?php echo esc_html($business->ID); ?>"><?php echo esc_html($business->name); ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="col-md-12 my-3">
        <button type="submit" class="btn btn-primary">Save Now</button>
    </div>
</form>