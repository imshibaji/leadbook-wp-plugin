<?php

function leadbook_loader($file_name)
{
    if (file_exists(LEADBOOK_PATH . $file_name . '.php')) {
        require_once LEADBOOK_PATH . $file_name . '.php';
    } else if (file_exists(LEADBOOK_PATH . $file_name . '/index.php')) {
        require_once LEADBOOK_PATH . $file_name . '/index.php';
    } else if (file_exists(LEADBOOK_PATH . $file_name . '/functions.php')) {
        require_once LEADBOOK_PATH . $file_name . '/functions.php';
    } else if (file_exists(LEADBOOK_PATH . $file_name . '/' . $file_name . '.php')) {
        require_once LEADBOOK_PATH . $file_name . '/' . $file_name . '.php';
    } else if (file_exists($file_name . '.php')) {
        require_once $file_name . '.php';
    }
}



function leadbook_get_loader($file_name)
{
    if (file_exists(LEADBOOK_PATH . $file_name . '.php')) {
        require_once LEADBOOK_PATH . $file_name . '.php';
    } else if (file_exists(LEADBOOK_PATH . $file_name . '/index.php')) {
        require_once LEADBOOK_PATH . $file_name . '/index.php';
    } else if (file_exists(LEADBOOK_PATH . $file_name . '/functions.php')) {
        require_once LEADBOOK_PATH . $file_name . '/functions.php';
    } else if (file_exists(LEADBOOK_PATH . $file_name . '/' . $file_name . '.php')) {
        require_once LEADBOOK_PATH . $file_name . '/' . $file_name . '.php';
    } else if (file_exists($file_name . '.php')) {
        require_once $file_name . '.php';
    }
}



function leadbook_model_object($class_name)
{
    if (file_exists(LEADBOOK_MODELS . $class_name . '.php')) {
        require_once LEADBOOK_MODELS . $class_name . '.php';
    }
    $new_class_name = 'Leadbook_' . $class_name;
    return new $new_class_name();
}



function leadbook_render_admin($page = 'dashboard', array $data = [])
{
    extract($data);
    include_once LEADBOOK_ADMIN . 'common/header.php';
    if (isset($_GET['action']) && !empty($_GET['action'])) {
        if (file_exists(LEADBOOK_ADMIN . $page . '/' . $_GET['action'] . '.php')):
            include_once LEADBOOK_ADMIN . $page . '/' . $_GET['action'] . '.php';
        elseif (file_exists(LEADBOOK_ADMIN . $_GET['action'] . '.php')):
            include_once LEADBOOK_ADMIN . $_GET['action'] . '.php';
        endif;
    } else {
        if (file_exists(LEADBOOK_ADMIN . $page . '.php')):
            include_once LEADBOOK_ADMIN . $page . '.php';
        else:
            include_once LEADBOOK_ADMIN . $page . '/list.php';
        endif;
    }
    include_once LEADBOOK_ADMIN . 'common/footer.php';
}



function leadbook_render_front($page = 'dashboard', array $data = [])
{
    require_once LEADBOOK_VIEWS . 'common/header.php';
    require_once LEADBOOK_VIEWS . $page . '.php';
    require_once LEADBOOK_VIEWS . 'common/footer.php';
}



function leadbook_render_shortcode($page = 'dashboard', array $data = [])
{
    extract($data);
    require_once LEADBOOK_SHORTCODES . 'common/header.php';
    require_once LEADBOOK_SHORTCODES . $page . '.php';
    require_once LEADBOOK_SHORTCODES . 'common/footer.php';
}



function leadbook_render_widget($page = 'dashboard', array $data = [])
{
    require_once LEADBOOK_WIDGETS . 'common/header.php';
    require_once LEADBOOK_WIDGETS . $page . '.php';
    require_once LEADBOOK_WIDGETS . 'common/footer.php';
}
