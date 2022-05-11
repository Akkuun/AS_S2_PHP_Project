<?php
echo "<table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Unit price</th>
                <th>Price</th>
            </tr>
        </thead>";
if (empty($_SESSION['cart'])) {
    echo "</table><h1>You don't have any products in your cart yet</h1>";
    echo "<h1><a href='?action=readAll'>Go to the shop</a></h1>";
} else {
    echo "<tbody>";
    require_once File::build_path(['model', 'ModelProduct.php']);
    foreach ($_SESSION['cart'] as $key => $quantity) {
        $product = ModelProduct::getProductById($key);
        echo "<tr>
            <td>".$product->getName()."</td>
            <td>".$quantity."</td>
            <td>".$product->getPrice()."</td>
            <td>".$quantity*$product->getPrice()."</td>
            <td><a href='?action=addProduct&from=cart&controller=cart&idProduct=".$product->getId()."'>+</a></td>
            <td><a href='?action=removeProduct&from=cart&controller=cart&idProduct=".$product->getId()."'>-</a></td>
            </tr>";
    }
    echo "</tbody></table>";
    echo "<p><a href='?action=readAll'>Go to shopping</a></p>";
}
?>