<?php 
get_leadbook_header($title, $actions);
list_header('All Busineses'); 
?>
<div class="container-fluid">
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Address</th>
            <th>Email</th>
            <th>Mobile</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach(get_all_businesses() as $data): ?>
            <tr>
                <td><?php echo esc_html($data->ID); ?></td>
                <td><?php echo esc_html($data->name); ?></td>
                <td>
                    <?php echo esc_html($data->address); ?>,
                    <?php echo esc_html($data->city); ?>,
                    <?php echo esc_html($data->state); ?>,
                    <?php echo esc_html($data->pincode); ?>,
                    <?php echo esc_html($data->country); ?>
                </td>
                
                <td><?php echo esc_html($data->email); ?></td>
                <td><?php echo esc_html($data->mobile); ?></td>
                <td>
                    <a href="<?php echo esc_html(leadbook_navigate('businesses', ['action' => 'edit', 'id' => $data->ID])); ?>">Edit</a>
                    <a href="<?php echo esc_html(leadbook_navigate('businesses', ['action' => 'delete', 'id'=> $data->ID])); ?>">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>