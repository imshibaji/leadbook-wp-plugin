<?php
require_once LEADBOOK_MODELS . 'BusinessesDB.php';
require_once LEADBOOK_MODELS . 'LeadsDB.php';

use Models\BusinessesDB;
use Models\LeadsDB;

class Leads{
    static function all_leads() {
        $leadsDb = new LeadsDB();
        $leads = $leadsDb->getAll();
        if(isset($_GET['business_id']) && $_GET['business_id'] != '') {
            $leads = $leadsDb->business();
            return $leads;
        }
        return $leads;
    }

    static function all_businesses() {
        $businessesDb = new BusinessesDB();
        $businesses = $businessesDb->getAll();
        return $businesses;
    }

    static function business_info($business_id) {
        $businesses = new BusinessesDB();
        $business = $businesses->get($business_id);
        return $business;
    }
    
    static function get_lead($id) {
        if(isset($_GET['id'])) {
            $leadsDb = new LeadsDB();
            $lead = $leadsDb->get($id);
        }else{
            leadbook_redirect('leads', 'list', 'Invalid Lead ID', 'error');
        }
        return $lead;
    }
    
    static function add_lead($datas) {
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
    
    static function update_lead($datas) {
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
    
    static function delete_lead($id) {
        $leads = new LeadsDB();
        $leads->delete($id);
        leadbook_redirect('leads', 'list', 'Lead Deleted Successfully', 'success');
    }
}