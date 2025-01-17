<?php
// add_action( 'plugins_loaded', 'myplugin_update_db_check' );
// function myplugin_update_db_check() {
//     global $leadbook_db_version;
//     if ( get_site_option( 'leadbook_db_version' ) != $leadbook_db_version ) {
//         leadbook_activation();
//     }
// }

function leadbook_activation() {
    $businesses_db = leadbook_model_object('BusinessesDB');
    $businesses_db->createTable();

    $leads_db = leadbook_model_object('LeadsDB');
    $leads_db->createTable();

    $followups_db = leadbook_model_object('FollowupsDB');
    $followups_db->createTable();

    $deals_db = leadbook_model_object('DealsDB');
    $deals_db->createTable();

    $transections_db = leadbook_model_object('TransectionsDB');
    $transections_db->createTable();

    // update db version
    global $leadbook_db_version;
    if( ! get_site_option( 'leadbook_db_version' ) ) {
        add_option( 'leadbook_db_version', $leadbook_db_version );
    }else{
        update_option( 'leadbook_db_version', $leadbook_db_version );
    }
}

function leadbook_deactivation() {
    $businesses_db = leadbook_model_object('BusinessesDB');
    $businesses_db->truncate();
    $businesses_db->dropTable();

    $leads_db = leadbook_model_object('LeadsDB');
    $leads_db->truncate();
    $leads_db->dropTable();

    $followups_db = leadbook_model_object('FollowupsDB');
    $followups_db->truncate();
    $followups_db->dropTable();

    $deals_db = leadbook_model_object('DealsDB');
    $deals_db->truncate();
    $deals_db->dropTable();

    $transections_db = leadbook_model_object('TransectionsDB');
    $transections_db->truncate();
    $transections_db->dropTable();

    // delete db version
    delete_site_option( 'leadbook_db_version' );
}

function leadbook_uninstallation() {
    // $businesses_db = leadbook_model_object('BusinessesDB');
    // $businesses_db->truncate();
    // $businesses_db->dropTable();

    // $leads_db = leadbook_model_object('LeadsDB');
    // $leads_db->truncate();
    // $leads_db->dropTable();

    // $followups_db = leadbook_model_object('FollowupsDB');
    // $followups_db->truncate();
    // $followups_db->dropTable();

    // $deals_db = leadbook_model_object('DealsDB');
    // $deals_db->truncate();
    // $deals_db->dropTable();

    // $transections_db = leadbook_model_object('TransectionsDB');
    // $transections_db->truncate();
    // $transections_db->dropTable();

    // // delete db version
    // delete_site_option( 'leadbook_db_version' );
}