<h4>Leads list</h4>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Mobile</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach(apply_filters('leadbook_leads_list_data', get_all_leads()) as $data): ?>
            <tr>
                <td><?php echo esc_html($data->id); ?></td>
                <td><?php echo esc_html($data->name); ?></td>
                <td><?php echo esc_html($data->email); ?></td>
                <td><?php echo esc_html($data->mobile); ?></td>
                <td>
                    <a href="<?php echo esc_html(leadbook_navigate('leads', ['action' => 'edit', 'id' => esc_html($data->id)])); ?>">Edit</a>
                    <a href="<?php echo esc_html(leadbook_navigate('leads', ['action' => 'delete', 'id'=> esc_html($data->id)])); ?>">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>