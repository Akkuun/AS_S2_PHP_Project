<?php
    require_once File::build_path(['model', 'ModelTag.php']);

    class ControllerTag{
        static $controller = 'tags';

        public static function create(){
            if (isset($_SESSION['type']) && $_SESSION['type'] == 'admin') {
                $view = 'create';
                $pageTitle = 'Create new tag';

                require_once File::build_path(['view', 'view.php']);
            } else {
                require_once File::build_path(['controller', 'ControllerProduct.php']);
                ControllerProduct::readAll();
            }
        }

        public static function created(){
            if (isset($_POST['name'])){
                $values['nameTag'] = $_POST['name'];
                $tag = new ModelTag($values);

                $tag->save();
            }

            require_once File::build_path(['controller', 'ControllerProduct.php']);
            ControllerProduct::readAll();
        }

        public static function readAll(){
            $tags = ModelTag::getAllTags();

            $view = 'tagsList';
            $pageTitle = 'All tags';

            require_once File::build_path(['view', 'view.php']);
        }

        public static function delete(){
            if (isset($_GET['idTag']) && isset($_SESSION['type']) && $_SESSION['type'] == 'admin'){
                $tag = ModelTag::getTagById($_GET['idTag']);
                $tag->delete();
            }

            require_once File::build_path(['controller', 'ControllerProduct.php']);
            ControllerProduct::readAll();
        }
    }