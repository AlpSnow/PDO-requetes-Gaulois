<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style.css">
    <title>liste potions</title>
</head>

<body>

    <main>

        <?php
            require "dbconnect.php";
            $pdo = connect();

            if(isset($_GET["id_potion"])) {
                // afficher le détail du personnage
                $id_potion = $_GET["id_potion"];

                $requete = $pdo->prepare("
                    SELECT p.nom_potion, i.nom_ingredient, s.qte, i.cout_ingredient
                    FROM ingredient i, composer s, potion p
                    WHERE i.id_ingredient = s.id_ingredient
                    AND s.id_potion = p.id_potion
                    AND p.id_potion = :id_potion
                ");

                $requete->execute([":id_potion" => $id_potion]);
                $result = $requete->fetchAll();

                if($result) { ?>
                    <h3> Potion <?= $result[0]["nom_potion"] ?> </h3>

                    <?php
                        foreach($result as $potion){ ?>
                            <p>
                                Nom ingrédient : <?= $potion["nom_ingredient"] ?> <br>
                                Quantité : <?= $potion["qte"] ?> <br>
                                Coût ingrédient : <?= $potion["cout_ingredient"] ?>
                            </p>
                        <?php } ?>
                



                    <p> <a href='index.php'>Retour à l'accueil</a> </p>
            
                <?php } else {
                    echo "<p> Cette potion ne contient aucun ingrédient </p> <br>",
                         "<p> <a href='index.php'>Retour à l'accueil</a> </p>";
                }

        

            } else {
                // redirection vers la page d'accueil
                header("Location: index.php");
            }

        ?>
    </main>
    
</body>
</html>