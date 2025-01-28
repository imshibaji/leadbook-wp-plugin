<?php
$actions = [
    ['link' => 'admin.php?page=leadbook-followups', 'title' => 'Back To Businesses Section'],
];
get_leadbook_header($title, $actions);

// Get Followup Data by ID
$data = get_followup(get_current_id());
$data->date = date('Y-m-d', strtotime($data->next_reminder));
$data->time = date('H:i:s', strtotime($data->next_reminder));

// Update Followup
update_followup($_POST);
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card" style="padding: 0; max-width: 100%;">
                <div class="card-header">
                    <h5 class="card-title">Edit Followup</h5>
                </div>
                <div class="card-body">
                    <form class="row g-3" method="post" action="<?php echo esc_html(post_url()); ?>">
                        <input type="hidden" name="action" value="edit">
                        <input type="hidden" name="id" value="<?php echo esc_html($data->ID); ?>">
                        <div class="form-group col-12">
                            <label for="followup_description">Title</label>
                            <input type="text" name="title" id="followup_description" class="form-control" value="<?php echo esc_html($data->title); ?>" required>
                        </div>
                        <div class="form-group col-12">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="form-control" required><?php echo esc_html($data->description); ?></textarea>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="date">Date</label>
                            <input type="date" name="date" id="date" class="form-control" value="<?php echo esc_html($data->date); ?>" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="time">Time</label>
                            <input type="time" name="time" id="time" class="form-control" value="<?php echo esc_html($data->time); ?>" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="lead_id">Lead ID</label>
                            <select name="lead_id" id="lead_id" class="form-control" required>
                                <?php foreach(get_all_leads() as $lead): ?>
                                    <option <?php if($lead->ID == $data->lead_id) echo 'selected'; ?> value="<?php echo esc_html($lead->ID); ?>"><?php echo esc_html($lead->name); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="type">Type</label>
                            <select name="type" id="type" class="form-control" required>
                                <option <?php if($data->type == 'call') echo 'selected'; ?> value="call">Call</option>
                                <option <?php if($data->type == 'sms') echo 'selected'; ?> value="sms">SMS</option>
                                <option <?php if($data->type == 'email') echo 'selected'; ?> value="email">Email</option>
                                <option <?php if($data->type == 'meet') echo 'selected'; ?> value="meet">Google Meet</option>
                                <option <?php if($data->type == 'zoom') echo 'selected'; ?> value="zoom">Zoom Meeting</option>
                                <option <?php if($data->type == 'webinar') echo 'selected'; ?> value="webinar">Webinar</option>
                                <option <?php if($data->type == 'skype') echo 'selected'; ?> value="skype">Skype</option>
                                <option <?php if($data->type == 'meeting') echo 'selected'; ?> value="meeting">Meeting</option>
                                <option <?php if($data->type == 'visit') echo 'selected'; ?> value="visit">Visit</option>
                                <option <?php if($data->type == 'other') echo 'selected'; ?> value="other">Other</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control" required>
                                <option <?php if($data->status == 'pending') echo 'selected'; ?> value="pending">Pending</option>
                                <option <?php if($data->status == 'completed') echo 'selected'; ?> value="completed">Completed</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="business_id">Business ID</label>
                            <select name="business_id" id="business_id" class="form-control" required>
                                <?php foreach(get_all_businesses() as $business): ?>
                                    <option <?php if($business->ID == $data->business_id) echo 'selected'; ?> value="<?php echo esc_html($business->ID); ?>"><?php echo esc_html($business->name); ?></option>
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