<?php

require_once File::build_path(array("model", "Model.php"));
   
class ModelOrder {
   
    private $id;
    private $idClient;
    private $orderRows;
    private $date;
    private $total;
       
    public function getOrderRows() {
        return $this->orderRows;
    }

    public function getDate() {
        return $this->date;
    }

    public function getId() {
        return $this->id;
    }

    public function getTotal() {
        return $this->total;
    }
   
    public function payOrder() {
        return true;
    }

    public function createOrder() {
        $sql = "INSERT INTO clientOrder(idClient, total) VALUES(?, ?)";
        $sql2 = "INSERT INTO orderRow VALUES(?, ?, ?)";
        try {
            $req_prep = Model::getPDO()->prepare($sql);	 
            $tabOrder = [$this->idClient, $this->total];
            $req_prep->execute($tabOrder);

            $lastOrder = self::findLastOrderId();
            $this->id = $lastOrder;
            foreach($this->orderRows as $product => $quantity) {
                $req_prep = Model::getPDO()->prepare($sql2);
                $tabOrder = [$lastOrder, $product, $quantity];
                $req_prep->execute($tabOrder);
            }
            return true;
        }
        catch(PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage();
            }
            else {
                echo 'Error creating order, please contact store administrators';
            }
            return false;
            die();
        }
    }

    public function confirmOrder() {
        $sql = "UPDATE clientOrder SET confirmed=true WHERE id=?";
        try {
            $req_prep = Model::getPDO()->prepare($sql);
            $tabOrder = [$this->id,];
            $req_prep->execute($tabOrder);
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
        $sql = "SELECT MAX(id) AS id FROM clientOrder WHERE idClient=?";
        $req_prep = Model::getPDO()->prepare($sql);	 
        $req_prep->execute([$_SESSION['idClient'],]);
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

    public static function getLastOrderByClientId($idClient) {
        $sql = "SELECT * FROM clientOrder WHERE idClient=:client AND date = (SELECT MAX(date) FROM clientOrder WHERE idClient=:client)";
        $sql2 = "SELECT * FROM orderRow WHERE idOrder=?";
        
        try {
            $req_prep = Model::getPDO()->prepare($sql);	 
            $req_prep->execute(Array('client' => $idClient));
            $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelOrder');
            $order = $req_prep->fetch();
            if (empty($order))
                return false;
            $req_prep = Model::getPDO()->prepare($sql2);
            $req_prep->execute([$order->id,]);
            $req_prep->setFetchMode(PDO::FETCH_OBJ);
            $orderRowsTab = $req_prep->fetchAll();
            $finalOrder = Array();
            foreach($orderRowsTab as $row) {
                $finalOrder[$row->idProduct] = $row->quantity;
            }
            $order->orderRows = $finalOrder;
            return $order;
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
            $req_prep->execute([$idOrder,]);
            $req_prep->setFetchMode(PDO::FETCH_OBJ);
            $orderRowsTab = $req_prep->fetchAll();
            $finalOrder = Array();
            foreach($orderRowsTab as $row) {
                $finalOrder[$row->idProduct] = $row->quantity;
            }
            $order->orderRows = $finalOrder;
            return $order;
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