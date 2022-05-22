<?php
require_once File::build_path(['model', 'ModelCustomer.php']);

class ControllerCustomer{
    static $controller = 'customers';

    public static function logIn(){
        if (isset($_POST['login']) && isset($_POST['password'])){
            $customer = ModelCustomer::login($_POST['login'], $_POST['password']);
            if($customer){
                if (isset($_SESSION['cart'])) {
                    $oldcart = $_SESSION['cart'];
                }
                $_SESSION['idClient'] = $customer->getIdClient();
                $_SESSION['login'] = $customer->getLogin();
                $_SESSION['email'] = $customer->getEmail();
                $_SESSION['type'] = $customer->getType();
                $_SESSION['address'] = $customer->getAddress();
                $_SESSION['phone'] = $customer->getPhone();
                $_SESSION['profileImage'] = $customer->getProfileImage();
                $_SESSION['cart'] = $customer->getCart();
            } else {
                $_SESSION['error'] = "Identifiant ou mot de passe incorrect";
            }
            if (isset($oldcart)) {
                require_once File::build_path(['model', 'ModelCart.php']);
                foreach($oldcart as $product => $quantity) {
                    ModelCart::addProduct($product, $quantity);
                }
            }
            if (isset($_SESSION['buying']) && $_SESSION['buying']) {
                $_SESSION['buying'] = false;
                require_once File::build_path(['controller', 'ControllerCart.php']);
                ControllerCart::convertToOrder();
            }
            else {
                require_once File::build_path(['controller', 'ControllerProduct.php']);
                ControllerProduct::readAll();
            }
        }
    }

    public static function logInPage() {
        require_once File::build_path(['view', 'customers', 'connection.php']);
    }

    public static function logOut(){
        unset($_SESSION);
        session_destroy();

        require_once File::build_path(['controller', 'ControllerProduct.php']);

        ControllerProduct::readAll();
    }

    public static function signUp(){
        require_once File::build_path(['view', 'customers', 'signUp.php']);
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

            if (count($isLogin) > 0){
                $_SESSION['errorRegistering'] = "Login already used";
            } else if (count($isMail) > 0){
                $_SESSION['errorRegistering'] = "Email already used";
            }

            require_once File::build_path(['model', 'ModelMail.php']);
            $mail = new ModelMail(['to' => $_POST['email'],
                'subject' => 'Registeration to Erebor Store',
                'message' => 'Congratulations ! you\'re successfully registered to Erebor store !',
                'header' => ['From' => 'noreply@erebor-store.com']]);

            if (!$mail->send()){
                $_SESSION['errorRegistering'] = "There was a problem with your adress mail.";
            }

            if (isset($_SESSION['errorRegistering'])){
                self::signUp();
            } else {
                $customer = new ModelCustomer([
                    'login' => $_POST['login'],
                    'type' => 'user',
                    'email' => $_POST['email'],
                    'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                    'address' => $_POST['address'],
                    'phone' => $_POST['phone']
                ]);

                $customer->save();

                self::logInPage();
            }
        }
        else {
            self::signUp();
        }
    }

    public static function read(){
        if (isset($_SESSION['idClient'])){
            $view = 'profile';
            $pageTitle = $_SESSION['login'];

            require_once File::build_path(['view', 'view.php']);
        } else {
            require_once File::build_path(['controller', 'ControllerProduct']);
            ControllerProduct::readAll();
        }
    }

    public static function admin(){
        if (isset($_SESSION['type']) && $_SESSION['type'] == 'admin'){
            $view = 'admin';
            $pageTitle = 'Admin page';

            require_once File::build_path(['view', 'view.php']);
        } else {
            require_once File::build_path(['controller', 'ControllerProduct']);
            ControllerProduct::readAll();
        }
    }
}
