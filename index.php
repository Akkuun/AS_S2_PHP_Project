<?php
session_start();
require_once __DIR__ . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR . 'File.php';
require_once File::build_path(['model', 'ModelCart.php']);
require_once File::build_path(array("controller", "router.php"));

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION['cart'])){
    $_SESSION['cart'] = [];
}
?>