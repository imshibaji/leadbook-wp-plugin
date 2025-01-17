<?php
// Activate Modules
add_action('init', function () {
    leadbook_loader('admin/business');
    leadbook_loader('admin/leads');
});

if (!function_exists('leadbook_admin_init')) {
    function leadbook_admin_init($hook_suffix){
        // Array of allowed pages (hook_suffixes)
        $allowed_pages = [
            'toplevel_page_leadbook',       // Main page
            'leadbook_page_leadbook-leads',  // Subpage 1
            'leadbook_page_leadbook-followups',  // Subpage 2
            'leadbook_page_leadbook-deals',  // Subpage 3
            'leadbook_page_leadbook-transections',  // Subpage 4
            'leadbook_page_leadbook-businesses',  // Subpage 5
            'leadbook_page_leadbook-about',  // Subpage 6
        ];
        if (!in_array($hook_suffix, $allowed_pages)) {
            return;
        }
        // Styles
        wp_enqueue_style('leadbook-bootstrap-style', LEADBOOK_ASSETS_URL . 'css/bootstrap.min.css', [], '5.0.0');
        wp_enqueue_style('leadbook-admin-style', LEADBOOK_ASSETS_URL . 'css/admin-style.css', [], LEADBOOK_VERSION);

        // Scripts
        wp_enqueue_script('leadbook-bootstrap-script', LEADBOOK_ASSETS_URL . 'js/bootstrap.bundle.min.js', [], '5.0.0', true);
        wp_enqueue_script('leadbook-admin-script', LEADBOOK_ASSETS_URL . 'js/admin-script.js', [], LEADBOOK_VERSION, true);
    }
    add_action('admin_enqueue_scripts', 'leadbook_admin_init');
}

if (!function_exists('leadbook_admin_menu')) {
    add_action('admin_menu', 'leadbook_admin_menu');
    function leadbook_admin_menu()
    {
        add_menu_page(
            'Leadbook Dashboard',
            'Leadbook',
            'manage_options',
            'leadbook',
            'leadbook_dashboard',
            'dashicons-admin-users',
            6
        );
        add_submenu_page(
            'leadbook',
            'Leads Dashboard',
            'Dashboard',
            'manage_options',
            'leadbook',
            'leadbook_dashboard'
        );

        add_submenu_page(
            'leadbook',
            'Leads Section',
            'Leads',
            'manage_options',
            'leadbook-leads',
            'leadbook_leads'
        );

        add_submenu_page(
            'leadbook',
            'Followups Section',
            'Followups',
            'manage_options',
            'leadbook-followups',
            'leadbook_followups'
        );

        add_submenu_page(
            'leadbook',
            'Deals Section',
            'Deals',
            'manage_options',
            'leadbook-deals',
            'leadbook_deals'
        );

        add_submenu_page(
            'leadbook',
            'Transections Section',
            'Transections',
            'manage_options',
            'leadbook-transections',
            'leadbook_transections'
        );

        add_submenu_page(
            'leadbook',
            'Businesses Areas',
            'Businesses',
            'manage_options',
            'leadbook-businesses',
            'leadbook_businesses'
        );

        add_submenu_page(
            'leadbook',
            'About Section',
            'About',
            'manage_options',
            'leadbook-about',
            'leadbook_about'
        );
    }
}

function leadbook_dashboard()
{
    $actions = [];
    apply_filters('leadbook_dashboard_actions', $actions);
    leadbook_render_admin('dashboard', ['title' => 'Dashboard Section', 'actions' => $actions]);
}

function leadbook_leads()
{
    $actions = [
        ['link' => 'admin.php?page=leadbook-leads&action=add', 'title' => 'Add New'],
        ['link' => 'admin.php?page=leadbook-leads&action=export', 'title' => 'Export CSV'],
        ['link' => 'admin.php?page=leadbook-leads&action=import', 'title' => 'Import CSV'],
        // ['link' => 'admin.php?page=leadbook-leads&action=delete', 'title' => 'Delete All'],
    ];
    leadbook_render_admin('leads', ['title' => 'Leads Section', 'actions' => $actions]);
}

function leadbook_followups()
{
    $actions = [
        ['link' => 'admin.php?page=leadbook-followups&action=add', 'title' => 'Add New'],
        ['link' => 'admin.php?page=leadbook-followups&action=export', 'title' => 'Export CSV'],
    ];
    leadbook_render_admin('followups', ['title' => 'Followups Section', 'actions' => $actions]);
}

function leadbook_deals()
{
    $actions = [
        ['link' => 'admin.php?page=leadbook-deals&action=add', 'title' => 'Add New'],
        ['link' => 'admin.php?page=leadbook-deals&action=export', 'title' => 'Export CSV'],
    ];
    leadbook_render_admin('deals', ['title' => 'Deals Section', 'actions' => $actions]);
}

function leadbook_transections()
{
    $actions = [
        ['link' => 'admin.php?page=leadbook-transections&action=add', 'title' => 'Add New'],
        ['link' => 'admin.php?page=leadbook-transections&action=export', 'title' => 'Export CSV'],
    ];
    leadbook_render_admin('transections', ['title' => 'Transections Section', 'actions' => $actions]);
}

function leadbook_businesses()
{
    $actions = [
        ['link' => 'admin.php?page=leadbook-businesses&action=add', 'title' => 'Add New'],
        ['link' => 'admin.php?page=leadbook-businesses&action=export', 'title' => 'Export CSV'],
    ];
    leadbook_render_admin('business', ['title' => 'Businesses Section', 'actions' => $actions]);
}

function leadbook_about()
{
    leadbook_render_admin('about', ['title' => 'About Section']);
}
