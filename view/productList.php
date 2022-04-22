<?php
echo "<table>
        <tr>
            <th>Product</th>
            <th>Quantity</th>
        </tr>";
foreach ($cart->getProductList as $product => $quantity) {
    echo "<tr><td>$product</td><td>$quantity<td></tr>";
}
echo "</table>";
?>