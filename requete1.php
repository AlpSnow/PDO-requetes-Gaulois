<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style.css">
    <title>requête 1</title>
</head>
<body>
    <main>

        <?php

            require "dbconnect.php";
            $pdo = connect();
            // On attribue le nom que l'on souhaite à la variable $pdo. 
            // C'est simplement pour mettre la fonction dans une varible afin de l'avoir sur cette page
            // On aurait très bien pu l'appeler $pdo2000 = connect();
        ?>

        <p> <a href="index.php"> Retour à l'accueil </a> </p>

        <h3>1.	Nom des lieux qui finissent par 'um'</h3>

        <?php

            $requete = $pdo->query("
                SELECT id_lieu, nom_lieu
                FROM lieu
                WHERE nom_lieu LIKE '%um'
    
            ");

        ?>

        <p>Il y'a <?= $requete->rowCount() ?> résultats :</p>

        <table>
    
            <thead>
                <tr>
                    <th>Nom des lieux finissant par "um"</th>
                </tr>
            </thead>

            <tbody>
                <?php
                    foreach($requete->fetchAll() as $lieu){ ?>
                        <tr>
                            <td> <a href="voirLieu.php?id_lieu=<?= $lieu["id_lieu"]?>"> <?= $lieu["nom_lieu"] ?> </a> </td>
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