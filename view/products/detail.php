<?php
require_once File::build_path(['model', 'ModelProduct.php']);

if (isset($product)){
    echo "<div>";
    echo "<img src='./src/images/productsPictures/".$product->getImage()."'>";
    echo "<h1>".$product->getName()."</h1>
            <h2>From :".$product->getOrigin()."</h2>
            <p>".$product->getDescription()."</p>
            <p>Prix : ".$product->getPrice()."</p>";
    echo "</div>";
}