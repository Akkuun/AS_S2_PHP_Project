<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo $pagetitle?></title>
</head>
</html>
<header>
    <nav>
        <ul>
            <li><a href="?action=readAll">Products</a></li>
        </ul>
    </nav>
</header>
<body>
<?php
$filepath = File::build_path(["view", $controller, "$view.php"]);
require $filepath;
?>
</body>
<footer>
    <p>EREBOR STORE</p>
</footer>