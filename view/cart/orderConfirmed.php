<?php
echo "<h1> Your order was successfully created! Thank you for choosing Erebor merchandise!<h1>
<form action='?action=generatePDF&controller=cart' method='post'>
<input name='order' type='hidden' value='{$order->getId()}'>
	<input type='submit' value='See Receipt'>
</form>"
?>