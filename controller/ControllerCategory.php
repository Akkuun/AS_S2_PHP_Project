<?php
require_once File::build_path(['model', 'ModelCategory.php']);

class ControllerCategory{
    static $controller = "categories";

    public static function create(){
        $view = 'create';
        $pageTitle = 'Create a new Category';

        require_once File::build_path(['view', 'view.php']);
    }

    public static function created(){
        if (isset($_POST['name'])){
            $controller = new ModelCategory(['name' => $_POST['name']]);
            $controller->save();

            header("Location: index.php?controller=categories&action=readAll");
        }
    }

    public static function readAll(){
        $categories = ModelCategory::getAllCategories();

        $view = 'categoriesList';
        $pageTitle = 'All categories';

        require_once File::build_path(['view', 'view.php']);
    }
}
