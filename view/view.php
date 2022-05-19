<?php
    require_once File::build_path(['model', 'ModelCategory.php']);
    require_once File::build_path(['model', 'ModelTag.php']);
?>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo $pageTitle?></title>
</head>
</html>
<header>
    <?php
    if (!isset($_SESSION['login'])){
        echo "<form method='post' action='?action=logIn&controller=customers'>
                <table>
                    <tr>
                        <td>
                            <label for='login'>Login :</label>
                        </td>
                        <td>
                            <label for='password'>Password :</label>                   
                        </td>
                    </tr>
                    <tr>    
                        <td>                
                            <input type='text' id='login' name='login'>
                        </td>
                        <td>
                            <input type='password' id='password' name='password'>
                        <td>
                        <td>
                            <input type='submit' value='Log in'>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Not registered ? <a href='?controller=customers&action=signUp'>Click here</a>
                        </td>
                    </tr>
                </table>
               </form>";
    } else {
        require_once File::build_path(['model', 'ModelCustomer.php']);

        echo "<table>";
        echo "<tr>
                <td><img src=''></td>
              </tr>
              <tr>
                <td>".htmlspecialchars($_SESSION['login'])."</td>
                <td><a href='?controller=customers&action=logOut'>Log out</a></td>
              </tr>";
        echo "</table>";
    }
    if (isset($_SESSION['error'])){
        echo "<p>".htmlspecialchars($_SESSION['error'])."</p>";
        unset($_SESSION['error']);
    }
    ?>
    <nav>
        <ul>
            <li><a href="?action=readAll">Products</a></li>
            <li><a href="?action=read&controller=cart">Cart</a></li>
            <li>Category</li>
            <?php
                $categories = ModelCategory::getAllCategories();
                foreach ($categories as $key => $category){
                    echo "<li><a href='?action=filterByCategory&category=".htmlspecialchars($category->getId())."'>".htmlspecialchars($category->getName())."</a></li>";
                }
            ?>
            <li>Tags</li>
            <?php
                $tags = ModelTag::getAllTags();
                foreach ($tags as $key => $tag){
                    echo "<li><a href='?action=getAllProductByTag&tag=".htmlspecialchars($tag->getId())."'>".htmlspecialchars($tag->getNameTag())."</a></li>";
                }
                if (isset($_SESSION['idClient'])){
                    echo "<li><a href='?action=read&controller=customers'>My Profile</a></li>";
                    if ($_SESSION['type'] == 'admin'){
                        echo "<li><a href='?action=admin&controller=customers'>Admin</a></li>";
                    }
                }
            ?>
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