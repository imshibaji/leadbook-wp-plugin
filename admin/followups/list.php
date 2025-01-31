<?php
get_leadbook_header($title, $actions);
list_header('All Followups / Notifications', 'followups');
?>
<div class="container-fluid">
    <div class="card" style="padding: 0; max-width: 100%;">
        <div class="card-body" style="min-height:550px">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr class="text-center">
                            <th>Title</th>
                            <th>Description</th>
                            <th>type</th>
                            <th>status</th>
                            <th>Reminder DateTime</th>
                            <th>Lead ID</th>
                            <th>Business ID</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody style="max-height: 500px; overflow-y: scroll">
                        <?php foreach (get_all_followups() as $data): ?>
                            <tr class="text-center">
                                <td><?php echo esc_html($data->title); ?></td>
                                <td><?php echo esc_html($data->description); ?></td>
                                <td><?php echo esc_html($data->type); ?></td>
                                <td><?php echo esc_html($data->status); ?></td>
                                <td><?php echo esc_html($data->next_reminder); ?></td>
                                <td><?php echo esc_html(get_lead_info($data->lead_id)->name ?? ''); ?></td>
                                <td><?php echo esc_html(get_business_info($data->business_id)->name ?? ''); ?></td>
                                <td>
                                    <a href="<?php echo esc_html(leadbook_navigate('followups', ['action' => 'edit', 'id' => $data->ID])); ?>">Edit</a>
                                    <a href="<?php echo esc_html(leadbook_navigate('followups', ['action' => 'delete', 'id' => $data->ID])); ?>">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>