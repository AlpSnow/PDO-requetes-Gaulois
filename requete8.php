<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style.css">
    <title>requête 8</title>
</head>
<body>
    <main>

        <?php
            require "dbconnect.php";
            $pdo = connect();
        ?>

        <p> <a href="index.php"> Retour à l'accueil </a> </p>


        <h3>8. Nom du ou des personnages qui ont pris le plus de casques dans la bataille "Bataille du village gaulois"	</h3>

        <?php

            $requete = $pdo->query("
                SELECT p.nom_personnage, SUM(pc.qte) AS qttCasque, p.id_personnage
                FROM prendre_casque pc 
                INNER JOIN bataille b ON b.id_bataille = pc.id_bataille 
                INNER JOIN personnage p ON p.id_personnage = pc.id_personnage 
                WHERE b.nom_bataille = 'Bataille du village gaulois' 
                GROUP BY p.nom_personnage, p.id_personnage
                HAVING qttCasque >= ALL ( SELECT SUM(pc.qte) 
                FROM prendre_casque pc 
                INNER JOIN bataille b ON b.id_bataille = pc.id_bataille 
                INNER JOIN personnage p ON p.id_personnage = pc.id_personnage 
                WHERE b.nom_bataille = 'Bataille du village gaulois' 
                GROUP BY p.nom_personnage )
            ");

        ?>

        <p>Il y'a <?= $requete->rowCount() ?> résultats :</p>

        <table>
    
            <thead>
                <tr>
                    <th>Nom du personnage</th>
                    <th>Quantité casque récupérée</th>
                </tr>
            </thead>

            <tbody>
                <?php
                    foreach($requete->fetchAll() as $gaulois){ ?>
                        <tr>
                            <td> <a href="voirPersonnage.php?id_personnage=<?= $gaulois["id_personnage"]?>"> <?= $gaulois["nom_personnage"] ?> </a> </td>
                            <td> <?= $gaulois["qttCasque"] ?> </td>
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

