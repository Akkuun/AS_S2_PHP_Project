<?php
require_once File::build_path(array("controller", "ControllerCart.php"));
require_once File::build_path(['controller', 'ControllerProduct.php']);

$controller = isset($_GET['controller']) ? $_GET['controller'] : "products";

if ($controller == "products"){
    $controller_class = "ControllerProduct";
} else if ($controller == "cart"){
    $controller_class = "ControllerCart";
}

$action =  isset($_GET['action']) ? $_GET['action'] : "create";

if (class_exists($controller_class) &&
    in_array($action, get_class_methods($controller_class))){
    $controller_class::$action();
}

?>