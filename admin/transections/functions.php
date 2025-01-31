<?php
require_once LEADBOOK_MODELS . 'TransectionsDB.php';

use Models\TransectionsDB;

function get_all_transections()
{
    if (isset($_GET['business_id']) && $_GET['business_id']) {
        return (new TransectionsDB())->getByBusiness($_GET['business_id']);
    }
    return (new TransectionsDB())->getAll();
}

function get_transection($id)
{
    return (new TransectionsDB())->get($id);
}

function delete_transection($id)
{
    return (new TransectionsDB())->delete($id);
}

function update_transection($id, $data)
{
    return (new TransectionsDB())->update($id, $data);
}

function add_transection($data)
{
    if (isset($data['action']) && $data['action'] == 'add') {
        unset($data['action']);
        if (isset($data['description']) && isset($data['amount'])) {
            if (isset($data['business_id']) && $data['business_id']) {
                $data['description'] .= ' - Business: ' . get_business($data['business_id'])->name;
                $data['business_id'] = sanitize_text_field(wp_unslash($data['business_id']));
            }
            (new TransectionsDB())->insert($data);
            leadbook_redirect('transections', 'list', 'Transection Added Successfully', 'success');
        } else {
            leadbook_redirect('transections', 'add', 'Transection Failed', 'error');
        }
    }
}

function check_transections($data){
    $tdata = [];
    if (isset($data['deal_id']) || isset($data['lead_id']) || isset($data['business_id'])) {
        $tdata['description'] = 'Transection Updated for ';
        // $data['deal_id'] = $deal_id;
        if (isset($data['deal_id']) && $data['deal_id']) {
            $deal = get_deal($data['deal_id']);
            if ($deal) {
                $tdata['description'] .= 'Deal: ' . $deal->ID . '. ' . $deal->name . ', Description: ' . ddjsc($deal->description);
                $tdata['deal_id'] = sanitize_text_field(wp_unslash($data['deal_id'] ?? $deal->ID));
                $tdata['amount'] = sanitize_text_field(wp_unslash($data['total'] ?? $deal->total));
                $tdata['type'] = 'credit';
            }
        }
        if (isset($data['lead_id']) && $data['lead_id']) {
            $lead = get_lead($data['lead_id']);
            if ($lead) {
                $tdata['description'] .= ' - Lead: ' . $lead->name;
                $tdata['lead_id'] = sanitize_text_field(wp_unslash($data['lead_id'] ?? $lead->ID));
            }
        }
        if (isset($data['business_id']) && $data['business_id']) {
            $business = get_business($data['business_id']);
            $tdata['description'] .= ' - Business: ' . $business->name;
            $tdata['business_id'] = sanitize_text_field(wp_unslash($data['business_id'] ?? $business->ID));
        }
    }
    return [$data, $tdata];
}

function add_transection_by_deal($data)
{
    if (isset($data['advance']) && $data['advance'] > 0){
        [$data, $tdata]= check_transections($data);
        return (new TransectionsDB())->insert($tdata);
    }
}

function update_transection_by_deal($deal_id, $data)
{
    if (isset($data['advance']) && $data['advance'] > 0) {
        $data["deal_id"] = $deal_id;
        [$data, $tdata] = check_transections($data);
        if ((new TransectionsDB())->checkDeal($data['deal_id'] ?? $deal_id)) {
            return (new TransectionsDB())->updateByDeal($data['deal_id'] ?? $deal_id, $tdata);
        }
        return (new TransectionsDB())->insert($tdata);
    }
}

function delete_transection_by_deal($deal_id)
{
    return (new TransectionsDB())->deleteByDealId($deal_id);
}

function get_total_credit_amount()
{
    if (isset($_GET['business_id']) && $_GET['business_id'] != '') {
        return (new TransectionsDB())->getCreditedAmount($_GET['business_id']);
    } else {
        return (new TransectionsDB())->getCreditedAmount();
    }
}

function get_total_debit_amount()
{
    if (isset($_GET['business_id']) && $_GET['business_id'] != '') {
        return (new TransectionsDB())->getDebitedAmount($_GET['business_id']);
    } else {
        return (new TransectionsDB())->getDebitedAmount();
    }
}

function transection_list_for_dashboard()
{
    ob_start();
?>
    <div class="container-fluid">
        <table class="table table-striped">
            <thead>
                <tr class="text-center">
                    <th>Date</th>
                    <th>Description</th>
                    <th>Type</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach (get_all_transections() as $data): ?>
                    <tr class="text-center">
                        <td><?php echo esc_html(date('d/m/Y', strtotime($data->created_at))); ?></td>
                        <td><?php echo esc_html($data->description); ?></td>
                        <td><?php echo esc_html($data->type); ?></td>
                        <td><?php echo esc_html($data->amount); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php
    return ob_get_clean();
}
