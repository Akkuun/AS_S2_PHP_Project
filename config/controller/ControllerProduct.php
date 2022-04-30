<?php
require_once  FIle::build_path(['model', 'ModelProduct.php']);

class ControllerProduct{
    static $controller = 'products';

    public static function readAll(){
        $products = ModelProduct::getAllProducts();

        $view = 'productList';
        $pageTitle = 'All products';

        require_once File::build_path(['view', 'view.php']);
    }

    public static function create(){
        $view = 'create';
        $pageTitle = 'Create a new Product';

        require_once File::build_path(['view', 'view.php']);
    }

    public static function created(){
        /*
        if (isset($_FILES['image'])){
            $formatsAllowed = ['png', 'jpg', 'jpeg', 'gif'];

            $explodedName = explode('.', $_FILES['image']['name']);
            $imageFormat = strtolower(end($explodedName));

            if (in_array($imageFormat, $formatsAllowed)){
                $_POST['image'] = $_FILES['image']['name'];
            }
        }*/

        if (isset($_POST['name']) && isset($_POST['price'])
            && isset($_POST['image']) && isset($_POST['category'])){
            //move_uploaded_file($_FILES['image']['tmp_name'], File::build_path(['src', 'images', 'productsPictures', $_FILES['image']['name']]));

            $valuesToBind = [];

            foreach ($_POST as $key => $value) {
                $valuesToBind[$key] = $value;
            }

            if (!isset($valuesToBind['origin'])){
                $valuesToBind['origin'] = null;
            } if (!isset($valuesToBind['quantity'])){
                $valuesToBind['quantity'] = null;
            } if (!isset($valuesToBind['description'])){
                $valuesToBind['description'] = null;
            }

            $product = new ModelProduct(['name' => $valuesToBind['name'],
                'price' => $valuesToBind['price'],
                'image' => $valuesToBind['image'],
                'quantity' => $valuesToBind['quantity'],
                'description' => $valuesToBind['description']]);

            $product->save($valuesToBind['origin'], $valuesToBind['category']);

            self::readAll();
        }
    }

    public static function read(){
        $name = $_GET['name'];
        $product = ModelProduct::getProductByName($name);

        $view = 'detail';
        $pageTitle = $name;

        require_once File::build_path(['view', 'view.php']);
    }
}
