<?php
require_once File::build_path(['model', 'ModelProduct.php']);

if (isset($products)){
    foreach ($products as $key => $product) {
        echo "<div class='product'>";
        echo "<img src='./src/images/productsPictures/" . $product->getImage()."'.>";
        echo "<ul>
            <li><a href='?action=read&name=".rawurlencode($product->getName())."'>".htmlspecialchars($product->getName())."</a></li>
            <li>".htmlspecialchars($product->getPrice())."</li>";
        if (isset($_SESSION['idClient'])){
            echo "<li><a href='?action=addProduct&controller=cart&idProduct=".$product->getId()."'>+</a></li>";
        }
        echo "</ul>";
        if(isset($_SESSION['type']) && $_SESSION['type'] == 'admin'){
            echo "<a href='?action=delete&idPct=".rawurlencode($product->getId())."'>Delete</a></li>";
        }
        echo "</div>";
    }

}
