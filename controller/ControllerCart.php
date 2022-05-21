<?php
require_once File::build_path(array("model", "ModelCart.php")); // chargement du modèle
class ControllerCart {
    static $controller = 'cart';

    private static function getPathToView() {
        return File::build_path(array("view", "view.php"));
    }

    public static function read() {
        if (!isset($_SESSION['idClient'])){
            $_SESSION['error'] = "Please, log in to access this page.";
            require_once File::build_path(['controller', 'ControllerProduct.php']);
            ControllerProduct::readAll();
        } else {
            $view='productList';
            $pageTitle="Your shopping cart";
            require self::getPathToView();
        }
    }

    public static function error() {
        $view='error';
        $pageTitle='Error';
        require self::getPathToView();
    }

    public static function addProduct(){
        if (isset($_GET['idProduct'])){
            $quantity = isset($_GET['q']) ? $_GET['q'] : 1;
            ModelCart::addProduct($_GET['idProduct'], $quantity);
        }

        $from = isset($_GET['from']) ? $_GET['from'] : 'productList';

        if ($from == 'cart'){
            self::read();
        } else {
            require_once File::build_path(['controller', 'ControllerProduct.php']);
            ControllerProduct::readAll();
        }
    }

    public static function removeProduct(){
        if (isset($_GET['idProduct'])){
            $quantity = isset($_GET['q']) ? $_GET['q'] : 1;
            ModelCart::removeProduct($_GET['idProduct'], $quantity);
        }

        $from = isset($_GET['from']) ? $_GET['from'] : 'productList';

        if ($from == 'cart'){
            self::read();
        } else {
            require_once File::build_path(['controller', 'ControllerProduct.php']);
            ControllerProduct::readAll();
        }
    }

    public static function convertToOrder() {
        $cart = ModelCart::getCartByClientId($_SESSION['idClient']);
        if (!empty($cart->getProductList())) {
            $order = $cart->convertToOrder();
            $order->createOrder();
            $view='orderPayment';
            $pageTitle="Payment";
            require self::getPathToView();
        }
    }

    public static function confirmOrder() {
        $order = ModelOrder::getLastOrderByClientId($_SESSION['idClient']);
        if ($order && isset($_GET['orderId']) && $order->getId() == $_GET['orderId']) {
            $order->confirmOrder();
            $cart = ModelCart::getCartByClientId($_SESSION['idClient']);
            $cart->emptyCart();
            $view='orderConfirmed';
            $pageTitle="Order Confirmation";
            require self::getPathToView();
        }
    }

    public static function generatePDF() {
        if(!isset($_POST['order'])) {
            $view = 'error';
            $pageTitle='Error';
            require self::getPathToView();
        }
        else {
            $order = ModelOrder::getOrderById($_POST['order']);
            $view='pdfReceipt';
            $pageTitle="Order Confirmation";
            require self::getPathToView();
        }
    }
}
?>