<?php
get_leadbook_header($title, $actions);
list_header('All Leads', 'leads');
?>
<div class="container-fluid">
    <div class="card" style="padding: 0; max-width: 100%;">
        <div class="card-body" style="min-height:550px">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr class="text-center">
                            <th>Purpose</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Business Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach (apply_filters('leadbook_leads_list_data', get_all_leads()) as $data): ?>
                            <tr class="text-center">
                                <td><?php echo esc_html($data->purpose); ?></td>
                                <td><?php echo esc_html($data->name); ?></td>
                                <td><?php echo esc_html($data->email); ?></td>
                                <td><?php echo esc_html($data->mobile); ?></td>
                                <td><?php echo esc_html(get_business_info($data->ID)->name); ?></td>
                                <td>
                                    <a href="<?php echo esc_html(leadbook_navigate('leads', ['action' => 'view', 'id' => esc_html($data->ID)])); ?>">View</a>
                                    <a href="<?php echo esc_html(leadbook_navigate('leads', ['action' => 'edit', 'id' => esc_html($data->ID)])); ?>">Edit</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>