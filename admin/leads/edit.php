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
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card" style="padding: 0; max-width: 100%;">
                <div class="card-header">
                    <h5 class="card-title">Edit Lead</h5>
                </div>
                <div class="card-body">
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
                                <option <?php echo esc_html(($lead->source == 'In Shop') ? 'selected' : ''); ?> value="In Shop">In Shop</option>
                                <option <?php echo esc_html(($lead->source == 'Facebook') ? 'selected' : ''); ?> value="Facebook">Facebook</option>
                                <option <?php echo esc_html(($lead->source == 'Instagram') ? 'selected' : ''); ?> value="Instagram">Instagram</option>
                                <option <?php echo esc_html(($lead->source == 'Google') ? 'selected' : ''); ?> value="Google">Google</option>
                                <option <?php echo esc_html(($lead->source == 'Call') ? 'selected' : ''); ?> value="Call">Call</option>
                                <option <?php echo esc_html(($lead->source == 'WhatsApp') ? 'selected' : ''); ?> value="WhatsApp">WhatsApp</option>
                                <option <?php echo esc_html(($lead->source == 'Website') ? 'selected' : ''); ?> value="Website">Website</option>
                                <option <?php echo esc_html(($lead->source == 'Other') ? 'selected' : ''); ?> value="Other">Other</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-select" required>
                                <option <?php echo esc_html(($lead->status == 'New') ? 'selected' : ''); ?> value="New">New</option>
                                <option <?php echo esc_html(($lead->status == 'Pending') ? 'selected' : ''); ?> value="Pending">Pending</option>
                                <option <?php echo esc_html(($lead->status == 'Interested') ? 'selected' : ''); ?> value="Interested">Interested</option>
                                <option <?php echo esc_html(($lead->status == 'Success') ? 'selected' : ''); ?> value="Success">Success</option>
                                <option <?php echo esc_html(($lead->status == 'Reject') ? 'selected' : ''); ?> value="Reject">Reject</option>
                                <option <?php echo esc_html(($lead->status == 'Expaire') ? 'selected' : ''); ?> value="Expaire">Expaire</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="business_id">Business ID</label>
                            <select type="text" name="business_id" id="business_id" class="form-select">
                                <?php foreach (get_all_businesses() as $business): ?>
                                    <option <?php echo esc_html(($lead->business_id == $business->ID) ? 'selected' : ''); ?> value="<?php echo esc_html($business->ID); ?>"><?php echo esc_html($business->name); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="created_by">Created By</label>
                            <select name="created_by" id="created_by" class="form-control" required>
                                <?php foreach (get_users() as $user): ?>
                                    <option <?php echo esc_html(($lead->created_by == $user->ID) ? 'selected' : ''); ?> value="<?php echo esc_html($user->ID); ?>"><?php echo esc_html($user->first_name); ?> <?php echo esc_html($user->last_name); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="managed_by">Managed By</label>
                            <select name="managed_by" id="managed_by" class="form-control" required>
                                <?php foreach (get_users() as $user): ?>
                                    <option <?php echo esc_html(($lead->managed_by == $user->ID) ? 'selected' : ''); ?> value="<?php echo esc_html($user->ID); ?>"><?php echo esc_html($user->first_name); ?> <?php echo esc_html($user->last_name); ?></option>
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