<?php
require_once FIle::build_path(['model', 'ModelProduct.php']);

class ControllerProduct{
    static $controller = 'products';

    public static function readAll()
    {
        $products = ModelProduct::getAllProducts();

        $view = 'productList';
        $pageTitle = 'All products';

        require_once File::build_path(['view', 'view.php']);
    }

    public static function create()
    {
        if (isset($_SESSION['type']) && $_SESSION['type'] == 'admin') {
            $view = 'create';
            $pageTitle = 'Create a new Product';

            require_once File::build_path(['view', 'view.php']);
        } else {
            require_once File::build_path(['controller', 'ControllerProduct.php']);
            ControllerProduct::readAll();
        }
    }

    public static function created()
    {
        if (isset($_FILES['image'])){
            $formatsAllowed = ['png', 'jpg', 'jpeg', 'gif'];

            $explodedName = explode('.', $_FILES['image']['name']);
            $imageFormat = strtolower(end($explodedName));

            if (in_array($imageFormat, $formatsAllowed)){
                $_POST['image'] = $_FILES['image']['name'];
            }
        }

        if (isset($_POST['name']) && isset($_POST['price'])
            && isset($_POST['image']) && isset($_POST['category'])) {
            move_uploaded_file($_FILES['image']['tmp_name'], File::build_path(['src', 'images', 'productsPictures', $_FILES['image']['name']]));

            $valuesToBind = [];

            foreach ($_POST as $key => $value) {
                $valuesToBind[$key] = $value;
            }

            if (!isset($valuesToBind['origin'])) {
                $valuesToBind['origin'] = null;
            }
            if (!isset($valuesToBind['quantity'])) {
                $valuesToBind['quantity'] = null;
            }
            if (!isset($valuesToBind['description'])) {
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

    public static function read()
    {
        $name = $_GET['name'];
        $product = ModelProduct::getProductByName($name);

        $view = 'detail';
        $pageTitle = $name;

        require_once File::build_path(['view', 'view.php']);
    }


    public static function filterByCategory(){
        $category = $_GET['category'];
        $products = ModelProduct::getAllProductByCategory($category);

        foreach ($products as $index => $value) {
            echo
                "<p>" . "<li>" . $value->getName() . "</li><li>" .
                $value->getDescription() . "</li><li>" .
                $value->getPrice() . "</li><img alt='imageProduit' src='./src/images/productsPictures/".$value->getImage()."'></p>";
        }


        $view = 'productList';
        $pageTitle = $_GET['category'];

        require_once File::build_path(['view', 'view.php']);

    }


    public static function updated(){
        if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['description'])
            && isset($_POST['price']) && isset($_POST['quantity']) && isset($_POST['image'])
            && isset($_POST['origin']) && isset($_POST['category'])) {

            $updatedProduct = new ModelProduct(['id' => $_POST['id'],
                'name' => $_POST['name'],
                'description' => $_POST['description'],
                'price' => $_POST['price'],
                'image' => $_POST['image'],
                'quantity' => $_POST['quantity']
            ]);

            $updatedProduct->update($_POST['origin'], $_POST['category']);
            self::readAll();

        }
    }

    public static function update(){
        if ($_SESSION['type'] == 'admin') {
            $name = $_GET['name'];
            $product = ModelProduct::getProductByName($name);

            $view = 'update';
            $pageTitle = "Edit $name";

            require_once File::build_path(['view', 'view.php']);
        } else {
            require_once File::build_path(['controller', 'ControllerProduct.php']);
            ControllerProduct::readAll();
        }
    }

    public static function delete(){
        if (isset($_GET['idPct']) && isset($_SESSION['type']) && $_SESSION['type'] == 'admin'){
            $product = ModelProduct::getProductById($_GET['idPct']);
            $product->delete();
        }

        self::readAll();
    }

    public static function filteredByTag(){
        if (!empty($_POST['tags'])){
            $products = ModelProduct::getAllProductByTag($_POST['tags']);
            var_dump($products);

            $view = 'productList';
            $pageTitle = 'Filtered by tags';

            require_once File::build_path(['view', 'view.php']);
        }
    }
}
