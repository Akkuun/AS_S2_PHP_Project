<?php
require_once File::build_path(['model','Model.php']);

class ModelProduct{
    private $id;
    private $name;
    private $description;
    private $price;
    private $image;
    private $quantity;

    public function __construct($datas = NULL){
        if(!is_null($datas)){
            if (isset($datas['id'])){
                $this->id = $datas['id'];
            }
            $this->name = $datas['name'];
            $this->description = $datas['description'];
            $this->price = $datas['price'];
            $this->image = $datas['image'];
            $this->quantity = $datas['quantity'];
        }
    }

    public function getId(){
        return $this->id;
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

    public function getCategory(){
        $query = Model::getPDO()->prepare('SELECT c.name FROM categories c 
            JOIN products p ON p.idCategory = c.id
            WHERE p.name = ?');
        $query->execute([$this->name]);
        $category = $query->fetch();

        return $category[0];
    }

    public function getOrigin(){
        $query = Model::getPDO()->prepare('SELECT o.name FROM origins o
            JOIN products p ON p.idOrigin = o.id
            WHERE p.name = ?');
        $query->execute([$this->name]);
        $origin = $query->fetch();

        return $origin[0];
    }

    public function getTags(){
        require_once File::build_path(['model', 'ModelTag.php']);

        $query = Model::getPDO()->prepare('SELECT * FROM tags t
            WHERE EXISTS (
                SELECT idTag FROM owns o
                WHERE o.idTag = t.id
                AND o.idProducts = ?
            )');

        $query->execute([$this->id]);
        $query->setFetchMode(PDO::FETCH_CLASS, 'ModelTag');

        $tags = $query->fetchAll();

        return $tags;
    }

    public function save($idOrigin, $idCategory){
        $query = Model::getPDO()->prepare('INSERT INTO products
            (name, description, price, image, idOrigin, idCategory, quantity)
            VALUES (?, ?, ?, ?, ?, ?, ?)');

        $query->execute([$this->name, $this->description, $this->price,
                         $this->image, $idOrigin, $idCategory, $this->quantity]);
    }

    public static function getAllProducts(){
        $query = Model::getPDO()->prepare('SELECT id, name, description, price, image, quantity FROM products');
        $query->execute();
        $query->setFetchMode(PDO::FETCH_CLASS, "ModelProduct");
        $products = $query->fetchAll();

        return $products;
    }

    public static function getProductByName($name){
        $query = Model::getPDO()->prepare('SELECT id, name, description, price, image, quantity FROM products
            WHERE name = ?');
        $query->execute([$name]);
        $query->setFetchMode(PDO::FETCH_CLASS, 'ModelProduct');
        $product = $query->fetchAll();

        if (empty($product)){
            $product[0] = false;
        }

        return $product[0];
    }

    public static function getProductById($id){
        $query = Model::getPDO()->prepare('SELECT id, name, description, price, image, quantity FROM products
            WHERE id = ?');
        $query->execute([$id]);
        $query->setFetchMode(PDO::FETCH_CLASS, 'ModelProduct');
        $product = $query->fetchAll();

        if (empty($product)){
            $product[0] = false;
        }

        return $product[0];
    }

    public static function getAllProductByCategory($idCategory){
        $query = Model::getPDO()->prepare('SELECT * FROM products
            WHERE idCategory = ?
            ORDER BY name');
        $query->execute([$idCategory]);
        $query->setFetchMode(PDO::FETCH_CLASS, "ModelProduct");
        $products = $query->fetchAll();

        if (empty($products)){
            $products = false;
        }

        return $products;
    }

    public function update($idOrigin, $idCategory){
        $query = Model::getPDO()->prepare('UPDATE products
                SET name = ?,
                    description = ?,
                    price = ?,
                    image = ?,
                    idOrigin = ?,
                    idCategory = ?,
                    quantity = ?
                WHERE id = ?');

        $query->execute([$this->getName(),
                $this->getDescription(),
                $this->getPrice(),
                $this->getImage(),
                $idOrigin,
                $idCategory,
                $this->getQuantity(),
                $this->getId()]);
    }

    public static function getAllProductByTag($idTags){
        $sql = 'SELECT * FROM products p
            WHERE EXISTS (
                SELECT * FROM owns o
                WHERE o.idProducts = p.id AND (';

        foreach ($idTags as $key => $value){
            $sql .= " o.idTag = $value OR ";
        }

        $sql = substr($sql, 0, -3);
        $sql .= "))";

        $query = Model::getPDO()->prepare($sql);
        $query->execute();
        $query->setFetchMode(PDO::FETCH_CLASS, 'ModelProduct');

        $products = $query->fetchAll();

        if (empty($products)){
            $products = false;
        }

        return $products;
    }

    public function delete(){
        $query = Model::getPDO()->prepare('DELETE FROM products WHERE id = ?');
        $query->execute([$this->id]);
    }
}