<?php
include('config/connexion.php');

/* On récupère l'identifiant de la région choisie. */
$idFiliale = isset($_GET['idr']) ? $_GET['idr'] : false;
/* Si on a une région, on procède à la requête */
if(false !== $idFiliale)
{
    /* Cération de la requête pour avoir les modeles de cette marque */
    
	
	$req = $bdd->prepare('SELECT *  FROM direction WHERE filialecode = ?');
	$req->execute(array($idFiliale));
	
    /* Un petit compteur pour les modeles */
    $nd = 0;
    /* On crée deux tableaux pour les numéros et les noms des modeles */
    $code = array();
    $nom = array();
    /* On va mettre les numéros et noms des modeles dans les deux tableaux */
	
	while ($donnees = $req->fetch())
	{
	  $code[] = $donnees['directioncode'];
      $nom[]  =  $donnees['directionnom'];
      $nd++;	
	}

	$liste = "";
    $liste .= '<select name="direction" size="1" class="" style="width:340px; background-color:#F6F6F6;">'."\n";
     //$liste .= '<select name="vehicule" size="1" class="" style="position: relative;display: inline-block;vertical-align: top; width:340px; inline;vertical-align: top;-moz-box-sizing: border-box;background-color: #fff;-moz-background-clip: padding;-webkit-background-clip: padding-box;background-clip: padding-box;border: 1px solid #aaa;display: block;overflow: hidden;white-space: nowrap;position: relative;height: 26px;line-height: 26px;padding: 0 0 0 8px;color: #444;text-decoration: none;border-bottom-color: #aaa;background: #fff;color: #000;border: 1px solid #aaa;color: #333;">'."\n";
     $liste .= '<option value="-1">Tous</option>'."\n";
    for($d = 0; $d < $nd; $d++)
    {
        $liste .= '  <option value="'. $code[$d] .'">'. htmlentities($nom[$d]) .'</option>'."\n";
    }
    $liste .= ' </select>'."\n";

    

    
    /* Affichage de la liste déroulante */
    echo($liste);
}
/* Sinon on retourne un message d'erreur */
else
{
    echo("<p>Une erreur s'est produite. La filiale  selectionn�e comporte une donnee invalide.</p>\n". $idFiliale);
}
?>
