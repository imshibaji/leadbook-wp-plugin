<?php
$data = get_business(get_current_id());
update_business($_POST);
?>
<div class="wrap">
    <h1>Edit Business</h1>
    <form class="row g-3 me-2" method="post" action="<?php echo esc_html(post_url()); ?>" enctype="multipart/form-data">
        <input type="hidden" name="action" value="edit">
        <input type="hidden" name="id" value="<?php echo esc_html($data->id) ?? ''; ?>">
        <div class="col-md-6">
            <label for="name">Name*</label>
            <input type="text" name="name" id="name" class="form-control" value="<?php echo esc_html($data->name) ?>" required>
        </div>
        <div class="col-md-6">
            <label for="email">Email*</label>
            <input type="email" name="email" id="email" class="form-control" value="<?php echo esc_html($data->email) ?>" required>
        </div>
        <div class="col-md-4">
            <label for="mobile">Mobile*</label>
            <input type="text" name="mobile" id="mobile" class="form-control" value="<?php echo esc_html($data->mobile) ?>" required>
        </div>
        <div class="col-md-4">
            <label for="whatsapp">WhatsApp Number</label>
            <input type="text" name="whatsapp" id="whatsapp" class="form-control" value="<?php echo esc_html($data->whatsapp) ?>">
        </div>
        <div class="col-md-4">
            <label for="alt_mobile">Alternate Mobile</label>
            <input type="text" name="alt_mobile" id="alt_mobile" class="form-control" value="<?php echo esc_html($data->alt_mobile) ?>">
        </div>
        <div class="col-md-12">
            <label for="address">Address*</label>
            <input type="text" name="address" id="address" class="form-control" value="<?php echo esc_html($data->address) ?>" required>
        </div>
        <div class="col-md-3">
            <label for="city">City*</label>
            <input type="text" name="city" id="city" class="form-control" value="<?php echo esc_html($data->city) ?>" required>
        </div>
        <div class="col-md-3">
            <label for="state">State*</label>
            <input type="text" name="state" id="state" class="form-control" value="<?php echo esc_html($data->state) ?>" required>
        </div>
        <div class="col-md-3">
            <label for="country">Country*</label>
            <input type="text" name="country" id="country" class="form-control" value="<?php echo esc_html($data->country) ?>" required>
        </div>
        <div class="col-md-3">
            <label for="pincode">Pincode*</label>
            <input type="text" name="pincode" id="pincode" class="form-control" value="<?php echo esc_html($data->pincode) ?>" required>
        </div>
        <div class="col-md-4">
            <label for="website">Website</label>
            <input type="text" name="website" id="website" class="form-control" value="<?php echo esc_html($data->website) ?>">
        </div>
        <div class="col-md-4">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control"><?php echo esc_html($data->description) ?></textarea>
        </div>
        <div class="col-md-4">
            <label for="logo">Logo</label>
            <input type="file" name="logo" id="logo" class="form-control p-2">
        </div>
        <div class="col-md-4">
            <label for="bank_name">Bank Name</label>
            <input type="text" name="bank_name" id="bank_name" class="form-control" value="<?php echo esc_html($data->bank_name) ?>">
        </div>
        <div class="col-md-4">
            <label for="account_number">Account Number</label>
            <input type="text" name="account_number" id="account_number" class="form-control" value="<?php echo esc_html($data->account_number) ?>">
        </div>
        <div class="col-md-4">
            <label for="ifsc_code">IFSC Code</label>
            <input type="text" name="ifsc_code" id="ifsc_code" class="form-control" value="<?php echo esc_html($data->ifsc_code) ?>">
        </div>
        <div class="col-md-4">
            <label for="gst_number">GST Number</label>
            <input type="text" name="gst_number" id="gst_number" class="form-control" value="<?php echo esc_html($data->gst_number) ?>">
        </div>
        <div class="col-md-4">
            <label for="pan_number">PAN Number</label>
            <input type="text" name="pan_number" id="pan_number" class="form-control" value="<?php echo esc_html($data->pan_number) ?>">
        </div>
        <div class="col-md-4">
            <label for="aadhar_number">Aadhar Number</label>
            <input type="text" name="aadhar_number" id="aadhar_number" class="form-control" value="<?php echo esc_html($data->aadhar_number) ?>">
        </div>
        <div class="col-md-4">
            <label for="pan_image">PAN Image</label>
            <input type="file" name="pan_image" id="pan_image" class="form-control p-2">
        </div>
        <div class="col-md-4">
            <label for="aadhar_image">Aadhar Image</label>
            <input type="file" name="aadhar_image" id="aadhar_image" class="form-control p-2">
        </div>
        <div class="col-md-4">
            <label for="bank_image">Bank Image</label>
            <input type="file" name="bank_image" id="bank_image" class="form-control p-2">
        </div>
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary">Save Business</button>
        </div>
    </form>
</div>