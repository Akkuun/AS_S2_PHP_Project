<?php
require_once File::build_path(['model', 'ModelProduct.php']);

if (isset($products)){
    foreach ($products as $key => $product) {
        echo "<div>";
        echo "<img src='./src/images/productsPictures/" . $product->getImage()."'.>";
        echo "<ul>
            <li>".htmlspecialchars($product->getName())."</li>
            <li>".htmlspecialchars($product->getPrice())."</li>
            <li>".htmlspecialchars($product->getQuantity())."</li>
            <li>".htmlspecialchars($product->getCategory())."</li>
            <li>".htmlspecialchars($product->getOrigin())."</li>
        </ul>";
        echo "</div>";
    }
}
