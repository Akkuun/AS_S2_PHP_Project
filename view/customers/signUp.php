<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./src/styles/styles.css">
    <script src="./src/scripts/scripts.js"></script>
    <title>Authentification</title>
</head>
<body id="LoginScreen">

<div id="CenterSquare">


    <div id="LeftPart">

        <img src="./src/images/productsPictures/cake_minecraft.gif" alt="backgound" id="background_login">
    </div>
    <div id="RightPart">
        <form method="post" action='?action=registering&controller=customers'>
            <div id="Title">Sign Up</div>
            <div class="verticlal">
                <div class="horizontal">
                    <div><input type="text" placeholder="Email or login" class="Information" name="login" required></div>

                </div>
                <div class="horizontal">
                    <div><input type="password" placeholder="Password" name="password" class="Information"></div>

                    <div><input type="email" placeholder="xyz@gmail.com" name="email" class="Information" required></div>
                    <input type="email" id="emailConfirmation" name="emailConfirmation" placeholder="confimation email" required>
                    <input type="text" id="address" name="address" placeholder="Adresse">
                    <input type="tel" id="phone" name="phone" pattern="[0-9]{10}" placeholder="Phone Number">

                    <input type="submit" value="sign in" id="buttonLogin"/>
                    <div class="verticlal">
                        <div id="forgottenID"><a href="?action=logInPage&controller=customers">Go to Log In</div>

                    </div>
                </div>
            </div>

        </form>


    </div>

</div>

</body>
</html>