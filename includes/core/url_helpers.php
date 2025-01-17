<?php
function post_url() {
    return sanitize_text_field(wp_unslash($_SERVER['REQUEST_URI'] ?? ''));
}

function previous_url() {
    return sanitize_text_field(wp_unslash($_SERVER['HTTP_REFERER'] ?? ''));
}

function leadbook_navigate($page = 'dashboard', array $data = []) {
    $url = admin_url('admin.php?page=leadbook-' . $page);
    extract($data);
    if (isset($action) && $action) {
        $url .= '&action=' . $action;
    }
    if (isset($msg) && $msg) {
        $url .= '&msg=' . $msg;
    }
    if (isset($status) && $status) {
        $url .= '&status=' . $status;
    }
    if (isset($id) && $id > 0) {
        $url .= '&id=' . $id;
    }
    return wp_unslash($url);
}

function lb_redirect($filename) {
    if (!headers_sent())
        header('Location: '.$filename);
    else {
        echo '<script type="text/javascript">';
        echo 'window.location.href="'.$filename.'";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url='.$filename.'" />';
        echo '</noscript>';
    }
}

function leadbook_redirect_back($msg = '', $status = '') {
    $url = previous_url();
    if (!$url) {
        $url = admin_url('admin.php?page=leadbook');
    }
    if ($msg) {
        $url .= '?msg=' . $msg;
    }
    if ($status) {
        $url .= '&status=' . $status;
    }
    lb_redirect($url);
    exit;
}

function leadbook_redirect($page = 'dashboard', $action = '', $msg = '', $status = '', $id = '') {
    $url = leadbook_navigate($page, ['action' => $action, 'msg' => $msg, 'status' => $status, 'id' => $id]);
    lb_redirect($url);
    exit;
}

function leadbook_display_message() {
    $msg = get_message();
    $status = get_status();
    if (!$msg) {
        return;
    }
    $class = $status == 'error' ? 'alert alert-danger' : 'alert alert-success';
    echo '<div class="' . esc_html($class) . ' alert-dismissible fade show me-3" role="alert">
    ' . esc_html($msg) . '
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
}

if (!function_exists('get_current_url')) {
    function get_current_url()
    {
        return sanitize_text_field(wp_unslash($_SERVER['REQUEST_URI'] ?? ''));
    }
}


function get_current_page() {
    return sanitize_text_field(wp_unslash($_GET['page'] ?? ''));
}

function get_current_action() {
    return sanitize_text_field(wp_unslash($_GET['action'] ?? ''));
}

function get_current_id() {
    return sanitize_text_field(wp_unslash($_GET['id'] ?? ''));
}

function get_message() {
    return wp_unslash($_GET['msg'] ?? '');
}

function get_status() {
    return wp_unslash($_GET['status'] ?? '');
}

function get_current_type() {
    return wp_unslash($_GET['type'] ?? '');
}
