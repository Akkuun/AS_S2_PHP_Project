<?php
require_once File::build_path(['model','Model.php']);

class ModelProduct{
    private $name;
    private $description;
    private $price;
    private $image;
    private $quantity;

    public function __construct($datas = NULL){
        if(!is_null($datas)){
            $this->name = $datas['name'];
            $this->description = $datas['description'];
            $this->price = $datas['price'];
            $this->image = $datas['image'];
            $this->quantity = $datas['quantity'];
        }
    }

    public function getName(){
        return $this->name;
    }

    public function getQuantity(){
        return $this->quantity;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function save($idOrigin, $idCategory){
        $query = Model::getPDO()->prepare('INSERT INTO Products
            (name, description, price, image, idOrigin, idCategory, quantity)
            VALUES (?, ?, ?, ?, ?, ?, ?)');

        $query->execute([$this->name, $this->description, $this->price,
                        $this->image, $idOrigin, $idCategory, $this->quantity]);
    }

    public static function getAllProduct(){
        $query = Model::getPDO()->query('SELECT * FROM Products');
        $query->execute();
        $products = $query->fetchAll();

        return $products;
    }

    public static function getAllProductByCategory($idCategory){
        $query = Model::getPDO()->prepare('SELECT * FROM Products
            WHERE idCategory = ?');
        $query->execute([$idCategory]);
        $query->setFetchMode(PDO::FETCH_CLASS, "ModelProduct");
        $products = $query->fetchAll();

        if (empty($products)){
            $products = false;
        }

        return $products;
    }

}