<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style.css">
    <title>requête 7</title>
</head>
<body>
    <main>

        <?php
            require "dbconnect.php";
            $pdo = connect();
        ?>

        <p> <a href="index.php"> Retour à l'accueil </a> </p>


        <h3>7.	Nom des ingrédients + coût + quantité de chaque ingrédient qui composent la potion "Santé"</h3>

        <?php

            $requete = $pdo->query("
                SELECT i.nom_ingredient, s.qte, i.cout_ingredient
                FROM ingredient i, composer s, potion p
                WHERE i.id_ingredient = s.id_ingredient
                AND s.id_potion = p.id_potion
                AND p.nom_potion = 'Santé'    
            ");

        ?>

        <p>Il y'a <?= $requete->rowCount() ?> résultats :</p>

        <table>
    
            <thead>
                <tr>
                    <th>Nom de l'ingrédient</th>
                    <th>Coût de l'ingrédient</th>
                    <th>Quantité nécessaire</th>
                </tr>
            </thead>

            <tbody>
                <?php
                    foreach($requete->fetchAll() as $gaulois){ ?>
                        <tr>
                            <td> <?= $gaulois["nom_ingredient"] ?> </td>
                            <td> <?= $gaulois["qte"] ?> </td>
                            <td> <?= $gaulois["cout_ingredient"] ?> </td>
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

