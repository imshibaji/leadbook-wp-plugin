<?php
get_leadbook_header($title, $actions);
list_header('All Transections', 'transections');
?>
<div class="container-fluid">
    <div class="card" style="padding: 0; max-width: 100%;">
        <div class="card-body" style="min-height:550px">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">ID</th>
                            <th scope="col">Date</th>
                            <th scope="col">Transection Description</th>
                            <th scope="col">Credit Amount</th>
                            <th scope="col">Debit Amount</th>

                        </tr>
                    </thead>
                    <tbody style="max-height: 500px; overflow-y: scroll">
                        <?php foreach (get_all_transections() as $transection): ?>
                            <tr>
                                <td class="text-center"><?php echo esc_html($transection->ID); ?></td>
                                <td class="text-center"><?php echo esc_html(date('d-m-Y', strtotime($transection->created_at))); ?></td>
                                <td><?php echo esc_html($transection->description); ?></td>
                                <td class="text-end"><?php if ($transection->type == 'credit') echo esc_html($transection->amount); ?></td>
                                <td class="text-end"><?php if ($transection->type == 'debit') echo esc_html($transection->amount); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3" class="text-end">Total Amount</th>
                            <th scope="col" class="text-end"><?php echo esc_html(get_total_credit_amount()); ?></th>
                            <th scope="col" class="text-end"><?php echo esc_html(get_total_debit_amount()); ?></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>