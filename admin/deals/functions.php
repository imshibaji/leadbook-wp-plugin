<?php
require_once LEADBOOK_MODELS . 'DealsDB.php';

function ddjs($description)
{
    $datas = json_decode(stripslashes($description), true);
    return $datas;
}
function ddjsc($description)
{
    // json array to php array
    $datas = json_decode(stripcslashes(str_replace("'", '"', $description)));
    $datas = json_decode($datas);
    return count($datas) . ' Items Included';
}

function get_all_deals()
{
    $deals = new Models\DealsDB();
    if (isset($_GET['lead_id']) && $_GET['lead_id'] != '') {
        $lead_id = sanitize_text_field(wp_unslash($_GET['lead_id']));
        $deals = $deals->getByLead($lead_id);
        return $deals;
    }
    if (isset($_GET['business_id']) && $_GET['business_id'] != '') {
        $business_id = sanitize_text_field(wp_unslash($_GET['business_id']));
        $deals = $deals->getByBusiness($business_id);
        return $deals;
    }
    return $deals->getAll();
}

function add_deal($data)
{
    if (isset($_POST['action']) && $_POST['action'] == 'add') {
        unset($data['action']);
        $deals = new Models\DealsDB();
        $data['description'] = json_encode($data['description']);
        $did = $deals->insert($data);
        $data['deal_id'] = $did;
        $tid = add_transection_by_deal($data);
        leadbook_redirect('deals', 'list', 'Deal Added Successfully, Transection Added:' . $tid, 'success');
    }
}

function update_deal($data)
{
    if (isset($_POST['action']) && $_POST['action'] == 'edit') {
        unset($data['action']);
        $deal = new Models\DealsDB();
        $data['description'] = json_encode($data['description']);
        $updated = $deal->update($data['id'], $data);
        if ($updated) {
            $tid = update_transection_by_deal($data['id'], $data);
        }
        leadbook_redirect('deals', 'list', 'Deal Updated Successfully, Transection Updated: ' . $tid, 'success');
    }
}

function get_deal($id)
{
    $deals = new Models\DealsDB();
    return $deals->get($id);
}

function delete_deal($id)
{
    $deals = new Models\DealsDB();
    $deals->delete($id);
    leadbook_redirect('deals', 'list', 'Deal Deleted Successfully', 'success');
}

function get_business_by_deal_id($id){
    foreach(get_all_businesses() as $business){
        if($business->ID == $id) $business;
    }
    return $business;
}

function get_lead_by_deal_id($id){
    foreach(get_all_leads() as $lead){
        if($lead->ID == $id) $lead;
    }
    return $lead;
}

function deal_payment_status($deal){
    if ($deal->balance == 0){
        return 'Paid Completely';
     }else if($deal->status =='paid'){
        return 'Partly Paid';
     }else{
        return 'Pending Payment'; 
    } 
}

function deal_list_for_dashboard()
{
    ob_start();
?>
    <div class="container-fluid">
        <table class="table table-striped">
            <thead>
                <tr class="text-center">
                    <th>CustName</th>
                    <th>DealName</th>
                    <th>Description</th>
                    <th>PayblAmt</th>
                    <th>Balance</th>
                    <th>PaidAmt</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach (get_all_deals() as $data): ?>
                    <tr class="text-center">
                        <td><?php echo esc_html(get_lead($data->lead_id)->name); ?></td>
                        <td>
                            <a style="color:black" href="<?php echo esc_html(leadbook_navigate('deals', ['action' => 'view', 'id' => $data->ID])); ?>">
                                <?php echo esc_html($data->name); ?>
                            </a>
                        </td>
                        <td><?php echo esc_html(ddjsc($data->description)); ?></td>
                        <td><?php echo esc_html($data->advance + $data->balance); ?></td>
                        <td><?php echo esc_html($data->balance); ?></td>
                        <td><?php echo esc_html($data->total); ?></td>
                        <td>
                            <a href="<?php echo esc_html(leadbook_navigate('deals', ['action' => 'edit', 'id' => $data->ID])); ?>">Edit</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php
    return ob_get_clean();
}
