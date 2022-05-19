<?php

if (isset($tags)){
    foreach ($tags as $key => $tag){
        echo "<li><a>".htmlspecialchars($tag->getNameTag())."</a></li>";
    }
    if(isset($_SESSION['type']) && $_SESSION['type'] == 'admin'){
        echo "<a href='?action=delete&idTag=".rawurlencode($tag->getId())."&controller=tags'>Delete</a></li>";
    }
    echo "</div>";
}
?>
