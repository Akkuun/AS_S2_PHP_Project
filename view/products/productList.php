
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
        echo "<h5 class ='card-title font-weight-bold'" .$product->getName() . "</h5>";
        echo "<p class='card-text>'" . $product->getPrice() . "</p>";
        echo "<a href='#' class='btn details px-auto'>" .$product->getDescription() . "</a><br/>";
        echo "<a href='#' class='btn cart px-auto'>+</a>";
        echo " </div>";
        echo " </div>";
        echo " </div>";
        echo " </div>";
        echo " </div>";
    }

}
?>
