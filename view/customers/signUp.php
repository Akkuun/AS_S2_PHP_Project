<form method="post" action="?action=registering&controller=customers">
    <fieldset>
        <legend>Sign up :</legend>

        <p>
            <label for="login">Login :</label>
            <input type="text" id="login" name="login" placeholder="toto" required>
        </p>
        <p>
            <label for="password">Password :</label>
            <input type="password" id="password" name="password" required>
        </p>
        <p>
            <label for="email">Email :</label>
            <input type="email" id="email" name="email" placeholder="xyz@gmail.com" required>
            <label for="emailConfirmation">Email :</label>
            <input type="email" id="emailConfirmation" name="emailConfirmation" placeholder="xyz@gmail.com" required>
        </p>
        <p>
            <label for="address">Address :</label>
            <input type="text" id="address" name="address" placeholder="Montpellier">
        </p>
        <p>
            <label for="phone">Phone number :</label>
            <input type="tel" id="phone" name="phone" pattern="[0-9]{10}" placeholder="0601020304">
        </p>
        <p>
            <input type="submit" value="Sign in">
        </p>
        <?php
        if (isset($_SESSION['errorRegistering'])){
            echo "<p>".$_SESSION['errorRegistering']."</p>";
            unset($_SESSION['errorRegistering']);
        }
        ?>
    </fieldset>
</form>
