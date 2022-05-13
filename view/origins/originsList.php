<?php
if (isset($origins)){
    foreach ($origins as $key => $origin){
        echo "<div>";
        echo "<ul>
                <li>".htmlspecialchars($origin->getName())."</li>
                <li>".htmlspecialchars($origin->getCreator())."</li>
                <li>".htmlspecialchars($origin->getReleaseDate())."</li>
              </ul>";
        echo "</div>";
    }
}
?>
