<?php
require_once File::build_path(['model', 'ModelCustomer.php']);

class ControllerCustomer{
    static $controller = 'customers';

    public static function logIn(){
        if (isset($_POST['login']) && isset($_POST['password'])){
            $customer = ModelCustomer::login($_POST['login'], $_POST['password']);

            if($customer){
                $_SESSION['idClient'] = $customer->getIdClient();
                $_SESSION['login'] = $customer->getLogin();
                $_SESSION['email'] = $customer->getEmail();
                $_SESSION['address'] = $customer->getAddress();
                $_SESSION['phone'] = $customer->getPhone();
                $_SESSION['profileImage'] = $customer->getProfileImage();
            } else {
                $_SESSION['error'] = "Identifiant ou mot de passe incorrect";
            }

            require_once File::build_path(['controller', 'ControllerProduct.php']);

            ControllerProduct::readAll();
        }
    }

    public static function logOut(){
        unset($_SESSION);
        session_destroy();

        require_once File::build_path(['controller', 'ControllerProduct.php']);

        ControllerProduct::readAll();
    }

    public static function signUp(){
        $view = 'signUp';
        $pageTitle = 'Sign up';

        require_once File::build_path(['view', 'view.php']);
    }

    public static function registering(){
        if (isset($_POST['login']) && isset($_POST['password'])
            && isset($_POST['email']) && isset($_POST['emailConfirmation'])){
            if ($_POST['email'] != $_POST['emailConfirmation']){
                $_SESSION['errorRegistering'] = "Write the same email twice.";
            } else if (strlen($_POST['password']) < 7){
                $_SESSION['errorRegistering'] = "Your password should be 7 characters long.";
            }

            $query = Model::getPDO()->prepare("SELECT login FROM clients WHERE login = ?");
            $query->execute([$_POST['login']]);
            $isLogin = $query->fetchAll();

            $query = Model::getPDO()->prepare("SELECT email FROM clients WHERE email = ?");
            $query->execute([$_POST['email']]);
            $isMail = $query->fetchAll();
            var_dump($isLogin);
            var_dump($isMail);

            if (count($isLogin) > 0){
                $_SESSION['errorRegistering'] = "Login already used";
            } else if (count($isMail) > 0){
                $_SESSION['errorRegistering'] = "Email already used";
            }

            if (isset($_SESSION['errorRegistering'])){
                self::signUp();
            } else {
                $query = Model::getPDO()->prepare('INSERT INTO clients (login, password, email, address, phone)
                VALUES (?, ?, ?, ?, ?)');
                $query->execute([$_POST['login'], password_hash($_POST['password']), $_POST['email'],
                    $_POST['address'], $_POST['phone']]);

                self::logIn();
            }
        }
    }
}