<form method="post" action="?controller=origins&action=created">
    <fieldset>
        <legend>New origin :</legend>
        <p>
            <label for="name">Name :</label>
            <input type="text" id="name" name="name" placeholder="Harry Potter" required>
        </p>
        <p>
            <label for="creator">Creator :</label>
            <input type="text" id="creator" name="creator" placeholder="Coletta" required>
        </p>
        <p>
            <label for="releaseDate">Release date :</label>
            <input type="date" id="releaseDate" name="releaseDate" required>
        </p>
        <p>
            <input type="submit" value="Create">
        </p>
    </fieldset>
</form>