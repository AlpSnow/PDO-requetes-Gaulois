<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style.css">
    <title>requête 13</title>
</head>
<body>
    <main>

        <?php
            require "dbconnect.php";
            $pdo = connect();
        ?>

        <p> <a href="index.php"> Retour à l'accueil </a> </p>


        <h3>13. Nom du / des lieu(x) possédant le plus d'habitants, en dehors du village gaulois</h3>

        <?php

            $requete = $pdo->query("
                SELECT l.nom_lieu, COUNT(p.id_personnage) AS nbPerso, l.id_lieu
                FROM personnage p, lieu l
                WHERE p.id_lieu = l.id_lieu
                AND l.nom_lieu != 'Village gaulois'
                GROUP BY l.nom_lieu, l.id_lieu
                HAVING nbPerso >= ALL (
                SELECT COUNT(p.id_personnage)
                FROM personnage p, lieu l
                WHERE p.id_lieu = l.id_lieu
                AND l.nom_lieu != 'Village gaulois'
                GROUP BY l.nom_lieu
                )       
            ");

        ?>

        <p>Il y'a <?= $requete->rowCount() ?> résultats :</p>

        <table>
    
            <thead>
                <tr>
                    <th>Nom du lieu</th>
                    <th>Nombre d'habitants</th>
                </tr>
            </thead>

            <tbody>
                <?php
                    foreach($requete->fetchAll() as $gaulois){ ?>
                        <tr>
                            <td> <a href="voirLieu.php?id_lieu=<?= $gaulois["id_lieu"]?>"> <?= $gaulois["nom_lieu"] ?> </a> </td>
                            <td> <?= $gaulois["nbPerso"] ?> </td>
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

