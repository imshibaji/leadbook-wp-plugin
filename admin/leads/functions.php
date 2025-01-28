<?php
require_once LEADBOOK_MODELS . 'BusinessesDB.php';
require_once LEADBOOK_MODELS . 'LeadsDB.php';

use Models\BusinessesDB;
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

function add_lead($datas)
{
    if (isset($datas['action']) && $datas['action'] == 'add') {
        $data = [
            'purpose' => $datas['purpose'],
            'name' => $datas['name'],
            'email' => $datas['email'],
            'mobile' => $datas['mobile'],
            'whatsapp' => $datas['whatsapp'],
            'alt_mobile' => $datas['alt_mobile'],
            'address' => $datas['address'],
            'city' => $datas['city'],
            'state' => $datas['state'],
            'country' => $datas['country'],
            'pincode' => $datas['pincode'],
            'source' => $datas['source'],
            'status' => $datas['status'],
            'business_id' => $datas['business_id'],
            'created_by' => $datas['created_by'],
            'managed_by' => $datas['managed_by'],
        ];
        $leads = new LeadsDB();
        $leads->insert($data);
        leadbook_redirect('leads', 'list', 'Lead Added Successfully', 'success');
    }
}

function update_lead($datas)
{
    if (isset($datas['action']) && $datas['action'] == 'edit') {
        $data = [
            'purpose' => $datas['purpose'],
            'name' => $datas['name'],
            'email' => $datas['email'],
            'mobile' => $datas['mobile'],
            'whatsapp' => $datas['whatsapp'],
            'alt_mobile' => $datas['alt_mobile'],
            'address' => $datas['address'],
            'city' => $datas['city'],
            'state' => $datas['state'],
            'country' => $datas['country'],
            'pincode' => $datas['pincode'],
            'source' => $datas['source'],
            'status' => $datas['status'],
            'business_id' => $datas['business_id'],
            'created_by' => $datas['created_by'],
            'managed_by' => $datas['managed_by'],
        ];
        $leads = new LeadsDB();
        $leads->update($datas['id'], $data);
        leadbook_redirect('leads', 'list', 'Lead Updated Successfully', 'success');
    }
}

function delete_lead($id)
{
    $leads = new LeadsDB();
    $leads->delete($id);
    leadbook_redirect('leads', 'list', 'Lead Deleted Successfully', 'success');
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
            <th>Email</th>
            <th>Purpose</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach(apply_filters('leadbook_leads_list_data', get_all_leads()) as $data):?>
            <tr class="text-center">
                <td><?php echo esc_html($data->name); ?></td>
                <td><?php echo esc_html($data->mobile); ?></td>
                <td><?php echo esc_html($data->email); ?></td>
                <td><?php echo esc_html($data->purpose); ?></td>
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