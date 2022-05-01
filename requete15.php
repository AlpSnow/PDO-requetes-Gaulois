<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style.css">
    <title>requête 15</title>
</head>
<body>
    <main>

        <?php
            require "dbconnect.php";
            $pdo = connect();
        ?>

        <p> <a href="index.php"> Retour à l'accueil </a> </p>


        <h3>15. Nom du / des personnages qui n'ont pas le droit de boire de la potion "Magique"</h3>

        <?php

            $requete = $pdo->query("
                SELECT p.nom_personnage, p.id_personnage
                FROM personnage p
                WHERE p.id_personnage 
                NOT IN (
                SELECT ab.id_personnage
                FROM autoriser_boire ab, potion po
                WHERE ab.id_potion = po.id_potion
                AND po.nom_potion = 'Magique'
                )
            ");

        ?>

        <p>Il y'a <?= $requete->rowCount() ?> résultats :</p>

        <table>
    
            <thead>
                <tr>
                    <th>Nom du personnage</th>
                </tr>
            </thead>

            <tbody>
                <?php
                    foreach($requete->fetchAll() as $gaulois){ ?>
                        <tr>
                            <td> <a href="voirPersonnage.php?id_personnage=<?= $gaulois["id_personnage"]?>"> <?= $gaulois["nom_personnage"] ?> </a> </td>
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

