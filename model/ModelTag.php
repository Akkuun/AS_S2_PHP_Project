<?php
class ModelTag{
    private $id;
    private $nameTag;

    public function __construct($datas = NULL){
        if(!is_null($datas)){
            if (isset($datas['id'])){
                $this->id = $datas['id'];
            }
            $this->nameTag = $datas['nameTag'];
        }
    }

    public function getId(){
        return $this->id;
    }

    public function getNameTag(){
        return $this->nameTag;
    }

    public static function getAllTags(){
        $query = Model::getPDO()->prepare('SELECT * FROM tags');
        $query->execute();
        $query->setFetchMode(PDO::FETCH_CLASS, 'ModelTag');
        $tags = $query->fetchAll();

        return $tags;
    }

    public static function getTagById($id){
        $query = Model::getPDO()->prepare('SELECT * FROM tags
            WHERE id = ?');
        $query->execute([$id]);
        $query->setFetchMode(PDO::FETCH_CLASS, 'ModelTag');

        $tag = $query->fetchAll();

        if (empty($tag)){
            $tag[0] = false;
        }

        return $tag[0];
    }

    public function save(){
        $query = Model::getPDO()->prepare('INSERT INTO tags (nameTag) VALUES (?)');
        $query->execute([$this->nameTag]);
    }

    public function delete(){
        $query = Model::getPDO()->prepare('DELETE FROM tags WHERE id = ?');
        $query->execute([$this->id]);
    }

    public static function removeProductTag($idPdct, $idTags){
        $sql = 'DELETE FROM owns
                    WHERE idPdct = ? AND (';

        foreach($idTags as $key => $tag){
            $sql.='idTag = $tag OR';
        }

        $sql = substr($sql, 0, -3);
        $sql.=')';

        $query = Model::getPDO()->prepare($sql);
        $query->execute([$idPdct]);
    }

    public static function getAllTagsRemaining($idProduct){
        $query = Model::getPDO()->prepare("SELECT * FROM tags t
            WHERE NOT EXISTS(
                SELECT idTag fROM owns o
                WHERE o.idTag = t.id
                AND o.idProducts = ?
            )");

        $query->execute([$idProduct]);
        $query->setFetchMode(PDO::FETCH_CLASS, 'ModelTag');

        $tags = $query->fetchAll();

        return $tags;
    }

    public static function addTag($idProduct, $idTags){
        foreach($idTags as $key => $tag){
            $query = Model::getPDO()->prepare('INSERT INTO owns VALUES(? , ?)');
            $query->execute([$tag, $idProduct]);
        }
    }
}
?>