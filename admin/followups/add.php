<?php
$actions = [
    ['link' => 'admin.php?page=leadbook-followups', 'title' => 'Back To Businesses Section'],
];
get_leadbook_header($title, $actions);

add_followup($_POST);
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card" style="padding: 0; max-width: 100%;">
                <div class="card-header">
                    <h5 class="card-title">Add Followup</h5>
                </div>
                <div class="card-body">
                    <form class="row g-3" method="post" action="<?php echo esc_html(post_url()); ?>">
                        <input type="hidden" name="action" value="add">
                        <div class="form-group col-12">
                            <label for="followup_description">Title</label>
                            <input type="text" name="title" id="followup_description" class="form-control" required>
                        </div>
                        <div class="form-group col-12">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="form-control" required></textarea>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="date">Date</label>
                            <input type="date" name="date" id="date" class="form-control" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="time">Time</label>
                            <input type="time" name="time" id="time" class="form-control" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="lead_id">Lead ID</label>
                            <select name="lead_id" id="lead_id" class="form-control" required>
                                <?php foreach(get_all_leads() as $lead): ?>
                                    <option value="<?php echo esc_html($lead->ID); ?>"><?php echo esc_html($lead->name); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="type">Type</label>
                            <select name="type" id="type" class="form-control" required>
                                <option value="call">Call</option>
                                <option value="email">Email</option>
                                <option value="text">Text</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="pending">Pending</option>
                                <option value="completed">Completed</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="business_id">Business ID</label>
                            <select name="business_id" id="business_id" class="form-control" required>
                                <?php foreach(get_all_businesses() as $business): ?>
                                    <option value="<?php echo esc_html($business->ID); ?>"><?php echo esc_html($business->name); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Followup</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>