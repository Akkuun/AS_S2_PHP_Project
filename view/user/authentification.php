<?php
session_start();
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../src/Styles/Styles.css">
    <script src="../../src/Scripts/Scripts.js"></script>
    <title>Authentification</title>
</head>
<body id="LoginScreen">

<div id="CenterSquare">


    <div id="LeftPart">

        <img src="../../src/images/productsPictures/cake_minecraft.gif" alt="backgound" id="background_login">
    </div>
    <div id="RightPart">
        <form method="post" action='?action=logIn&controller=customers'>
            <div id="Title">Member Login</div>
            <div class="verticlal">
                <div class="horizontal">
                    <div><input type="text" placeholder="Email or login" class="Information" name="mail_login"></div>
                    <div><img id="icon_login" src="../../src/images/PageIcons/avatar_icon.png"></div>
                </div>
                <div class="horizontal">
                    <div><input type="password" placeholder="Password" name="password" class="Information"></div>
                    <div><img id="icon_password" src="../../src/images/PageIcons/icon_password.jpg"></div>
                    <input type="submit" value="Log in" id="buttonLogin"/>
                    <div class="verticlal">
                        <div id="forgottenID"><a href=""> forgotten Username / Password ?</div>
                        <div id="createAccount"> <a href="">Create your account -></div>
                    </div>
                </div>
            </div>

        </form>


    </div>

</div>

</body>
</html>