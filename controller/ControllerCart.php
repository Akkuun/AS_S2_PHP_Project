<?php
require_once File::build_path(array("model", "ModelCart.php")); // chargement du modèle
class ControllerCart {
    static $controller = 'cart';

    private static function getPathToView() {
        return File::build_path(array("view", "view.php"));
    }

    public static function read() {
        $idClient = $_SESSION["id"];
        $cart = ModelCart::getCartByClientId($idClient);
        $view='productList';
        $pagetitle="Your shopping cart";
        require self::getPathToView();
    }

    public static function error() {
        $view='error';
        $pagetitle='Error';
        require self::getPathToView();
    }
}
?>