<?php
include('config/connexion.php');

/* On récupère l'identifiant de la région choisie. */
$idFiliale = isset($_GET['idr']) ? $_GET['idr'] : false;
/* Si on a une région, on procède à la requête */
if(false !== $idFiliale)
{
    /* Cération de la requête pour avoir les modeles de cette marque */
    
	
	$req = $bdd->prepare('SELECT *  FROM clients WHERE filialecode = ?');
	$req->execute(array($idFiliale));
	
    /* Un petit compteur pour les modeles */
    $nd = 0;
    /* On crée deux tableaux pour les numéros et les noms des modeles */
    $code_dept = array();
    $nom_dept = array();
    /* On va mettre les numéros et noms des modeles dans les deux tableaux */
	
	while ($donnees = $req->fetch())
	{
	  $code[] = $donnees['IDCLIENT'];
      $nom[]  =  $donnees['nom'];
      $nd++;	
	}
	
    /* Maintenant on peut construire la liste déroulante */
	$liste = "";
    $liste .= '<label class="control-label">Selectionner Client :</label>'."\n";
	$liste .= '<div class="controls">'."\n";
    $liste .= '<select name="client" id="client" style="width: 90%">'."\n";
    for($d = 0; $d < $nd; $d++)
    {
        $liste .= '  <option value="'. $code[$d] .'">'. htmlentities($nom[$d]) .'</option>'."\n";
    }
    $liste .= '</select>'."\n";
	$liste .= '</div>'."\n";
    
    /* Affichage de la liste déroulante */
    echo($liste);
}
/* Sinon on retourne un message d'erreur */
else
{
    echo("<p>Une erreur s'est produite. La filiale  selectionn�e comporte une donnee invalide.</p>\n". $idFiliale);
}
?>
