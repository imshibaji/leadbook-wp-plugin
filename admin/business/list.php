<?php
get_leadbook_header($title, $actions);
list_header('All Busineses');
?>
<div class="container-fluid">
    <div class="card" style="padding: 0; max-width: 100%;">
        <div class="card-body" style="min-height:550px">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr class="text-center">
                            <th>Name</th>
                            <th>Address</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody style="max-height: 500px; overflow-y: scroll">
                        <?php foreach (get_all_businesses() as $data): ?>
                            <tr class="text-center">
                                <td><?php echo esc_html($data->name); ?></td>
                                <td class="text-start">
                                    <?php echo esc_html($data->address); ?>,
                                    <?php echo esc_html($data->city); ?>,
                                    <?php echo esc_html($data->state); ?>,
                                    <?php echo esc_html($data->pincode); ?>,
                                    <?php echo esc_html($data->country); ?>
                                </td>

                                <td><?php echo esc_html($data->email); ?></td>
                                <td><?php echo esc_html($data->mobile); ?></td>
                                <td>
                                    <a href="<?php echo esc_html(leadbook_navigate('businesses', ['action' => 'view', 'id' => $data->ID])); ?>">View</a>
                                    <a href="<?php echo esc_html(leadbook_navigate('businesses', ['action' => 'edit', 'id' => $data->ID])); ?>">Edit</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>