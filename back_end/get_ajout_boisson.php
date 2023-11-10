<div class="presentation">
<div class="contenu_plat">
    <form method="post" action="../includes/ajout_boisson.php" enctype="multipart/form-data">
        <label for="nom">Nom :</label>
        <input type="text" name="nom" value="Nom de la boisson"><br>
        <label for="description">Description :</label>
        <textarea name="description">Description</textarea><br>
        <label for="prix">Prix :</label>
        <input type="number" name="prix" value="Prix"><br>
        <label for="volume_cl">Volume (en cl) :</label>
        <input type="number" name="volume_cl" value="Volume"><br>
        <label for="alcool">alcool :</label>
        <input type="checkbox" name="alcool" value="1"><br>
        <label for="image">Image :</label>
        <input type="file" name="image"><br>
        <input type="submit" value="Ajouter">
    </form>
</div>
</div>
