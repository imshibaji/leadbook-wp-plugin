<?php
require_once LEADBOOK_MODELS . 'BusinessesDB.php';
require_once LEADBOOK_MODELS . 'FollowupsDB.php';

function get_all_followups(){
    $followupsDb = new Models\FollowupsDB();
    $followups = $followupsDb->getAll();

    if(isset($_GET['business_id']) && $_GET['business_id'] != '') {
        // $business_id = sanitize_text_field(wp_unslash($_GET['business_id']));
        // $followups = $followupsDb->getByBusiness($business_id);
        $followups = $followupsDb->business();
        return $followups;
    }
    return $followups;
}

function followup_list_for_dashboard($contents) {
    $datas = (array) $contents;
    // resheaping the string
    $out = '<ul class="list-group list-group-flush">';
    $out .= implode(array_map(function($data) {
        return '<li class="list-group-item">' . $data->title ?? '' . '</li>';
    }, $datas));
    $out .= '</ul>';
    return $out;
}

if(!function_exists('get_business_info')){
    function get_business_info($business_id) {
        $businesses = new Models\BusinessesDB();
        $business = $businesses->get($business_id);
        return $business;
    }
}

if(!function_exists('get_lead_info')) {
    function get_lead_info($lead_id) {
        $leads = new Models\LeadsDB();
        $lead = $leads->get($lead_id);
        return $lead;
    }
}

if(!function_exists('add_followup')) {
    function add_followup($data) {
        if(isset($data['action']) && $data['action'] == 'add') {
            unset($data['action']);

            if(isset($data['lead_id']) && $data['lead_id'] != '') {
                $data['lead_id'] = sanitize_text_field(wp_unslash($data['lead_id']));
            }
            if(isset($data['date']) || $data['date'] != '' || isset($data['time']) || $data['time'] != '') {
                $data['next_reminder'] = date('Y-m-d H:i:s', strtotime($data['date'] . ' ' . $data['time']));
                unset($data['date']);
                unset($data['time']);
            }
            $followupsDb = new Models\FollowupsDB();
            $followupsDb->insert($data);
            leadbook_redirect('followups', 'list', 'Followup Added Successfully', 'success');
        }
    }
}

if(!function_exists('get_followup')) {
    function get_followup($id) {
        $followupsDb = new Models\FollowupsDB();
        $followup = $followupsDb->get($id);
        return $followup;
    }
}

if(!function_exists('update_followup')) {
    function update_followup($data) {
        if(isset($data['action']) && $data['action'] == 'edit') {
            unset($data['action']);
            if(isset($data['lead_id']) && $data['lead_id'] != '') {
                $data['lead_id'] = sanitize_text_field(wp_unslash($data['lead_id']));
            }
            if(isset($data['date']) || $data['date'] != '' || isset($data['time']) || $data['time'] != '') {
                $data['next_reminder'] = date('Y-m-d H:i:s', strtotime($data['date'] . ' ' . $data['time']));
                unset($data['date']);
                unset($data['time']);
            }

            // var_dump($data);

            $followupsDb = new Models\FollowupsDB();
            $followupsDb->update($data['id'], $data);
            leadbook_redirect('followups', 'list', 'Followup Updated Successfully', 'success');
        }
    }
}

if(!function_exists('delete_followup')) {
    function delete_followup($id) {
        $followupsDb = new Models\FollowupsDB();
        $followupsDb->delete($id);
    }
}
