<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style.css">
    <title>requête 5</title>
</head>
<body>
    <main>

        <?php
            require "dbconnect.php";
            $pdo = connect();
        ?>

        <p> <a href="index.php"> Retour à l'accueil </a> </p>


        <h3>5. Nom, date et lieu des batailles, classées de la plus récente à la plus ancienne (dates affichées au format jj/mm/aaaa)</h3>

        <?php

            $requete = $pdo->query("
                SELECT b.nom_bataille, DATE_FORMAT(b.date_bataille, '%d %M -%y') AS dateBataille, l.nom_lieu, l.id_lieu AS id_lieu
                FROM bataille b, lieu l
                WHERE b.id_lieu = l.id_lieu
                ORDER BY YEAR(b.date_bataille) ASC, MONTH(b.date_bataille) DESC, DAY(b.date_bataille) DESC  
            ");

        ?>

        <p>Il y'a <?= $requete->rowCount() ?> résultats :</p>

        <table>
    
            <thead>
                <tr>
                    <th>Nom de la bataille</th>
                    <th>Date de la bataille</th>
                    <th>Lieu de la bataille</th>
                </tr>
            </thead>

            <tbody>
                <?php
                    foreach($requete->fetchAll() as $gaulois){ ?>
                        <tr>
                            <td> <?= $gaulois["nom_bataille"] ?> </td>
                            <td> <?= $gaulois["dateBataille"] ?> </td>
                            <td> <a href="voirLieu.php?id_lieu=<?= $gaulois["id_lieu"]?>"> <?= $gaulois["nom_lieu"] ?> </a> </td>
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

