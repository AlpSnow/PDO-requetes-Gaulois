<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style.css">
    <title>requête 6</title>
</head>
<body>
    <main>

        <?php
            require "dbconnect.php";
            $pdo = connect();
        ?>

        <p> <a href="index.php"> Retour à l'accueil </a> </p>


        <h3>6. Nom des potions + coût de réalisation de la potion (trié par coût décroissant)</h3>

        <?php

        //     $requete = $pdo->query("
        //         SELECT p.nom_potion, p.id_potion, ROUND(SUM(i.cout_ingredient*s.qte), 2) AS coutTotal
        //         FROM potion p, ingredient i, composer s
        //         WHERE p.id_potion = s.id_potion
        //         AND i.id_ingredient = s.id_ingredient
        //         GROUP BY p.nom_potion, p.id_potion
        //         ORDER BY coutTotal DESC
        //    "); 

        //    Ancienne version avec les potions qui possèdent un prix supérieur à zéro € (donc des ingrédients)

            $requete = $pdo->query("
                SELECT p.nom_potion, p.id_potion, ROUND(SUM(i.cout_ingredient*s.qte), 2) AS coutTotal
                FROM potion p
                LEFT JOIN composer s ON p.id_potion = s.id_potion
                LEFT JOIN ingredient i ON i.id_ingredient = s.id_ingredient
                GROUP BY p.nom_potion, p.id_potion
                ORDER BY coutTotal DESC
            "); 

        // Nouvelle version qui affiche 100% des potions, même celles qui ne possèdent aucun ingrédient

        ?>

        <p>Il y'a <?= $requete->rowCount() ?> résultats :</p>

        <table>
    
            <thead>
                <tr>
                    <th>Nom de la potion</th>
                    <th>Coût de réalisation de la potion</th>
                </tr>
            </thead>

            <tbody>
                <?php
                    foreach($requete->fetchAll() as $gaulois){ ?>
                        <tr>
                            <td> <a href="voirPotion.php?id_potion=<?= $gaulois["id_potion"]?>"> <?= $gaulois["nom_potion"] ?> </a> </td>
                            <td> <?= isset($gaulois["coutTotal"]) ? $gaulois["coutTotal"] : 0 ?> </td>
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

