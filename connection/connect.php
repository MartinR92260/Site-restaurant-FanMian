<?php

//connexion à la base de donnée
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_fanmian";


$db = mysqli_connect($servername, $username, $password, $dbname); // connexion

// Vérification de la connexion
if (!$db) 
{
    die("La connexion a échouée. " . mysqli_connect_error());
}

?>