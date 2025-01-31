<?php

class Admin
{
    // Array of allowed pages (hook_suffixes)
    private $allowed_pages = [
        'toplevel_page_leadbook',       // Main page
        'leadbook_page_leadbook-leads',  // Subpage 1
        'leadbook_page_leadbook-followups',  // Subpage 2
        'leadbook_page_leadbook-deals',  // Subpage 3
        'leadbook_page_leadbook-transections',  // Subpage 4
        'leadbook_page_leadbook-businesses',  // Subpage 5
        'leadbook_page_leadbook-about',  // Subpage 6
    ];

    public function __construct() {}

    public function run()
    {
        add_action('init', array($this, 'commonLoaders'));
        add_action('init', array($this, 'modulesLoaders'));
        add_action('admin_menu', array($this, 'menus'));
        add_action('admin_enqueue_scripts', array($this, 'css_script_loader'));
    }

    public function commonLoaders() {
        leadbook_loader('admin/common/header');
        leadbook_loader('admin/common/footer');
        leadbook_loader('admin/common/list_header');
        leadbook_loader('admin/common/card');
    }

    public function modulesLoaders()
    {
        leadbook_loader('admin/business');
        leadbook_loader('admin/leads');
        leadbook_loader('admin/followups');
        leadbook_loader('admin/deals');
        leadbook_loader('admin/transections');
        // leadbook_loader('admin/about');
    }

    public function css_script_loader($hook_suffix)
    {
        if (!in_array($hook_suffix, $this->allowed_pages)) {
            return;
        }
        // Styles
        wp_enqueue_style('leadbook-bootstrap-style', LEADBOOK_ASSETS_URL . 'css/bootstrap.min.css', [], '5.0.0');
        wp_enqueue_style('leadbook-admin-style', LEADBOOK_ASSETS_URL . 'css/admin-style.css', [], LEADBOOK_VERSION);

        // Scripts
        wp_enqueue_script('leadbook-bootstrap-script', LEADBOOK_ASSETS_URL . 'js/bootstrap.bundle.min.js', ['jquery'], '5.0.0', true);
        wp_enqueue_script('leadbook-admin-script', LEADBOOK_ASSETS_URL . 'js/admin-script.js', [], LEADBOOK_VERSION, true);
    }

    public function menus()
    {
        add_menu_page(
            'Leadbook Dashboard',
            'Leadbook',
            'manage_options',
            'leadbook',
            [$this, 'dashboard'],
            'dashicons-index-card',
            6
        );
        add_submenu_page(
            'leadbook',
            'Leads Dashboard',
            'Dashboard',
            'manage_options',
            'leadbook',
            [$this, 'dashboard']
        );
        add_submenu_page(
            'leadbook',
            'Leads Section',
            'Leads',
            'manage_options',
            'leadbook-leads',
            [$this, 'leads']
        );

        add_submenu_page(
            'leadbook',
            'Invoices Section',
            'Invoices',
            'manage_options',
            'leadbook-deals',
            [$this, 'deals']
        );

        add_submenu_page(
            'leadbook',
            'Notifications Section',
            'Notifications',
            'manage_options',
            'leadbook-followups',
            [$this, 'followups']
        );

        add_submenu_page(
            'leadbook',
            'Transections Section',
            'Transections',
            'manage_options',
            'leadbook-transections',
            [$this, 'transections']
        );

        add_submenu_page(
            'leadbook',
            'Businesses Areas',
            'Businesses',
            'manage_options',
            'leadbook-businesses',
            [$this, 'businesses']
        );

        add_submenu_page(
            'leadbook',
            'About Section',
            'About',
            'manage_options',
            'leadbook-about',
            [$this, 'about']
        );
    }

    function dashboard()
    {
        $actions = [
            ['link' => 'admin.php?page=leadbook-leads', 'title' => 'Leads'],
            ['link' => 'admin.php?page=leadbook-followups', 'title' => 'Notifications'],
        ];
        apply_filters('leadbook_dashboard_actions', $actions);
        leadbook_render_admin('dashboard', ['title' => 'Dashboard Section', 'actions' => $actions]);
    }

    function leads()
    {
        $actions = [
            ['link' => 'admin.php?page=leadbook-leads&action=add', 'title' => 'Add New'],
            ['link' => 'admin.php?page=leadbook-leads&action=export', 'title' => 'Export CSV'],
            ['link' => 'admin.php?page=leadbook-leads&action=import', 'title' => 'Import CSV'],
            // ['link' => 'admin.php?page=leadbook-leads&action=delete', 'title' => 'Delete All'],
        ];
        leadbook_render_admin('leads', ['title' => 'Leads Section', 'actions' => $actions]);
    }

    function followups()
    {
        $actions = [
            ['link' => 'admin.php?page=leadbook-followups&action=add', 'title' => 'Add New'],
            ['link' => 'admin.php?page=leadbook-followups&action=export', 'title' => 'Export CSV'],
        ];
        leadbook_render_admin('followups', ['title' => 'Notifications Section', 'actions' => $actions]);
    }

    function deals()
    {
        $actions = [
            ['link' => 'admin.php?page=leadbook-deals&action=add', 'title' => 'Add New'],
            ['link' => 'admin.php?page=leadbook-deals&action=export', 'title' => 'Export CSV'],
        ];
        leadbook_render_admin('deals', ['title' => 'Invoices / Quatations Section', 'actions' => $actions]);
    }

    function transections()
    {
        $actions = [
            ['link' => 'admin.php?page=leadbook-transections&action=add', 'title' => 'Add New'],
            ['link' => 'admin.php?page=leadbook-transections&action=export', 'title' => 'Export CSV'],
        ];
        leadbook_render_admin('transections', ['title' => 'Transections Section', 'actions' => $actions]);
    }

    function businesses()
    {
        $actions = [
            ['link' => 'admin.php?page=leadbook-businesses&action=add', 'title' => 'Add New'],
            ['link' => 'admin.php?page=leadbook-businesses&action=export', 'title' => 'Export CSV'],
        ];
        leadbook_render_admin('business', ['title' => 'Businesses Section', 'actions' => $actions]);
    }

    function about()
    {
        leadbook_render_admin('about', ['title' => 'About Section']);
    }
}

$admin = new Admin();
$admin->run();
