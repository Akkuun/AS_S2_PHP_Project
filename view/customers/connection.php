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
    <title>Log In</title>
</head>
<body>


<div class="page-container">
            
            <form action="?action=logIn&controller=customers" method="POST">
			<h1>Log In</h1>
                <input type="text" name="login" class="Name" placeholder="Email or login">
				<input type="password" name="password" class="Address" placeholder="password">
                <button type="submit" value="Add" name="submit">Submit</button>
                <a href="?action=signUp&controller=customers" style="color: white">Create your account -></a>
            </form>
</div>
</body>
</html>