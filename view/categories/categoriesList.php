<?php
if (isset($categories)){
    foreach ($categories as $key => $category){
        echo "<div>";
        echo "<ul>
                <li>".htmlspecialchars($category->getName())."</li>
              </ul>";
        if(isset($_SESSION['type']) && $_SESSION['type'] == 'admin'){
            echo "<a href='?action=delete&idCtg=".rawurlencode($category->getId())."&controller=categories'>Delete</a></li>";
        }
        echo "</div>";
    }
}
