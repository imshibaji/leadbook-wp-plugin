<?php
require_once LEADBOOK_MODELS . 'BusinessesDB.php';
require_once LEADBOOK_MODELS . 'LeadsDB.php';

use Models\BusinessesDB;
use Models\LeadsDB;

function get_all_leads() {
    $leadsDb = new LeadsDB();
    $leads = $leadsDb->getAll();
    if(isset($_GET['business_id']) && $_GET['business_id'] != '') {
        $leads = $leadsDb->business();
        return $leads;
    }
    return $leads;
}

function lead_list_for_dashboard($contents) {
    $datas = (array) $contents;
    // resheaping the string
    $out = '<ul class="list-group list-group-flush">';
    $out .= implode(array_map(function($data) {
        return '<li class="list-group-item">' . $data->name ?? '' . '</li>';
    }, $datas));
    $out .= '</ul>';
    return $out;
}

function get_business_info($business_id) {
    $businesses = new BusinessesDB();
    $business = $businesses->get($business_id);
    return $business;
}

function get_lead($id) {
    if(isset($_GET['id'])) {
        $leadsDb = new LeadsDB();
        $lead = $leadsDb->get($id);
    }else{
        leadbook_redirect('leads', 'list', 'Invalid Lead ID', 'error');
    }
    return $lead;
}

function add_lead($datas) {
    if(isset($datas['action']) && $datas['action'] == 'add') {
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
        ];
        $leads = new LeadsDB();
        $leads->insert($data);
        leadbook_redirect('leads', 'list', 'Lead Added Successfully', 'success');
    }
}

function update_lead($datas) {
    if(isset($datas['action']) && $datas['action'] == 'edit') {
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
        ];
        $leads = new LeadsDB();
        $leads->update($datas['id'], $data);
        leadbook_redirect('leads', 'list', 'Lead Updated Successfully', 'success');
    }
}

function delete_lead($id) {
    $leads = new LeadsDB();
    $leads->delete($id);
    leadbook_redirect('leads', 'list', 'Lead Deleted Successfully', 'success');
}