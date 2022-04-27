<?php
require_once File::build_path(['model', 'Model.php']);

class ModelOrigin{
    private $id;
    private $name;
    private $creator;
    private $releaseDate;

    public function __construct($datas = NULL){
        if (!is_null($datas)){
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

    public static function getAllOrigins(){
        $query = Model::getPDO()->query('SELECT * FROM origins');
        $query->execute();
        $query->setFetchMode(PDO::FETCH_CLASS, 'ModelOrigin');
        $origins = $query->fetchAll();

        return $origins;
    }

    public function save(){
        $query = Model::getPDO()->prepare('INSERT INTO origins (name, creator, releaseDate) VALUES (?, ?, ?)');
        $query->execute([$this->name, $this->creator, $this->releaseDate]);
    }


}
