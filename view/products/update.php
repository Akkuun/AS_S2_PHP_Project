<?php
if (isset($product)) {
    echo "<form method='post' action='?action=updated'>
    <fieldset>
        <p>
            <label for='name'>Name</label> :
            <input type='text' value='".htmlspecialchars($product->getName())."' name='name' id='name'>
        </p>
        <p>
            <label for='description'>Description</label> :
            <textarea type='text' name='description' id='description'>"
                .htmlspecialchars($product->getDescription()).
            "</textarea>
        </p>
        <p>
            <label for='price'>Price</label> :
            <input type='number' value='".htmlspecialchars($product->getPrice())."' name='price' id='price' required>
        </p>
        <p>
            <label for='quantity'>Quantity</label> :
            <input type='number' value='".htmlspecialchars($product->getQuantity())."' name='quantity' id='quantity' required>
        </p>
        <p>
            <label for='image'>Image</label> :
            <input type='text' value='".htmlspecialchars($product->getImage())."' name='image' id='image' required>
        </p>
        <input type='text' name='id' value='".htmlspecialchars($product->getId())."' hidden>
        <p>
            <label>Select the origin : </label>
            <!-- Insert code which is looking for all the origins in the database -->
            <!-- name of the input mark-up has to be 'orgigin' -->";
            require_once File::build_path(['model', 'ModelOrigin.php']);

            $origins = ModelOrigin::getAllOrigins();

            foreach ($origins as $key => $origin){
                $nameToLower = htmlspecialchars(strtolower($origin->getName()));
                echo "<div>";
                if (!is_null($product->getOrigin()) && $origin->getName() == $product->getOrigin()){
                    echo "<input type='radio' id='".$nameToLower."' name='origin' value='".$origin->getId()."' checked>";
                } else {
                    echo "<input type='radio' id='".$nameToLower."' name='origin' value='".$origin->getId()."'>";
                }
                echo "<label for='".$nameToLower."'>".htmlspecialchars($origin->getName())."</label>";
                echo "</div>";
            }

        echo "</p>
        <p>
            <label>Select the category : </label>
            <!-- Insert code which is looking for all the categories in the database -->
            <!-- name of the input mark_up has to be 'category' -->";

            require_once File::build_path(['model', 'ModelCategory.php']);

            $categories = ModelCategory::getAllCategories();

            foreach ($categories as $key => $category){
                $nameToLower = htmlspecialchars(strtolower($category->getName()));
                echo "<div>";
                if (!is_null($product->getCategory()) && $category->getName() == $product->getCategory()){
                    echo "<input type='radio' id='".$nameToLower."' name='category' value='".$category->getId()."' checked>";
                } else {
                    echo "<input type='radio' id='".$nameToLower."' name='category' value='".$category->getId()."'>";
                }
                echo "<label for='".$nameToLower."'>".htmlspecialchars($category->getName())."</label>";
                echo "</div>";
                }
        echo "</p>
        <p>
            <input type='submit' value='Update' />
        </p>
    </fieldset>
</form>";
}


    ?>