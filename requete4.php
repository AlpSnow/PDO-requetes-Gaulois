<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style.css">
    <title>requête 4</title>
</head>
<body>
    <main>
        
        <?php
            require "dbconnect.php";
            $pdo = connect();
        ?>

        <p> <a href="index.php"> Retour à l'accueil </a> </p>


        <h3>4.	Nom des spécialités avec nombre de personnages par spécialité (trié par nombre de personnages décroissant)</h3>

        <?php

            $requete = $pdo->query("
                SELECT s.nom_specialite, COUNT(p.nom_personnage) AS nbPerso
                FROM specialite s
                LEFT JOIN personnage p ON s.id_specialite = p.id_specialite
                GROUP BY s.nom_specialite
                ORDER BY nbPerso DESC    
            ");

        ?>

        <p>Il y'a <?= $requete->rowCount() ?> résultats :</p>

        <table>
    
            <thead>
                <tr>
                    <th>Nom de la spécialité</th>
                    <th>Nombre de personnages par spécialité</th>
                </tr>
            </thead>

            <tbody>
                <?php
                    foreach($requete->fetchAll() as $gaulois){ ?>
                        <tr>
                            <td> <?= $gaulois["nom_specialite"] ?> </td>
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
