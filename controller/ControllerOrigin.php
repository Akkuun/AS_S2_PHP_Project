<?php
require_once File::build_path(['model', 'ModelOrigin.php']);

class ControllerOrigin{
    static $controller = 'origins';

    public static function create(){
        if (isset($_SESSION['type']) && $_SESSION['type'] == 'admin') {
            $view = 'create';
            $pageTitle = 'Create new origin';

            require_once File::build_path(['view', 'view.php']);
        } else {
            require_once File::build_path(['controller', 'ControllerProduct.php']);
            ControllerProduct::readAll();
        }
    }

    public static function created(){
        if (isset($_POST['name']) && isset($_POST['creator']) && isset($_POST['releaseDate'])){
            $origin = new ModelOrigin(['name' => $_POST['name'],
                'creator' => $_POST['creator'],
                'releaseDate' => $_POST['releaseDate']]);

            $origin->save();

            self::readAll();
        }
    }

    public static function readAll(){
        $origins = ModelOrigin::getAllOrigins();

        $view = 'originsList';
        $pageTitle = 'All origins';

        require_once File::build_path(['view', 'view.php']);
    }

    public static function delete(){
        if (isset($_GET['idOgn']) && isset($_SESSION['type']) && $_SESSION['type'] == 'admin'){
            $origin = ModelOrigin::getOriginById($_GET['idOgn']);
            $origin->delete();
        }

        require_once File::build_path(['controller', 'ControllerProduct.php']);
        ControllerProduct::readAll();
    }
}
