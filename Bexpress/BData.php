<?php
$jour = date('d');$moi = date('M');$annee = date('Y');
$heure = date('H');$minutes = date('i');$seconde = date('s');
$align = "$annee $moi $jour $heure $minutes $seconde";
$date_text = "$heure"."h $minutes"."min $jour $moi $annee";
$dbhost ='127.0.0.1';$dbname = 'bdata';$dbuser = 'root';$dbpswd = '';
try{
    $BE = new PDO('mysql:host='.$dbhost.';dbname='.$dbname,$dbuser,$dbpswd, array(PDO::MYSQL_ATTR_INIT_COMMAND  => 'SET NAMES utf8',PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING)); 
}catch(PDOexception $e){
    include 'createBDataStructure.php';
}

?>