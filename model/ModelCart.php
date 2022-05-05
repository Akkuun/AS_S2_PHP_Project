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
   
    public static function addProduct($idProduct, $quantity) {
        $query = null;
        if (isset($_SESSION['cart'][$idProduct])){
            $_SESSION['cart'][$idProduct] += $quantity;
            if (isset($_SESSION['idClient'])){
                $query = Model::getPDO()->prepare("CALL addQuantityCartRow(?, ? ,?)");
            }
        } else {
            $_SESSION['cart'][$idProduct] = $quantity;
            if (isset($_SESSION['idClient'])){
                $query = Model::getPDO()->prepare("CALL insertIntoRow(?, ?, ?)");
            }
        }

        if (!is_null($query)){
            $query->execute([
                $_SESSION['idClient'],
                $idProduct,
                $quantity
            ]);
        }
    }
   
    public function __construct($data = NULL) {
        if (!is_null($data)) {
            foreach ($data as $attribut => $valeur) {
                if (property_exists($this, $attribut))
                    $this->$attribut = $valeur;
            }
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
            if (empty($cart))
                return false;
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