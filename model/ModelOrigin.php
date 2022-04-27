<?php
require_once File::build_path(['model', 'Model.php']);

class ModelOrigin{
    private $id;
    private $name;
    private $creator;
    private $realeaseDate;

    public function __construct($datas = NULL){
        if (!is_null($datas)){
            $this->id = $datas['id'];
            $this->name = $datas['name'];
            $this->creator = $datas['creator'];
            $this->realeaseDate = $datas['releaseDate'];
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

    public function getRealeaseDate()
    {
        return $this->realeaseDate;
    }

    public static function getAllOrigins(){
        $query = Model::getPDO()->query('SELECT * FROM origins');
        $query->execute();
        $query->setFetchMode(PDO::FETCH_CLASS, 'ModelOrigin');
        $origins = $query->fetchAll();

        return $origins;
    }


}
