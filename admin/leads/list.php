<?php 
get_leadbook_header($title, $actions);
list_header('All Leads', 'leads'); 
?>
<div class="container-fluid">
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Purpose</th>
            <th>Name</th>
            <th>Email</th>
            <th>Mobile</th>
            <th>Business Name</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach(apply_filters('leadbook_leads_list_data', get_all_leads()) as $data):?>
            <tr>
                <td><?php echo esc_html($data->ID); ?></td>
                <td><?php echo esc_html($data->purpose); ?></td>
                <td><?php echo esc_html($data->name); ?></td>
                <td><?php echo esc_html($data->email); ?></td>
                <td><?php echo esc_html($data->mobile); ?></td>
                <td><?php echo esc_html(get_business_info($data->ID)->name); ?></td>
                <td>
                    <a href="<?php echo esc_html(leadbook_navigate('leads', ['action' => 'edit', 'id' => esc_html($data->ID)])); ?>">Edit</a>
                    <a href="<?php echo esc_html(leadbook_navigate('leads', ['action' => 'delete', 'id'=> esc_html($data->ID)])); ?>">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>