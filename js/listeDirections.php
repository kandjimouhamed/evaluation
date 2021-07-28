<?php
include('config/connexion.php');

/* On récupère l'identifiant de la région choisie. */
$idFiliale = isset($_GET['idr']) ? $_GET['idr'] : false;
/* Si on a une région, on procède à la requête */
if(false !== $idFiliale)
{
    /* Cération de la requête pour avoir les modeles de cette marque */
    
	if($idFiliale == -1)
	{
	$req = $bdd->prepare('SELECT *  FROM direction WHERE 1');
	$req->execute();
	}
    else
    {		 
	$req = $bdd->prepare('SELECT *  FROM direction WHERE filialecode = ?');
	$req->execute(array($idFiliale));
	}
	
    /* Un petit compteur pour les modeles */
    $nd = 0;
    /* On crée deux tableaux pour les numéros et les noms des modeles */
    $code_dept = array();
    $nom_dept = array();
    /* On va mettre les numéros et noms des modeles dans les deux tableaux */
	
	while ($donnees = $req->fetch())
	{
	  $code[] = $donnees['directioncode'];
      $nom[]  =  $donnees['directionnom'];
      $nd++;	
	}
	
    /* Maintenant on peut construire la liste déroulante */
	$liste = "";
	/*$liste .= '<div class="control-group" id="blocDirections">'."\n";
    $liste .= '<label class="control-label">Selectionner1 direction</label>'."\n";
    $liste .= '<div class="controls">'."\n";
	$liste .= '<select name="direction" id="direction">'."\n";
    $liste .= '<option></option>'."\n";
    for($d = 0; $d < $nd; $d++)
    {
        $liste .= '  <option value="'. $code[$d] .'">'. htmlentities($nom[$d]) .'</option>'."\n";
    }
    $liste .= '</select>'."\n";
    $liste .= ' </div>'."\n";
    $liste .= ' </div>'."\n";*/
    
    //$liste .= '<div id="blocDirections">'."\n";
    //$liste .= '<label class="w3-text-blue"><b>Direction</b></label>'."\n";
    //$liste .= '<div class="controls">'."\n";
    $liste .= '<select class="w3-select w3-border" name="direction" id="direction" style="height:31px;" onchange="getCircuits(this.value);" >'."\n";
    $liste .= 'option value="-1">Tous</option>';
	for($d = 0; $d < $nd; $d++)
    {
        $liste .= '  <option value="'. $code[$d] .'">'. htmlentities($nom[$d]) .'</option>'."\n";
    }
    $liste .= ' </select>'."\n";
   // $liste .= '</div>'."\n";
    //$liste .= '</div>'."\n";
    
    

    
    /* Affichage de la liste déroulante */
    echo($liste);
}
/* Sinon on retourne un message d'erreur */
else
{
    echo("<p>Une erreur s'est produite. La filiale  selectionn�e comporte une donnee invalide.</p>\n". $idFiliale);
}
?>
