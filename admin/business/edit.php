<?php
$actions = [
    ['link' => 'admin.php?page=leadbook-businesses', 'title' => 'Back To Businesses Section'],
];
get_leadbook_header($title, $actions);

$data = get_business(get_current_id());

wp_enqueue_media();
update_business($_POST);
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card" style="padding: 0; max-width: 100%;">
                <div class="card-header">
                    <h5 class="card-title">Edit Business</h5>
                </div>
                <div class="card-body">
                    <form class="row g-3 me-2" method="post" action="<?php echo esc_html(post_url()); ?>" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="edit">
                        <input type="hidden" name="id" value="<?php echo esc_html($data->ID) ?? ''; ?>">
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
                        <div class="col-md-8">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="form-control textarea"><?php echo esc_html($data->description) ?></textarea>
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
                            <label for="pan_number">PAN / TAN Number</label>
                            <input type="text" name="pan_number" id="pan_number" class="form-control" value="<?php echo esc_html($data->pan_number) ?>">
                        </div>
                        <div class="col-md-4">
                            <label for="aadhar_number">Aadhar Number</label>
                            <input type="text" name="aadhar_number" id="aadhar_number" class="form-control" value="<?php echo esc_html($data->aadhar_number) ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="created_by">Created By</label>
                            <select name="created_by" id="created_by" class="form-control" required>
                                <?php foreach (get_users() as $user): ?>
                                    <option <?php if ($user->ID == $data->created_by): ?>selected<?php endif; ?> value="<?php echo esc_html($user->ID); ?>"><?php echo esc_html($user->first_name); ?> <?php echo esc_html($user->last_name); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="managed_by">Managed By</label>
                            <select name="managed_by" id="managed_by" class="form-control" required>
                                <?php foreach (get_users() as $user): ?>
                                    <option <?php if ($user->ID == $data->managed_by): ?>selected<?php endif; ?> value="<?php echo esc_html($user->ID); ?>"><?php echo esc_html($user->first_name); ?> <?php echo esc_html($user->last_name); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="logo">Business Logo</label>
                            <input type="hidden" id="logo" name="logo">
                            <div id="logo_preview">
                                <p>Upload Logo 100 X 100</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="signature">Signature Image</label>
                            <input type="hidden" id="signature" name="signature">
                            <div id="signature_preview">
                                <p>Signature Image 100 X 100</p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Save Business</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
.textarea{
    height: 35px;
}
#logo_preview, #signature_preview{
    width: 100%;
    height: 100px;
    overflow: hidden;
    background-color: #f4f4f4;
    display: flex;
  	justify-content: center;
  	align-items: center;
}
#logo_preview p, #signature_preview p{
    padding: 0px;
    margin: 0px;
}
#logo_preview img, #signature_preview img{
    width: 100px;
    height: 100px;
}
</style>
<script>
imageUploader('logo');
imageUploader('signature');
function imageUploader(image){
    jQuery(document).ready(function($) {
        $('#'+image+'_preview').click(function(e) {
            e.preventDefault();
            var mediaUploader = wp.media({
                title: 'Select Image',
                button: { text: 'Use This Image' },
                multiple: false
            }).on('select', function() {
                var attachment = mediaUploader.state().get('selection').first().toJSON();
                $('#'+image).val(attachment.url);
                $('#'+image+'_preview').html('<img src="'+attachment.url+'">');
            }).open();
        });
    });
}
</script>