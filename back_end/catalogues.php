<?php
session_start();

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['mail'])) {
    // Redirige vers la page d'accueil du back end si l'utilisateur n'est pas connecté
    header('Location: ./accueil.php');
    exit;
}
// Vérifie si l'utilisateur est un client
if ($_SESSION['admin'] == 0) {
    // Redirige vers la page d'accueil du front end si l'utilisateur est un client
    header('Location: ../index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="../styles/produits.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Gestion catalogues</title>
</head>

<body>

    <?php include("./back_header.php"); ?>

    <style>
    .type-box{
        background-color: #f2f2f2;
        border: 1px solid #ccc;
        padding: 20px;
        margin-bottom: 10px;
        border-radius: 5px;
        box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
    }

    

    .type-box .btn_rename {
        background-color: #4CAF50;

    }

    .type-box .btn_delete {
        background-color: #f44336;
    }

    .type-box .btn_rename:hover {
        background-color: #45a049;
    }

    .type-box .btn_delete:hover  {
        background-color: #8b0000;
    }
    </style>
    <div id="ajouttype">
        <h1>Liste des types déjà existants</h1>
        <?php
        
            $recup_type = $db->prepare("SELECT type FROM plats");
            $recup_type->execute();
            $types = $recup_type->fetchAll(PDO::FETCH_ASSOC);

        $type_counts = array_count_values(array_column($types, 'type'));
        foreach ($type_counts as $type => $count) {
            echo '<div class="type-box">';
            echo '<h3 class="type-name">'.$type.'</h3> <br> <p>' . $count . ' produits </p><br>';
            echo '<button class="btn_rename" onClick="renameCatalog(this)">Renommer</button>'; 
            echo '<button class="btn_delete" onClick="deleteCatalog(this)">Supprimer</button>';            
            echo '</div>';
        }
        
        ?>
        <br>
        <br>

        <script>
    function renameCatalog(button) {
        var typeBox = button.parentNode;
        var typeHeader = typeBox.querySelector('.type-name');

        if (!typeHeader.querySelector('input')) {
            var currentName = typeHeader.innerText;
            var inputField = document.createElement('input');
            inputField.type = 'text';
            inputField.value = currentName;
            typeHeader.innerHTML = '';
            typeHeader.appendChild(inputField);
            inputField.focus();
            inputField.setSelectionRange(0, inputField.value.length); 
            
            button.removeEventListener('click', renameCatalog);
            button.addEventListener('click', function() {
                var newName = inputField.value.trim();
                if (newName !== '') {
                    typeHeader.innerText = newName;
                    //AJAX call ici et update en BDD
                } else {
                    typeHeader.innerText = currentName;
                } 
                button.removeEventListener('click', arguments.callee);
                button.addEventListener('click', renameCatalog);
            });

            inputField.addEventListener('blur', function() {
                inputField.focus();
            });
        }
    }

    function deleteCatalog(button) {
        var typeBox = button.parentNode;
        var typeToDelete = typeBox.querySelector('.type-name').innerText;

        if (confirm('Voulez-vous vraiment supprimer le type suivant :  ' + typeToDelete + '?')) {
            typeBox.remove();
            //AJAX call ici et supprimer en BDD
        }
    }
</script>

        <h1>Ajout d'un nouveau type</h1>
        <div class="presentation">
        <div class="contenu_plat">
        <form method="post" action="../includes/ajout_type.php" enctype="multipart/form-data">
            <label for="Type">Nouveau type :</label>
            <input type="text" name="type"><br>
            <p>Ajout d'un premier produit pour l'enregistrement :</p><br>
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
            <input type="submit" value="Ajouter">
        </form>
        </div>
        </div>
    </div>
    

<?php include("./back_footer.php"); ?>

    </body>
</html>
