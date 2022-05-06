<?php
if (isset($_SESSION['idClient'])){
    echo "<h1>".htmlspecialchars($_SESSION['login'])."</h1>";
}
