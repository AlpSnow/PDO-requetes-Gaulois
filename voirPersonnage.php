<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style.css">
    <title>liste personnages</title>
</head>

<body>

    <main>

        <?php
            require "dbconnect.php";
            $pdo = connect();

            if(isset($_GET["id_personnage"])) {
                // afficher le détail du personnage
                $id_personnage = $_GET["id_personnage"];

                $requete = $pdo->prepare("
                    SELECT nom_personnage, adresse_personnage, nom_specialite, nom_lieu
                    FROM personnage p
                    INNER JOIN specialite s ON p.id_specialite = s.id_specialite
                    INNER JOIN lieu l ON l.id_lieu = p.id_lieu
                    WHERE id_personnage = :id_personnage
                ");

                $requete->execute([":id_personnage" => $id_personnage]);
                $result = $requete->fetch();

                if($result) { ?>
                    <h3> <?= $result["nom_personnage"] ?> </h3>
                    <p>
                        Adresse :   <?php if (isset($result["adresse_personnage"])) {
                                        echo $result["adresse_personnage"];
                                    } else { 
                                        echo "Nomade (pas d'habitation fixe)";
                                    } ?> <br>

                        Lieu : <?= $result["nom_lieu"] ?> <br>
                        <!-- Inutile de faire comme pour l'adresse (précédemment ligne 36)
                        car chaque personnage vie dans un lieu (et possède ainsi donc un lieu d'habitation) -->
                        Spécialité : <?= $result["nom_specialite"] ?>
                        <!-- Inutile de faire comme pour l'adresse (précédemment ligne 36) 
                        car chaque personnage possède une spécialité (il n'y aura donc aucune valeur NULL) -->
                    </p>
                    <p> <a href='index.php'>Retour à l'accueil</a> </p>
            
                <?php } else {
                    echo "<p> Identifiant de personnage introuvable ! </p> <br>",
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


