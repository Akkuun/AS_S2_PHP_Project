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
                $query = Model::getPDO()->prepare("CALL insertCartRow(?, ?, ?)");
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

    public static function removeProduct($idProduct, $quantity){
        $query = null;
        if (isset($_SESSION['cart'][$idProduct])){
            $_SESSION['cart'][$idProduct] -= $quantity;

            if ($_SESSION['cart'][$idProduct] <= 0){
                unset($_SESSION['cart'][$idProduct]);
            }

            if (isset($_SESSION['idClient'])){
                $query = Model::getPDO()->prepare("CALL removeProduct(?, ? ,?)");
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
        $sql2 = "SELECT * from cartRow WHERE idCart=?";
        
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
                $finalCart[$row->idProduct] = $row->quantity;
            }
            return $finalCart;
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
    }
}
?>