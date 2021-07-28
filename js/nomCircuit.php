<?php
include('config/connexion.php');
include('config/functions.php');



/* On récupère l'identifiant de la région choisie. */
$idCircuit = isset($_GET['idr']) ? $_GET['idr'] : false;
/* Si on a une région, on procède à la requête */
if(false !== $idCircuit)
{
    /* Cération de la requête pour avoir les modeles de cette marque */
    
	
    $req = $bdd->prepare('SELECT count(dossiercode)  FROM dossier WHERE IDCIRCUIT = ?');
    $req->execute(array($idCircuit));
    $count = $req->fetchColumn();
    $i = $count + 1;
    
    $nomCircuit = getCircuit($idCircuit,$bdd);
    $nom2 = $nomCircuit."-".$i;
    
    $liste = "";
    //$liste .= ' <label class="w3-text-blue"><b>Nom</b></label>'."\n";
    $liste .= '<input class="w3-input w3-border" type="text" name="nom" value="'.$nom2.'" readonly style="height:28px;">'."\n";
	$liste .= '<input type="hidden" name="nomDossier" value="'.$nom2.'">'."\n";
    
	
	
    
    
    /* Affichage de la liste déroulante */
    echo($liste);
}
/* Sinon on retourne un message d'erreur */
else
{
    echo("<p>Une erreur s'est produite. La filiale  selectionn�e comporte une donnee invalide.</p>\n". $idFiliale);
}
?>
