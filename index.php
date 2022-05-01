<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style.css">
    <title>PDO gaulois</title>
</head>

<body>

    <main>
    
        <H2>SQL Gaulois</H2>

        <?php
            foreach(range(1,15) as $numero) { ?>
                <p> <a href="requete<?= $numero ?>.php"> Requête <?= $numero ?> </a> </p>

            <?php }
        ?>

    </main>

</body>
</html>