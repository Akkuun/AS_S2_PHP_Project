<?php
if (isset($categories)){
    foreach ($categories as $key => $category){
        echo "<div>";
        echo "<ul>
                <li>".htmlspecialchars($category->getName())."</li>
              </ul>";
        echo "</div>";
    }
}
