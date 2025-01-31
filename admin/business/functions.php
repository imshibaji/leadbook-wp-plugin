<?php
require_once LEADBOOK_MODELS . 'BusinessesDB.php';

use Models\BusinessesDB;

function get_all_businesses()
{
    $businessesDb = new BusinessesDB();
    $businesses = $businessesDb->getAll();
    return $businesses;
}

function get_business($id)
{
    $businessesDb = new BusinessesDB();
    $business = $businessesDb->get($id);
    return $business;
}

function add_business($datas)
{
    if (isset($datas['action']) && $datas['action'] == 'add') {
        $data = [
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
            'website' => $datas['website'],
            'description' => $datas['status'],
            'logo' => $datas['logo'],
            'bank_name' => $datas['bank_name'],
            'account_number' => $datas['account_number'],
            'ifsc_code' => $datas['ifsc_code'],
            'gst_number' => $datas['gst_number'],
            'pan_number' => $datas['pan_number'],
            'aadhar_number' => $datas['aadhar_number'],
            'signature' => $datas['signature'],
            'created_by' => $datas['created_by'],
            'managed_by' => $datas['managed_by'],
        ];
        $businesses = new BusinessesDB();
        $businesses->insert($data);
        leadbook_redirect('businesses', 'list', 'Business Added Successfully', 'success');
    }
}

function update_business($datas)
{
    if (isset($datas['action']) && $datas['action'] == 'edit') {
        $data = [
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
            'website' => $datas['website'],
            'description' => $datas['description'],
            'logo' => $datas['logo'] ?? '',
            'bank_name' => $datas['bank_name'],
            'account_number' => $datas['account_number'],
            'ifsc_code' => $datas['ifsc_code'],
            'gst_number' => $datas['gst_number'],
            'pan_number' => $datas['pan_number'],
            'aadhar_number' => $datas['aadhar_number'],
            'signature' => $datas['signature'] ?? '',
            'created_by' => $datas['created_by'],
            'managed_by' => $datas['managed_by'],
        ];
        $businesses = new BusinessesDB();
        $businesses->update($datas['id'], $data);
        leadbook_redirect('businesses', 'list', 'Business Updated Successfully', 'success');
    }
}

function delete_business($datas)
{
    if (isset($datas['action']) && $datas['action'] == 'delete') {
        $businesses = new BusinessesDB();
        $businesses->delete($datas['id']);
        leadbook_redirect('businesses', 'list', 'Business Deleted Successfully', 'success');
    }
}

function get_business_contact_info($business){
    $txt = $business->website ? '(W): ' . esc_html($business->website) . ', ' : '';
    $txt .= $business->mobile ? '(M): ' . esc_html($business->mobile) . ', ' : '';
    $txt .= $business->email ? '(E): ' . esc_html($business->email) . '. ' : '';
    return $txt;
}

function get_business_complete_address($business){
    $txt = $business->address ? esc_html($business->address) . ', ' : '';
    $txt .= $business->city ? esc_html($business->city) . ', ' : '';
    $txt .= $business->state ? esc_html($business->state) . ', ' : '';
    $txt .= $business->country ? esc_html($business->country) . ', ' : '';
    $txt .= $business->pincode ? 'Pincode: ' . esc_html($business->pincode) . '. ' : '';
    return $txt;
}

function get_business_bank_info($business){
    $txt = $business->bank_name ? '<b>Bank Name:</b> '.esc_html($business->bank_name) . '<br>' : '';
    $txt .= $business->ifsc_code ? '<b>IFSC Code:</b> '.esc_html($business->ifsc_code) . '<br>' : '';
    $txt .= $business->account_number ? '<b>A/C Number:</b> ' .esc_html($business->account_number) . '<br>' : '';
    $txt .= $business->gst_number ? '<b>GST Number:</b> ' .esc_html($business->gst_number) . '<br>' : '';
    $txt .= $business->pan_number ? '<b>PAN / TAN Number:</b> ' . esc_html($business->pan_number) . '<br>' : '';
    $txt .= $business->aadhar_number ? '<b>Aadhar Number:</b> ' . esc_html($business->aadhar_number) . '<br>' : '';
    return $txt;
}

function business_list_for_dashboard()
{
    ob_start();
?>
    <div class="container-fluid">
        <table class="table table-striped">
            <thead>
                <tr class="text-center">
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach (get_all_businesses() as $data): ?>
                    <tr class="text-center">
                        <td><?php echo esc_html($data->name); ?></td>
                        <td>
                            <a href="<?php echo esc_html(leadbook_navigate('businesses', ['action' => 'edit', 'id' => $data->ID])); ?>">Edit</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php
    return ob_get_clean();
}
