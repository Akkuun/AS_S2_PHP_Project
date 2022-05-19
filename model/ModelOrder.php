<?php

require_once File::build_path(array("model", "Model.php"));
   
class ModelOrder {
   
    private $idOrder;
    private $idClient;
    private $orderRows;
    private $total;
       
    public function getOrderRows() {
        return $this->orderRows;
    }

    public function getId() {
        return $this->idOrder;
    }
   
    public function payOrder() {
        return true;
    }

    public function confirmOrder() {
        $sql = "INSERT INTO clientOrder(idClient, total) VALUES(?, ?)";
        $sql2 = "INSERT INTO orderRow VALUES(?, ?, ?)";
        try {
            $req_prep = Model::getPDO()->prepare($sql);	 
            $tabOrder = [$this->idClient, $this->total];
            $req_prep->execute($tabOrder);

            foreach($this->orderRows as $product => $quantity) {
                $req_prep = Model::getPDO()->prepare($sql2);
                $lastOrder = self::findLastOrderId();
                $tabOrder = [$lastOrder, $product, $quantity];
                $this->idOrder = $lastOrder;
                $req_prep->execute($tabOrder);
            }
            return true;
        }
        catch(PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage();
            }
            else {
                echo 'Error confirming order, please contact store administrators';
            }
            return false;
            die();
        }
    }
   
    private static function findLastOrderId() {
        $sql = "SELECT MAX(id) AS id FROM clientOrder";
        $req_prep = Model::getPDO()->query($sql);
        $lastOrder = $req_prep->fetch();
        return $lastOrder['id'];
    }

    public function __construct($data = NULL) {
        if (!is_null($data)) {
            foreach ($data as $attribut => $valeur) {
                if (property_exists($this, $attribut))
                    $this->$attribut = $valeur;
            }
        }
    }

    public static function getOrderById($idOrder) {
        $sql = "SELECT * from clientOrder WHERE id=?";
        $sql2 = "SELECT * from orderRow WHERE idOrder=?";
        
        try {
            $req_prep = Model::getPDO()->prepare($sql);	 
            $req_prep->execute([$idOrder,]);
            $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelOrder');
            $order = $req_prep->fetch();
            if (empty($order))
                return false;
            $req_prep = Model::getPDO()->prepare($sql2);
            $req_prep->execute([$order->idCart,]);
            $req_prep->setFetchMode(PDO::FETCH_OBJ);
            $orderRowsTab = $req_prep->fetchAll();
            foreach($orderRowsTab as $row) {
                $finalOrder[$row->idProduct] = $row->quantity;
            }
            return $finalOrder;
        }
        catch(PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage();
            }
            else {
                echo 'Error finding order';
            }
            die();
        }
    }

    public function countTotal() {
        $sum = 0;
        foreach ($this->orderRows as $id => $quantity) {
            $sum += ModelProduct::getProductById($id)->getPrice() * $quantity;
        }
        return $sum;
    }
}
?>