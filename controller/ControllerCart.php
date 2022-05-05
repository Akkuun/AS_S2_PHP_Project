<?php
require_once File::build_path(array("model", "ModelCart.php")); // chargement du modèle
class ControllerCart {
    static $controller = 'cart';

    private static function getPathToView() {
        return File::build_path(array("view", "view.php"));
    }

    public static function read() {
        $view='productList';
        $pagetitle="Your shopping cart";
        require self::getPathToView();
    }

    public static function error() {
        $view='error';
        $pagetitle='Error';
        require self::getPathToView();
    }

    public static function addProduct(){
        if (isset($_GET['idProduct'])){
            $quantity = isset($_GET['q']) ? $_GET['q'] : 1;
            ModelCart::addProduct($_GET['idProduct'], $quantity);
        }

        require_once File::build_path(['controller', 'ControllerProduct.php']);
        ControllerProduct::readAll();
    }
}
?>