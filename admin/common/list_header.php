<?php
function list_header($title = 'Leadbook Dashboard', $nav_to='')
{
?>
    <div class="row">
        <div class="col-md-8">
            <h4><?php echo $title ?></h4>
        </div>
        <div class="col-md-4">
            <?php if($nav_to != ''): ?>
            <div class="input-group mb-3">
                <select name="business_id" id="business_id" class="form-select">
                    <option value="">Select Business</option>
                    <?php foreach (get_all_businesses() as $business): ?>
                        <option <?php if (isset($_GET['business_id']) && $business->ID == $_GET['business_id']): ?>selected <?php endif; ?> value="<?php echo esc_html($business->ID); ?>">
                            <?php echo esc_html($business->name); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <script>
                    document.getElementById('business_id').addEventListener('change', function() {
                        var url = '<?php echo (leadbook_navigate($nav_to, ['business_id' => '']) . '&business_id=') ?>' + this.value;
                        window.location.replace(url);
                    });
                </script>
            </div>
            <?php endif; ?>
        </div>
    </div>
<?php
}
?>