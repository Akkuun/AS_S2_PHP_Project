<form method="post" action="?action=filteredByTag">
    <fieldset>
        <legend>Select tags you're looking for : </legend>
        <p>
            <?php
            require_once  File::build_path(['model', 'ModelTag.php']);

            $tags = ModelTag::getAllTags();

            foreach ($tags as $key => $tag){
                $nameToLower = htmlspecialchars($tag->getNameTag());
                echo "<div>";
                echo "<input type='checkbox' id='$nameToLower' name='tags[]' value='{$tag->getId()}'";
                echo "<label for='$nameToLower'>".htmlspecialchars($tag->getNameTag())."</label>";
                echo "</div>";
            }
            ?>
        </p>
        <p>
            <input type="submit" value="Filter">
        </p>
    </fieldset>
</form>