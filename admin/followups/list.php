<?php 
get_leadbook_header($title, $actions);
list_header('All Followups'); 
?>
<div class="container-fluid">
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>title</th>
            <th>Description</th>
            <th>type</th>
            <th>status</th>
            <th>Reminder Date</th>
            <th>Lead ID</th>
            <th>Business ID</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach(get_all_followups() as $data): ?>
            <tr>
                <td><?php echo esc_html($data->ID); ?></td>
                <td><?php echo esc_html($data->title); ?></td>
                <td><?php echo esc_html($data->description); ?></td>
                <td><?php echo esc_html($data->type); ?></td>
                <td><?php echo esc_html($data->status); ?></td>
                <td><?php echo esc_html($data->next_reminder); ?></td>
                <td><?php echo esc_html(get_lead_info($data->lead_id)->name ?? ''); ?></td>
                <td><?php echo esc_html(get_business_info($data->business_id)->name ?? ''); ?></td>
                <td>
                    <a href="<?php echo esc_html(leadbook_navigate('followups', ['action' => 'edit', 'id' => $data->ID])); ?>">Edit</a>
                    <a href="<?php echo esc_html(leadbook_navigate('followups', ['action' => 'delete', 'id'=> $data->ID])); ?>">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>