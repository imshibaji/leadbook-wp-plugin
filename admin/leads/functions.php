<?php
require_once LEADBOOK_MODELS . 'LeadsDB.php';

function get_all_leads() {
    $leadsDb = new Leadbook_LeadsDB();
    $leads = $leadsDb->getAll();
    return $leads;
}

function get_lead($id) {
    if(isset($_GET['id'])) {
        $leadsDb = new Leadbook_LeadsDB();
        $lead = $leadsDb->get($id);
    }else{
        leadbook_redirect('leads', 'list', 'Invalid Lead ID', 'error');
    }
    return $lead;
}

function add_lead($datas) {
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
            'source' => $datas['source'],
            'status' => $datas['status'],
            'business_id' => $datas['business_id'],
        ];
        $leads = new Leadbook_LeadsDB();
        $leads->insert($data);
        leadbook_redirect('leads', 'list', 'Lead Added Successfully', 'success');
    }
}

function update_lead($datas) {
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
            'source' => $datas['source'],
            'status' => $datas['status'],
            'business_id' => $datas['business_id'],
        ];
        $leads = new Leadbook_LeadsDB();
        $leads->update($datas['id'], $data);
        leadbook_redirect('leads', 'list', 'Lead Updated Successfully', 'success');
    }
}

function delete_lead($id) {
    $leads = new Leadbook_LeadsDB();
    $leads->delete($id);
    leadbook_redirect('leads', 'list', 'Lead Deleted Successfully', 'success');
}