<?php
require_once File::build_path(['controller', 'ControllerCart.php']);
require_once File::build_path(['controller', 'ControllerProduct.php']);
require_once File::build_path(['controller', 'ControllerCategory.php']);
require_once File::build_path(['controller', 'ControllerOrigin.php']);
require_once File::build_path(['controller', 'ControllerCustomer.php']);
require_once File::build_path(['controller', 'ControllerTag.php']);

$controller = isset($_GET['controller']) ? $_GET['controller'] : "products";

switch ($controller) {
    case "products" :
        $controller_class = "ControllerProduct";
        break;
    case "cart" :
        $controller_class = "ControllerCart";
        break;
    case "categories" :
        $controller_class = "ControllerCategory";
        break;
    case "origins" :
        $controller_class = "ControllerOrigin";
        break;
    case "customers" :
        $controller_class = "ControllerCustomer";
        break;
    case "tags" :
        $controller_class = "ControllerTag";
        break;
}

$action =  isset($_GET['action']) ? $_GET['action'] : "readAll";

if (class_exists($controller_class) &&
    in_array($action, get_class_methods($controller_class))){
    $controller_class::$action();
}

?>