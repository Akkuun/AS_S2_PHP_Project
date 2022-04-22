<?php

require_once File::build_path(array("model", "Model.php"));
   
class ModelCart {
   
    private $idCart;
    private $idClient;
    private $productList;
    private $date;
       
    public function getProductList() {
        return $this->productList;
    }

    public function addRowToProductList($row) {
        $this->productList[$row->idProduct] = $row->quantity;
    }
   
    public function addProduct($idProduct, $quantity) {
        $values = array(
            "q" => $quantity,
            "cart" => $this->idCart,
            "product" => $idProduct
        );
        if (isset($productList[$idProduct])) {
            $productList[$idProduct] += $quantity;
            $sql = "UPDATE cartRow SET quantity=quantity+:q WHERE idCart=:cart AND idProduct=:product";
            try {
                $req_prep = Model::getPDO()->prepare($sql);
                $req_prep->execute($values);
            }
            catch(PDOException $e) {
                return false;
            }
            return true;
        }
        else {
            $productList[$idProduct] = $quantity;
            $sql = "INSERT INTO cartRow VALUES(:cart,:product,:q);";
            try {
                $req_prep = Model::getPDO()->prepare($sql);
                $req_prep->execute($values);
            }
            catch(PDOException $e) {
                return false;
            }
            return true;
        }
    }
   
    public function __construct($data = array()) {
        foreach ($data as $attribut => $valeur) {
            if (property_exists($this, $attribut))
                $this->$attribut = $valeur;
        }
    }

    public static function getCartByClientId($idClient) {
        $sql = "SELECT * from carts WHERE idClient=?";
        $sql2 = "SELECT * from cartRows WHERE idCart=?";
        
        try {
            $req_prep = Model::getPDO()->prepare($sql);	 
            $req_prep->execute([$idClient,]);
            $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelCart');
            $cart = $req_prep->fetch();
            $req_prep = Model::getPDO()->prepare($sql2);
            $req_prep->execute([$cart->idCart,]);
            $req_prep->setFetchMode(PDO::FETCH_OBJ);
            $cartRowsTab = $req_prep->fetchAll();
            foreach($cartRowsTab as $row) {
                $cart->addRowToProductList($row);
            }
        }
        catch(PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage();
            }
            else {
                echo 'Error finding shopping cart';
            }
            die();
        }
        return $cart;
    }
}
?>