<?php
require_once File::build_path(['model', 'ModelCategory.php']);

$pathCss = File::build_path(['src', 'styles', 'styles.css']);

require_once File::build_path(['model', 'ModelTag.php']);
echo "<html>

   


<head>
    <meta charset='UTF-8'>
    <title> $pageTitle </title>
    <!-- CSS only -->
<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor' crossorigin='anonymous'>
    <link rel='stylesheet' href='./src/styles/styles.css'>
 <!-- JavaScript Bundle with Popper -->
<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js' integrity='sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2' crossorigin='anonymous'></script>
    
</head>

<header>";


if (!isset($_SESSION['login'])) {
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
                            Not registered ? <a href='view/user/authentification.php'>Click here</a>
                        </td>
                    </tr>
                </table>
               </form>";
} else {
    require_once File::build_path(['model', 'ModelCustomer.php']);

    echo "<table id='loginView'>";
    echo "
                <td><img src=''></td>
              </tr>
              <tr>
                <td>" . htmlspecialchars($_SESSION['login']) . "</td>
                <td><a href='?controller=customers&action=logOut'>Log out</a></td>
              </tr>";

    echo "</table>";
}
if (isset($_SESSION['error'])) {
    echo "<p>" . htmlspecialchars($_SESSION['error']) . "</p>";
    unset($_SESSION['error']);
}

?>
<nav class="navbar bg-light fixed-top">

        <div class="container-fluid">Erebor store</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="">Home</a>
                        </li>

                        <?php if (!isset($_SESSION['idClient'])) {
                            echo "<li class='nav-item'>
                            <a class='nav-link' href='?action=logInPage&controller=customers'>Connexion</a>
                        </li>";
                            }
                            ?>


                            <li class="nav-item">
                            <a class="nav-link" href="view/user/authentification.php">Connexion</a>
                        </li>




                        <li class="nav-item">
                            <a class="nav-link" href="?action=read&controller=cart">Cart</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="offcanvasNavbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Search by categorie
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="offcanvasNavbarDropdown">
                                <?php
                                $categories = ModelCategory::getAllCategories();
                                foreach ($categories as $key => $category) {
                                    echo "<li> <a class='dropdown-item' href='#'>".$category->getName()."</a></li>";
                                }
                                ?>
                            </ul>
                        </li>
                        <!-- <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="offcanvasNavbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Search by tag
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="offcanvasNavbarDropdown">
                                <?php
                                //$categories = ModelCategory::getAllCategories();
                                //foreach ($categories as $key => $category) {
                                //    echo "<li> <a class='dropdown-item' href='#'>".$category->getName()."</a></li>";
                                //}
                                ?>
                            </ul>
                        </li> -->
                        <?php
                        if (isset($_SESSION['idClient'])) {
                            echo "
                            <li class='nav-item'>
                                <a class='nav-link' href='?controller=customers&action=logOut'>Log Out</a>
                            </li>";
                            echo "
                            <li class='nav-item'>
                                <a class='nav-link' href='?action=read&controller=customers'>My Profile</a>
                            </li>";
                            if ($_SESSION['type'] == 'admin') {
                                echo "
                                <li class='nav-item'>
                                    <a class='nav-link' href='?action=admin&controller=customers'>Admin</a>
                                </li>";
                            }
                        }
                     ?>
                     </ul>
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </div>
</nav>

<?php
if (isset($_SESSION['error'])) {
    echo "<p>" . htmlspecialchars($_SESSION['error']) . "</p>";
    unset($_SESSION['error']);
}
?>
<!-- <br><br><br><br>
    <ul>
        <li><a href="?action=readAll">Products</a></li>
        <li><a href="?action=read&controller=cart">Cart</a></li>
        <li>Category</li>
        <?php

        ?>
        <li>Tags</li>
        <?php
        // $tags = ModelTag::getAllTags();
        // foreach ($tags as $key => $tag) {
        //     echo "<li><a href='?action=getAllProductByTag&tag=" . htmlspecialchars($tag->getId()) . "'>" . htmlspecialchars($tag->getNameTag()) . "</a></li>";
        // }
        // if (isset($_SESSION['idClient'])) {
        //     echo "<li><a href='?action=read&controller=customers'>My Profile</a></li>";
        //     if ($_SESSION['type'] == 'admin') {
        //         echo "<li><a href='?action=admin&controller=customers'>Admin</a></li>";
        //     }
        // }
        ?>
    </ul> -->

</header>
<body>

<div class="container-md with-nav">
    <?php
    require File::build_path(["view", self::$controller, "$view.php"]);
    ?>
</div>
</body>
<footer>
   <p> Erebor Store</p>
    <p> Copyright © 2022</p>
    <div class="f_text">
    <a href="">Nous contacter</a>
        <a> |</a>
    <a>Private policy </a>
    </div>
</footer>
</html>