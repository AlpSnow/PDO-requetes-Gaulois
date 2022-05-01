<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style.css">
    <title>requête 2</title>
</head>
<body>
    <main>

        <?php
            require "dbconnect.php";
            $pdo = connect();
        ?>

        <p> <a href="index.php"> Retour à l'accueil </a> </p>


        <h3>2.	Nombre de personnages par lieu (trié par nombre de personnages décroissant)</h3>

        <?php

            $requete = $pdo->query("
                SELECT l.id_lieu AS id_lieu, nom_lieu, COUNT(nom_personnage) AS nbPerso
                FROM personnage p, lieu l
                WHERE p.id_lieu = l.id_lieu 
                GROUP BY id_lieu
                ORDER BY nbPerso DESC
            ");

        ?>

        <p>Il y'a <?= $requete->rowCount() ?> résultats :</p>

        <table>
    
            <thead>
                <tr>
                    <th>Nom du lieu</th>
                    <th>Nombre de personnages par lieu</th>
                </tr>
            </thead>

            <tbody>
                <?php
                    foreach($requete->fetchAll() as $lieu){ ?>
                        <tr>
                            <td> <a href="voirLieu.php?id_lieu=<?= $lieu["id_lieu"]?>"> <?= $lieu["nom_lieu"] ?> </a> </td>
                            <td> <?= $lieu["nbPerso"] ?> </td>
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




