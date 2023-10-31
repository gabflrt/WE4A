
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/style.css">
    <link rel="stylesheet" href="./styles/accueil.css">

    <style>
        .command-container {
            border: 1px solid #ccc;
            padding: 10px;
            margin: 10px;
            background-color: #f9f9f9;
        }

        .info-row {
            margin-bottom: 10px;
            border-bottom: 1px solid #ccc; 

        }
    </style>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <?php include("./pagesParts/header.php"); ?>
    <div class="content">

        <?php
            //si connecté en tant que client
            if (isset($_SESSION['admin']) && $_SESSION['admin'] == 0){
                echo "<h1>Vos commandes précédentes</h1>";
                echo "<p>Voici les commandes que vous avez passées sur notre site.</p>";
                echo "<br>";
            }
        ?>
    <?php include("./pagesParts/footer.php"); ?>
    </div>
</body>