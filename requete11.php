<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style.css">
    <title>requête 11</title>
</head>
<body>
    <main>

        <?php
            require "dbconnect.php";
            $pdo = connect();
        ?>

        <p> <a href="index.php"> Retour à l'accueil </a> </p>


        <h3>11. Combien existe-t-il de casques de chaque type et quel est leur coût total ? (classés par nombre décroissant)</h3>

        <?php

            $requete = $pdo->query("
                SELECT tc.nom_type_casque, COUNT(c.nom_casque) AS nbTotal, SUM(c.cout_casque) AS total
                FROM casque c, type_casque tc
                WHERE c.id_type_casque = tc.id_type_casque
                GROUP BY tc.nom_type_casque
                ORDER BY total DESC    
            ");

        ?>

        <p>Il y'a <?= $requete->rowCount() ?> résultats :</p>

        <table>
    
            <thead>
                <tr>
                    <th>Type de casque</th>
                    <th>Nombre</th>
                    <th>Coût total</th>
                </tr>
            </thead>

            <tbody>
                <?php
                    foreach($requete->fetchAll() as $gaulois){ ?>
                        <tr>
                            <td> <?= $gaulois["nom_type_casque"] ?> </td>
                            <td> <?= $gaulois["nbTotal"] ?> </td>
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

