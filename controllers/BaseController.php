<?php 
namespace Controllers;
class BaseController {
    public function __construct() {
        add_action('init', array($this, 'loader'));
    }

    public function loader() {
        require_once LEADBOOK_PATH . 'includes/leadbook.php';
    }

    public function render($name, $data = array()) {
        extract($data);
        require_once LEADBOOK_VIEWS . $name . '.php';
    }
}