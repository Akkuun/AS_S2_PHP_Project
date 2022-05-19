<?php
require_once File::build_path(['model','Model.php']);

class ModelCategory{
    private $id;
    private $name;

    public function __construct($datas = NULL){
        if (!is_null($datas)){
            $this->name = $datas['name'];
        }
    }

    public function getName()
    {
        return $this->name;
    }

    public function getId(){
        return $this->id;
    }

    public static function getAllCategories(){
        $query = Model::getPDO()->query('SELECT * FROM categories');
        $query->execute();
        $query->setFetchMode(PDO::FETCH_CLASS, 'ModelCategory');
        $categories = $query->fetchAll();

        return $categories;
    }

    public static function getCategoryById($id){
        $query = Model::getPDO()->prepare('SELECT * FROM categories WHERE id = ?');
        $query->execute([$id]);
        $query->setFetchMode(PDO::FETCH_CLASS, 'ModelCategory');
        $category=$query->fetchAll();

        if (empty($category)){
            $category[0] = false;
        }

        return $category[0];
    }

    public function save(){
        $query = Model::getPDO()->prepare('INSERT INTO categories (name) VALUES (?)');
        $query->execute([$this->name]);
    }

    public function delete(){
        $query = Model::getPDO()->prepare('DELETE FROM categories WHERE id = ?');
        $query->execute([$this->id]);
    }
}