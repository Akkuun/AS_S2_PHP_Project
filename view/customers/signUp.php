<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./src/styles/loginStyles.css">
    <!-- <script src="./src/scripts/scripts.js"></script> -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <title>Sign Up</title>
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
                    <div><input type="text" placeholder="Email or login" class="Information" name="login" required></div>

                </div>
                <div class="horizontal">
                    <div><input type="password" placeholder="Password" name="password" class="Information"></div>

                    <div><input type="email" placeholder="xyz@gmail.com" name="password" class="Information" required></div>
                    <input type="email" id="emailConfirmation" name="emailConfirmation" placeholder="confimation email" required>
                    <input type="text" id="address" name="address" placeholder="Adresse">
                    <input type="tel" id="phone" name="phone" pattern="[0-9]{10}" placeholder="Phone Number">

                    <input type="submit" value="sign in" id="buttonLogin"/>
                    <div class="verticlal">
                        <div id="forgottenID"><a href="../user/authentification.php"> go to log In</div>

                    </div>
                </div>
            </div>

        </form>


    </div>

<body>


<div class="page-container">
            
            <form action="?action=registering&controller=customers" method="POST">
			<h1>Sign Up</h1>
                <input type="text" name="login" class="Name" placeholder="Login">
                <input type="text" name="phone" class="Tele" placeholder="Number Phone">
                <input type="text" name="address" class="Address" placeholder="Address">
				<input type="text" name="email" class="Email" placeholder="Email">
                <input type="text" name="emailConfirmation" class="Email" placeholder="Confirm Email">
				<input type="password" name="password" class="Address" placeholder="password">
                <button type="submit" value="Add" name="submit">Submit</button>
                <a href="?action=logInPage&controller=customers" style="color: white">Go to Log In</a>
            </form>

</div>
</body>
</html>