<?php
if (isset($origins)){
    foreach ($origins as $key => $origin){
        echo "<div>";
        echo "<ul>
                <li>".htmlspecialchars($origin->getName())."
                <li>".htmlspecialchars($origin->getCreator())."</li>
                <li>".htmlspecialchars($origin->getReleaseDate())."</li>
              </ul>";
        if(isset($_SESSION['type']) && $_SESSION['type'] == 'admin'){
            echo "<a href='?action=delete&idOgn=".rawurlencode($origin->getId())."&controller=origins'>Delete</a></li>";
        }
        echo "</div>";
    }
}
?>
