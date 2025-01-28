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
            'pan_image' => $datas['pan_image'],
            'aadhar_image' => $datas['aadhar_image'],
            'bank_image' => $datas['bank_image'],
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
            'pan_image' => $datas['pan_image'] ?? '',
            'aadhar_image' => $datas['aadhar_image'] ?? '',
            'bank_image' => $datas['bank_image'] ?? '',
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
