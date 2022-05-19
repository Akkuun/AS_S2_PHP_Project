<?php
require_once File::build_path(['model', 'ModelCategory.php']);

class ControllerCategory{
    static $controller = "categories";

    public static function create(){
        if (isset($_SESSION['type']) && $_SESSION['type'] == 'admin') {
            $view = 'create';
            $pageTitle = 'Create a new Category';

            require_once File::build_path(['view', 'view.php']);
        } else {
            require_once File::build_path(['controller', 'ControllerProduct.php']);
            ControllerProduct::readAll();
        }
    }

    public static function created(){
        if (isset($_POST['name'])){
            $controller = new ModelCategory(['name' => $_POST['name']]);
            $controller->save();

            self::readAll();
        }
    }

    public static function readAll(){
        $categories = ModelCategory::getAllCategories();

        $view = 'categoriesList';
        $pageTitle = 'All categories';

        require_once File::build_path(['view', 'view.php']);
    }

    public static function delete(){
        if (isset($_GET['idCtg']) && isset($_SESSION['type']) && $_SESSION['type'] == 'admin'){
            $category = ModelCategory::getCategoryById($_GET['idCtg']);
            $category->delete();

            self::readAll();
        } else {
            require_once File::build_path(['controller', 'ControllerProduct.php']);
            ControllerProduct::readAll();
        }
    }
}
