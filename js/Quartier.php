<?php
include_once('config.php'); 

/* On récupère l'identifiant de la région choisie. */
$idCentre = isset($_GET['idr']) ? $_GET['idr'] : false;
/* Si on a une région, on procède à la requête */
if(false !== $idCentre)
{
 $Continentqry	=	$db->query("SELECT IDQUARTIER FROM coordonnateurs WHERE ID = '$idCentre'");
 $crow = $Continentqry->fetch_assoc();
 $idQuartier = $crow['IDQUARTIER'];
 
 $Continentqry	=	$db->query("SELECT LIBELLE FROM quartiers WHERE ID = '$idQuartier'");
 $crow = $Continentqry->fetch_assoc();
 
 $quartier =  $crow['LIBELLE'];
	
    /* Maintenant on peut construire la liste déroulante */
	$liste = "";
    $liste .= '<input type="text" class="form-control col-md-3" id="quartier" name="quartier" aria-describedby="nameHelp" value="'.$quartier.'" disabled>'."\n";
    /* Affichage de la liste déroulante */
    echo($liste);
}
/* Sinon on retourne un message d'erreur */
else
{
    echo("<p>Une erreur s'est produite. Le centre  selectionn�e comporte une donnee invalide.</p>\n". $idCentre);
}
?>
