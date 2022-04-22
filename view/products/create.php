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
            <input type="number" placeholder="49.99" name="price" id="price">
        </p>
        <p>
            <label for="quantity">Quantity</label> :
            <input type="number" placeholder="49.99" name="quantity" id="quantity">
        </p>
        <p>
            <label for="image">Image</label> :
            <input type="file" placeholder="49.99" name="image" id="image">
        </p>
        <p>
            <input type="submit" value="Envoyer" />
        </p>
    </fieldset>
</form>