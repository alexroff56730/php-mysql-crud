<?php 
    define("DB_SERVER", "localhost");
    define("DB_USERNAME", "root");
    define("DB_PASSWORD", "");
    define("DB_NAME", "dwm_vervins");

    $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    if($link === false) {
        die("ERREUR: impossible d'établir une connexion ." . mysqli_connect_error());
    }
?>