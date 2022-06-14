<?php

  // Définir les paramètres de la connexion dans un tableau
  define("DB_HOST", "localhost");
  define("DB_USER", "u329335418_demo_cms_user");
  define("DB_PASS", "AK~Wcs9]U");
  define("DB_NAME", "u329335418_demo_cms_db");

  // Définir les paramètres de la connexion dans un tableau
  $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
  
  // Vérifier que la base de données est connectée
  if(!$connection) die("Connection to Database Failed");


    // Définir les paramètres de la connexion dans un tableau
    // $db = ["db_host"=> "localhost","db_user"=> "root","db_pass"=> "","db_name"=> "cms"];

    // Se connecter à la base de données
    // $connection = mysqli_connect($db['db_host'], $db['db_user'], $db['db_pass'], $db['db_name']);
    
    // Vérifier que la base de données est connectée
    // if(!$connection) die("Connection to Database Failed");

?>