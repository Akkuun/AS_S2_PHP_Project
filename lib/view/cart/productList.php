<?php
echo "<table>
        <tr>
            <th>Product</th>
            <th>Quantity</th>
        </tr>";
if (!$cart) {
    echo "</table><h1>You don't have any products in your cart yet</h1>";
}
else {
    foreach ($cart->getProductList as $product => $quantity) {
        echo "<tr><td>$product</td><td>$quantity<td></tr>";
    }
    echo "</table>";
}
?>