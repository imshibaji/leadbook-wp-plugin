<?php
get_leadbook_header($title, $actions);
list_header('All Deals', 'deals');
?>
<div class="container-fluid">
    <div class="card" style="padding: 0; max-width: 100%;">
        <div class="card-body" style="min-height:550px">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr class="text-center">
                            <th>name</th>
                            <th>Description</th>
                            <th>Code</th>
                            <th>PayblAmt</th>
                            <th>Discount</th>
                            <th>Advance</th>
                            <th>Balance</th>
                            <th>DueDate</th>
                            <th>PaidAmt</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach (get_all_deals() as $data): ?>
                            <tr class="text-center">
                                <td><?php echo esc_html($data->name); ?></td>
                                <td class="text-start"><?php echo esc_html($data->description); ?></td>
                                <td><?php echo esc_html($data->currency_code); ?></td>
                                <td><?php echo esc_html($data->advance + $data->balance); ?></td>
                                <td><?php echo esc_html($data->discount); ?></td>
                                <td><?php echo esc_html($data->advance); ?></td>
                                <td><?php echo esc_html($data->balance); ?></td>
                                <td><?php echo esc_html(date('d-m-Y', strtotime($data->due_date))); ?></td>
                                <td><?php echo esc_html($data->total); ?></td>
                                <td><?php echo esc_html(ucfirst($data->status)); ?></td>
                                <td>
                                <a href="<?php echo esc_html(leadbook_navigate('deals', ['action' => 'view', 'id' => $data->ID])); ?>">View</a>
                                    <a href="<?php echo esc_html(leadbook_navigate('deals', ['action' => 'edit', 'id' => $data->ID])); ?>">Edit</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>