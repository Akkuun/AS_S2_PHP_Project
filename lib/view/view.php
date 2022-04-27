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
require File::build_path(["view", self::$controller, "$view.php"]);
?>
</body>
<footer>
    <p>EREBOR STORE</p>
</footer>