<?php
get_leadbook_header($title, $actions);
list_header('View Lead');
$id = get_current_id();
?>
<div class="container-fluid">
    <div class="card" style="padding: 0; max-width: 100%;">
        <div class="card-body" style="min-height:550px">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <tbody class="text-start">
                        <tr>
                            <th>Name</th>
                            <td class="col-3"><?php echo esc_html(get_lead($id)->name); ?></td>
                            <th>Email</th>
                            <td class="col-3"><?php echo esc_html(get_lead($id)->email); ?></td>
                            <th>Mobile</th>
                            <td class="col-3"><?php echo esc_html(get_lead($id)->mobile); ?></td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td><?php echo get_lead_complete_address(get_lead($id)); ?></td>
                            <th>Enquiry/Purpose</th>
                            <td><?php echo esc_html(get_lead($id)->purpose); ?></td>
                            <th>ForBusiness</th>
                            <td><?php echo esc_html(get_business_info(get_lead($id)->business_id)->name); ?></td>
                        </tr>
                        <tr>
                            <th>Created At</th>
                            <td><?php echo esc_html(date('d-m-Y', strtotime(get_lead($id)->created_at))); ?></td>
                            <th>Created By</th>
                            <td><?php echo esc_html(get_user(get_lead($id)->created_by)->first_name) . ' ' . esc_html(get_user(get_lead($id)->created_by)->last_name); ?></td>
                            <th>Managed By</th>
                            <td><?php echo esc_html(get_user(get_lead($id)->managed_by)->first_name) . ' ' . esc_html(get_user(get_lead($id)->managed_by)->last_name); ?></td>
                        </tr>
                    </tbody>
                </table>
                <div class="row gap-3" style="margin-top: 20px; padding: 0;">
                    <div class="col-md" style="padding: 0;">
                        <table class="table table-striped table-bordered">
                            <tbody class="text-center">
                                <tr>
                                    <th colspan="7">Deals Information</th>
                                </tr>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>PaidAmt</th>
                                    <th>Status</th>
                                    <th>CreatedAt</th>
                                    <th>Actions</th>
                                </tr>
                                <?php foreach (get_deals_by_lead_id($id) as $deal): ?>
                                    <tr>
                                        <td><?php echo esc_html($deal->ID); ?></td>
                                        <td><?php echo esc_html($deal->name) ?></td>
                                        <td><?php echo esc_html(ddjsc($deal->description)) ?></td>
                                        <td><?php echo esc_html($deal->total) ?></td>
                                        <td><?php echo esc_html(deal_payment_status($deal)) ?></td>
                                        <td><?php echo esc_html(date('d-m-Y', strtotime($deal->created_at))) ?></td>
                                        <td>
                                            <a href="<?php echo esc_html(leadbook_navigate('deals', ['action' => 'view', 'id' => $deal->ID])); ?>">View</a>
                                            <a href="<?php echo esc_html(leadbook_navigate('deals', ['action' => 'edit', 'id' => $deal->ID])); ?>">Edit</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md" style="padding: 0;">
                        <table class="table table-striped table-bordered">
                            <tbody class="text-center">
                                <tr>
                                    <th colspan="6">Followups Information</th>
                                </tr>
                                <tr>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Type</th>
                                    <th>status</th>
                                    <th>Reminder</th>
                                    <th>Actions</th>
                                </tr>
                                <?php foreach (get_followups_by_lead_id($id) as $data): ?>
                                    <tr class="text-center">
                                        <td><?php echo esc_html($data->title); ?></td>
                                        <td class="text-start"><?php echo esc_html($data->description); ?></td>
                                        <td><?php echo esc_html($data->type); ?></td>
                                        <td><?php echo esc_html($data->status); ?></td>
                                        <td><?php echo esc_html(date('d-m-Y h:i A',strtotime($data->next_reminder))); ?></td>
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
    </div>
    <?php get_leadbook_footer(); ?>