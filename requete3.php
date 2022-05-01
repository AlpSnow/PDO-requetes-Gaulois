<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style.css">
    <title>requête 3</title>
</head>
<body>
    <main>

        <?php
            require "dbconnect.php";
            $pdo = connect();
        ?>

        <p> <a href="index.php"> Retour à l'accueil </a> </p>


        <h3>3.	Nom des personnages + spécialité + adresse et lieu d'habitation, triés par lieu puis par nom de personnage</h3>

        <?php

            $requete = $pdo->query("
                SELECT l.id_lieu AS id_lieu, p.id_personnage AS id_personnage, p.nom_personnage, s.nom_specialite, p.adresse_personnage, l.nom_lieu 
                FROM personnage p, lieu l, specialite s
                WHERE p.id_lieu = l.id_lieu
                AND p.id_specialite = s.id_specialite
                ORDER BY l.nom_lieu, p.nom_personnage 
            ");

        ?>

        <p>Il y'a <?= $requete->rowCount() ?> résultats :</p>

        <table>
    
            <thead>
                <tr>
                    <th>Nom du personnage</th>
                    <th>Nom de la spécialité</th>
                    <th>Adresse</th>
                    <th>Lieu d'habitation</th>
                </tr>
            </thead>

            <tbody>
                <?php
                    foreach($requete->fetchAll() as $gaulois){ ?>
                        <tr>
                            <td> <a href="voirPersonnage.php?id_personnage=<?= $gaulois["id_personnage"]?>"> <?= $gaulois["nom_personnage"] ?> </a> </td>
                            <td> <?= $gaulois["nom_specialite"] ?> </td>
                            <td> <?= $gaulois["adresse_personnage"] ?> </td>
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

