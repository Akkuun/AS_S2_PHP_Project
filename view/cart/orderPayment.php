<script src="https://www.paypal.com/sdk/js?client-id=AXkxsg5xJdF_FQy_itI1_-nCuilAj6_X_onv32UUS9E3HiLze2wQrdi8t4C5KPV4VZaGBRqSnSTltMJ1&currency=EUR"></script>
    <!-- Set up a container element for the button -->
    <div id="paypal-button-container"></div>
    <h2>Pay your order</h2>
    <script>
      paypal.Buttons({
        // Sets up the transaction when a payment button is clicked
        createOrder: (data, actions) => {
          return actions.order.create({
            purchase_units: [{
              amount: {
                value: '<?php echo $order->getTotal() ?>' // Can also reference a variable or function
              }
            }]
          });
        },
        // Finalize the transaction after payer approval
        onApprove: (data, actions) => {
          return actions.order.capture().then(function(orderData) {
            // Successful capture! For dev/demo purposes:
            console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
            const transaction = orderData.purchase_units[0].payments.captures[0];
            alert(`Transaction ${transaction.status}: ${transaction.id}\n\nSee console for all available details`);
            // When ready to go live, remove the alert and show a success message within this page. For example:
            // const element = document.getElementById('paypal-button-container');
            // element.innerHTML = '<h3>Thank you for your payment!</h3>';
            actions.redirect('https://webinfo.iutmontp.univ-montp2.fr/~TSETSERAVAD/Erebor/?action=confirmOrder&controller=cart&orderId=<?php echo $order->getId()?>');
          });
        }
      }).render('#paypal-button-container');
</script>