<?php
require_once File::build_path(['model','Model.php']);

class ModelCategory{
    private $id;
    private $name;
    private $creator;
    private $releaseDate;

    public function __construct($datas = NULL){
        if (!is_null($datas)){
            $this->id = $datas['id'];
            $this->name = $datas['name'];
            $this->creator = $datas['creator'];
            $this->releaseDate = $datas['releaseDate'];
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getCreator()
    {
        return $this->creator;
    }

    public function getReleaseDate()
    {
        return $this->releaseDate;
    }

    public static function getAllCategories(){
        $query = Model::getPDO()->query('SELECT * FROM categories');
        $query->execute();
        $query->setFetchMode(PDO::FETCH_CLASS, 'ModelCategory');
        $categories = $query->fetchAll();

        return $categories;
    }
}