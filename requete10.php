<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style.css">
    <title>requête 10</title>
</head>
<body>
    <main>

        <?php
            require "dbconnect.php";
            $pdo = connect();
        ?>

        <p> <a href="index.php"> Retour à l'accueil </a> </p>


        <h3>10. Nom de la bataille où le nombre de casques pris a été le plus important</h3>

        <?php

            $requete = $pdo->query("
                SELECT b.nom_bataille, SUM(pc.qte) AS total
                FROM bataille b, prendre_casque pc
                WHERE pc.id_bataille = b.id_bataille
                GROUP BY b.nom_bataille
                HAVING total >= ALL(
                SELECT SUM(pc.qte)
                FROM bataille b, prendre_casque pc
                WHERE pc.id_bataille = b.id_bataille
                GROUP BY b.nom_bataille
                )
            ");

        ?>

        <p>Il y'a <?= $requete->rowCount() ?> résultats :</p>

        <table>
    
            <thead>
                <tr>
                    <th>Nom de la bataille</th>
                    <th>Nombre de casques pris</th>
                </tr>
            </thead>

            <tbody>
                <?php
                    foreach($requete->fetchAll() as $gaulois){ ?>
                        <tr>
                            <td> <?= $gaulois["nom_bataille"] ?> </td>
                            <td> <?= $gaulois["total"] ?> </td>
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

