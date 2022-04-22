<?php
require_once File::build_path(array("controller", "ControllerCart.php"));
// On recupère l'action passée dans l'URL
$action = isset($_GET['action']) ? $_GET['action'] : 'read';
if (!in_array($action, get_class_methods('ControllerCart'))) {
    ControllerCart::error();
    die();
}

ControllerCart::$action(); 
?>