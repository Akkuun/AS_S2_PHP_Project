<?php
require_once File::build_path(['model', 'ModelProduct.php']);

if (isset($products)){
    foreach ($products as $key => $product) {
        echo "<div class='product'>";
        echo "<img src='./src/images/productsPictures/" . $product->getImage()."'.>";
        echo "<ul>
            <li><a href='?action=read&name=".rawurlencode($product->getName())."'>".htmlspecialchars($product->getName())."</a></li>
            <li>".htmlspecialchars($product->getPrice())."</li>
        </ul>";
        echo "</div>";
    }
}
