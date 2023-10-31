<div class="presentation">
<div class="contenu_plat">
    <form method="post" action="../includes/ajout_plat.php" enctype="multipart/form-data">
        <label for="nom">Nom :</label>
        <input type="text" name="nom" value="nom"><br>
        <label for="description">Description :</label>
        <textarea name="description">description</textarea><br>
        <label for="prix">Prix :</label>
        <input type="number" name="prix" value="prix"><br>
        <label for="chaud">Chaud :</label>
        <input type="checkbox" name="chaud" value="1"><br>
        <label for="image">Image :</label>
        <input type="file" name="image"><br>
        <input type="submit" value="Modifier">
    </form>
</div>
</div>
