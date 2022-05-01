<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style.css">
    <title>requête 12</title>
</head>
<body>
    <main>

        <?php
            require "dbconnect.php";
            $pdo = connect();
        ?>

        <p> <a href="index.php"> Retour à l'accueil </a> </p>


        <h3>12. Nom des potions dont un des ingrédients est le poisson frais</h3>

        <?php

            $requete = $pdo->query("
                SELECT p.nom_potion, p.id_potion
                FROM potion p, ingredient i, composer c
                WHERE p.id_potion = c.id_potion
                AND i.id_ingredient = c.id_ingredient
                AND i.nom_ingredient = 'Poisson frais'
            ");

        ?>

        <p>Il y'a <?= $requete->rowCount() ?> résultats :</p>

        <table>
    
            <thead>
                <tr>
                    <th>Nom de la potion</th>
                </tr>
            </thead>

            <tbody>
                <?php
                    foreach($requete->fetchAll() as $gaulois){ ?>
                        <tr>
                            <td> <a href="voirPotion.php?id_potion=<?= $gaulois["id_potion"]?>"> <?= $gaulois["nom_potion"] ?> </a> </td>
                        </tr>
                    <?php } ?>
            </tbody>

        </table>

        <?php 
            $requete = null; 
        ?>
        
    </main>
    
</body>
</html>

