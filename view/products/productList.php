
<?php
require_once File::build_path(['model', 'ModelProduct.php']);

if (isset($products)) {
    foreach ($products as $key => $product) {
        $img=$product->getImage();
        echo "<div class='flex-item'>";
        echo "<div class='carre'>";
        echo "<div class='card mx-auto col-md-3 col-10 mt-5'>";
        echo "<img class='mx-auto img-thumbnail'
                src='./src/images/productsPictures/$img'
                width='auto' height='auto'/>";
        echo " <div class='card-body text-center mx-auto'>";
        echo " <div class='cvp'>";
        echo "<p class ='card-title font-weight-bold'><a href='?action=read&name=".$product->getName()."'>" .$product->getName() . "</a></p>";
        echo "<p class='card-text>'" . $product->getPrice() . " €</p>";
        echo "<a href='?action=addProduct&controller=cart&idProduct=".$product->getId()."'>Ajouter au panier</a>";
        if(isset($_SESSION['type']) && $_SESSION['type'] == 'admin'){
            echo "<a href='?action=delete&idPct=".rawurlencode($product->getId())."'>Delete</a></li>";
            echo "<a href='?action=update&name=".htmlspecialchars($product->getName())."'>Edit</a>";
        }
        echo " </div>";
        echo " </div>";
        echo " </div>";
        echo " </div>";
        echo " </div>";
    }

}
?>
