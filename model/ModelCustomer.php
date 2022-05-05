<?php
require_once File::build_path(['model', 'Model.php']);

class ModelCustomer{
    private $idClient;
    private $login;
    private $email;
    private $type;
    private $password;
    private $address;
    private $phone;
    private $profileImage;
    private $cart;

    public function __construct($datas = NULL){
        if (!is_null($datas)){
            if(isset($datas['idClient'])){
                $this->idClient = $datas['idClient'];
            }
            $this->login = $datas['login'];
            $this->type = $datas['type'];
            $this->email = $datas['email'];
            $this->password = $datas['password'];
            $this->address = $datas['address'];
            $this->phone = $datas['phone'];
        }
    }

    public function getIdClient()
    {
        return $this->idClient;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function getProfileImage()
    {
        return $this->profileImage;
    }

    public function getCart(){
        require_once File::build_path(['model', 'ModelCart.php']);
        $this->cart = ModelCart::getCartByClientId($this->idClient);
    }

    public static function login($login, $password){
        $query = Model::getPDO()->prepare('SELECT * FROM clients
            WHERE login = ? OR email = ?');
        $query->execute([$login, $login]);
        $query->setFetchMode(PDO::FETCH_CLASS, 'ModelCustomer');

        $customer = $query->fetchAll();

        if(count($customer) == 0 || !password_verify($password, $customer[0]->getPassword())){
            $customer[0] = false;
        }

        return $customer[0];
    }

    public function save(){
        $query = Model::getPDO()->prepare("INSERT INTO clients
            (login, type, email, password, address, phone, profileImage)
            VALUES(?, ?, ?, ?, ?, ?, ?)");

        $query->execute([$this->login, $this->type, $this->email,$this->password,
            $this->address, $this->phone, $this->profileImage]);
    }


}
