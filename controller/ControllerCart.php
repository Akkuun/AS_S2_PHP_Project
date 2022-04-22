<?php
require_once File::build_path(array("model", "ModelCart.php")); // chargement du modèle
class ControllerCart {

    private static function getPathToView() {
        return File::build_path(array("view", "view.php"));
    }

    public static function read() {
        $idClient = $_SESSION["id"];
        $cart = ModelCart::getCartByClientId($idClient);
        $controller='cart';
        $view='productList';
        $pagetitle="Your shopping cart";
        require self::getPathToView();
    }

    public static function error() {
        $controller='cart';
        $view='error';
        $pagetitle='Error';
        require self::getPathToView();
    }
}
?>