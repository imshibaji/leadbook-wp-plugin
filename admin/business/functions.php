<?php 
require_once LEADBOOK_MODELS . 'BusinessesDB.php';
use Models\BusinessesDB;

function get_all_businesses() {
    $businessesDb = new BusinessesDB();
    $businesses = $businessesDb->getAll();
    return $businesses;
}

function business_list_for_dashboard($contents) {
    $datas = (array) $contents;
    // resheaping the string
    $out = '<ul class="list-group list-group-flush">';
    $out .= implode(array_map(function($data) {
        return '<li class="list-group-item">' . $data->name ?? '' . '</li>';
    }, $datas));
    $out .= '</ul>';
    return $out;
}

function get_business($id) {
    if(isset($_GET['id'])) {
        $businessesDb = new BusinessesDB();
        $business = $businessesDb->get($id);
    }else{
        leadbook_redirect('businesses', 'list', 'Invalid Business ID', 'error');
    }
    return $business;
}

function add_business($datas) {
    if(isset($datas['action']) && $datas['action'] == 'add') {
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
            'bank_image' => $datas['bank_image']
        ];
        $businesses = new BusinessesDB();
        $businesses->insert($data);
        leadbook_redirect('businesses', 'list', 'Business Added Successfully', 'success');
    }
}

function update_business($datas) {
    if(isset($datas['action']) && $datas['action'] == 'edit') {
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
            'bank_image' => $datas['bank_image'] ?? ''
        ];
        $businesses = new BusinessesDB();
        $businesses->update($datas['id'], $data);
        leadbook_redirect('businesses', 'list', 'Business Updated Successfully', 'success');
    }
}

function delete_business($datas) {
    if(isset($datas['action']) && $datas['action'] == 'delete') {
        $businesses = new BusinessesDB();
        $businesses->delete($datas['id']);
        leadbook_redirect('businesses', 'list', 'Business Deleted Successfully', 'success');
    }
}
