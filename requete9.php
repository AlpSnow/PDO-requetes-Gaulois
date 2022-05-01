<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style.css">
    <title>requête 9</title>
</head>
<body>
    <main>
        
        <?php
            require "dbconnect.php";
            $pdo = connect();
        ?>

        <p> <a href="index.php"> Retour à l'accueil </a> </p>


        <h3>9. Nom des personnages et leur quantité de potion bue (en les classant du plus grand buveur au plus petit)</h3>

        <?php

            $requete = $pdo->query("
                SELECT p.nom_personnage, SUM(b.dose_boire) AS qtt, p.id_personnage
                FROM personnage p, boire b
                WHERE p.id_personnage = b.id_personnage
                GROUP BY p.nom_personnage, p.id_personnage
                ORDER BY qtt DESC
            ");

        ?>

        <p>Il y'a <?= $requete->rowCount() ?> résultats :</p>

        <table>
    
            <thead>
                <tr>
                    <th>Nom du personnage</th>
                    <th>Quantité potion bue</th>
                </tr>
            </thead>

            <tbody>
                <?php
                    foreach($requete->fetchAll() as $gaulois){ ?>
                        <tr>
                            <td> <a href="voirPersonnage.php?id_personnage=<?= $gaulois["id_personnage"]?>"> <?= $gaulois["nom_personnage"] ?> </a> </td>
                            <td> <?= $gaulois["qtt"] ?> </td>
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
