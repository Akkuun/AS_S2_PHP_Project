<?php
require_once File::build_path(array("model", "Model.php"));
$pdo = Model::getPDO();
var_dump($pdo);
$login = $_POST['mail_login'];
$password = $_POST['password'];

$query = $pdo->prepare("SELECT *
FROM user
WHERE login = ?
AND mdp = ?");

$query->execute(([$login,
    $password]));

$result=$query->fetch();

if (!empty($result)) {
    $_SESSION['login'] = $result['login'];
    $_SESSION['password'] = $result['password'];
    header("Location:../index.php");
} else {
    $_SESSION['error'] = "Login ou mdp incorrect";
    header("Location:../Controller/connexion.php");
}


?>
