<?php
$hote = 'localhost';
$user_bd = 'root';
$pwd_bd = '';
$bd = 'evaluation';
try
{
	// On se connecte à MySQL
	$bdd = new PDO("mysql:host=$hote;dbname=$bd;charset=utf8", $user_bd, $pwd_bd);
}
catch(Exception $e)
{
	// En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur Connexion : '.$e->getMessage());
}


?>
