<form method="post" action="?action=created">
    <fieldset>
        <legend>New products :</legend>
        <p>
            <label for="name">Name</label> :
            <input type="text" placeholder="Enchanted ring" name="name" id="name">
        </p>
        <p>
            <label for="description">Description</label> :
            <textarea type="text" placeholder="Rose" name="description" id="description">
                Unlock your thief skills,
                Awake your true power,
                Reveal your destiny,
                Or any bullshit like this...
            </textarea>
        </p>
        <p>
            <label for="price">Price</label> :
            <input type="number" placeholder="49.99" name="price" id="price" required>
        </p>
        <p>
            <label for="quantity">Quantity</label> :
            <input type="number" placeholder="10" name="quantity" id="quantity" required>
        </p>
        <p>
            <label for="image">Image</label> :
            <input type="text" placeholder="name.format" name="image" id="image" required>
        </p>
        <p>
            <label>Select the origin : </label>
            <!-- Insert code which is looking for all the origins in the database -->
            <!-- name of the input mark-up has to be 'orgigin' -->
        </p>
        <p>
            <label>Select the category : </label>
            <!-- Insert code which is looking for all the categories in the database -->
            <!-- name of the input mark_up has to be 'category' -->

            <?php
            require_once File::build_path(['model', 'ModelCategory.php']);

            $categories = ModelCategory::getAllCategories();

            foreach ($categories as $key => $category){
                $nameToLower = htmlspecialchars(strtolower($category->getName()));
                echo "<div>";
                echo "<input type='radio' id='".$nameToLower."' name='category' value='".$category->getId()."'>";
                echo "<label for='".$nameToLower."'>".htmlspecialchars($category->getName())."</label>";
                echo "</div>";
                }
            ?>
        </p>
        <p>
            <input type="submit" value="Envoyer" />
        </p>
    </fieldset>
</form>