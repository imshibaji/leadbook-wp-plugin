<h4>Business list</h4>
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
        <?php foreach(get_all_businesses() as $data): ?>
            <tr>
                <td><?php echo esc_html($data->id); ?></td>
                <td><?php echo esc_html($data->name); ?></td>
                <td><?php echo esc_html($data->email); ?></td>
                <td><?php echo esc_html($data->mobile); ?></td>
                <td>
                    <a href="<?php echo esc_html(leadbook_navigate('businesses', ['action' => 'edit', 'id' => $data->id])); ?>">Edit</a>
                    <a href="<?php echo esc_html(leadbook_navigate('businesses', ['action' => 'delete', 'id'=> $data->id])); ?>">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>