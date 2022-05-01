<?php

    function connect(){

        // Déclaration des constantes pour l'utilisateur et son mot de passe :
        // Une constante en PHP s'écrit : define("nom_de_ma_variable", "valeur associé à la variable")
        define("DBUSER", "root");
        define("DBPASS", "");

        // Connexion à la base de données (à travers l'instanciation de la classe PDO) :
        $pdo = new PDO("mysql:host=localhost; dbname=gaulois; charset=utf8", DBUSER, DBPASS);

        return $pdo;
    }

?>