<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style.css">
    <title>liste lieux</title>
</head>

<body>

    <main>

        <?php
            require "dbconnect.php";
            $pdo = connect();

            if(isset($_GET["id_lieu"])) {
                // afficher le détail du lieu
                $id_lieu = $_GET["id_lieu"];

                $requete = $pdo->prepare("
                    SELECT nom_lieu, id_lieu
                    FROM lieu
                    WHERE id_lieu = :id_lieu
                ");

                $requete->execute([":id_lieu" => $id_lieu]);
                $result = $requete->fetch();

                if($result) {
                    echo "<h3>".$result["nom_lieu"]."</h3>
                          <figure>
                                <img src='image/Asterix_".$result["id_lieu"].".jpg' title='dessin de la ville : ".$result["nom_lieu"]."' alt='dessin de la ville : ".$result["nom_lieu"]."'>
                          </figure>
                          
                          <h3>Carte du monde</h3>
                          <figure>
                                <img src='image/Asterix_carte.jpg' title='carte du monde asterix' alt='carte du monde asterix'>
                          </figure>
                          
                          <p> <a href='index.php'>Retour à l'accueil</a> </p>";
                } else {
                    echo "<p> Identifiant de lieu introuvable ! </p> <br>",
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