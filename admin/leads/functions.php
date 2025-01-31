<?php
require_once LEADBOOK_MODELS . 'BusinessesDB.php';
require_once LEADBOOK_MODELS . 'LeadsDB.php';
require_once LEADBOOK_MODELS . 'DealsDB.php';

use Models\BusinessesDB;
use Models\DealsDB;
use Models\FollowupsDB;
use Models\LeadsDB;

function get_all_leads()
{
    $leadsDb = new LeadsDB();
    $leads = $leadsDb->getAll();
    if (isset($_GET['business_id']) && $_GET['business_id'] != '') {
        $business_id = sanitize_text_field(wp_unslash($_GET['business_id']));
        $leads = $leadsDb->getByBusiness($business_id);
        return $leads;
    }
    return $leads;
}

function get_business_info($business_id)
{
    $businesses = new BusinessesDB();
    $business = $businesses->get($business_id);
    return $business;
}

function get_lead($id)
{
    $leadsDb = new LeadsDB();
    $lead = $leadsDb->get($id);
    return $lead;
}

function add_lead($data)
{
    if (isset($data['action']) && $data['action'] == 'add') {
        unset($data['action']);
        $leads = new LeadsDB();
        $leads->insert($data);
        leadbook_redirect('leads', 'list', 'Lead Added Successfully', 'success');
    }
}

function update_lead($data)
{
    if (isset($data['action']) && $data['action'] == 'edit') {
        unset($data['action']);
        $leads = new LeadsDB();
        $leads->update($data['id'], $data);
        leadbook_redirect('leads', 'list', 'Lead Updated Successfully', 'success');
    }
}
function delete_lead($id)
{
    $leads = new LeadsDB();
    $leads->delete($id);
    leadbook_redirect('leads', 'list', 'Lead Deleted Successfully', 'success');
}

function get_lead_complete_address($lead){
    $txt = $lead->address ? esc_html($lead->address) . ', ' : '';
    $txt .= $lead->city ? esc_html($lead->city) . ', ' : '';
    $txt .= $lead->state ? esc_html($lead->state) . ', ' : '';
    $txt .= $lead->country ? esc_html($lead->country) . ', ' : '';
    $txt .= $lead->pincode ? 'Pincode: '.esc_html($lead->pincode) . '.' : '';
    return $txt;
}

function get_deals_by_lead_id($id){
    $deal = new DealsDB();
    $deals = [];
    foreach ($deal->getAll() as $d) {
        if($d->lead_id == $id) array_push($deals, $d);
    }
    return $deals;
}

function get_followups_by_lead_id($id){
    $follow = new FollowupsDB();
    $follows = [];
    foreach ($follow->getAll() as $f) {
        if($f->lead_id == $id) array_push($follows, $f);
    }
    return $follows;
}


function lead_list_for_dashboard()
{
    ob_start();
?>
<div class="container-fluid">
<table class="table table-striped">
    <thead>
        <tr class="text-center">
            <th>Name</th>
            <th>Mobile</th>
            <th>Purpose</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach(apply_filters('leadbook_leads_list_data', get_all_leads()) as $data):?>
            <tr class="text-center">
                <td>
                    <a style="color:black" href="<?php echo esc_html(leadbook_navigate('leads', ['action' => 'view', 'id' => $data->ID])); ?>">
                        <?php echo esc_html($data->name); ?>
                    </a>
                </td>
                <td><?php echo esc_html($data->mobile); ?></td>
                <td><?php echo esc_html($data->purpose); ?></td>
                <td><?php echo esc_html($data->status); ?></td>
                <td>
                    <a href="<?php echo esc_html(leadbook_navigate('leads', ['action' => 'edit', 'id' => esc_html($data->ID)])); ?>">Edit</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>
<?php
    return ob_get_clean();
}