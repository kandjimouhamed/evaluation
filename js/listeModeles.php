<?php
include('config/connexion.php');

/* On récupère l'identifiant de la région choisie. */
$idMarque = isset($_GET['idr']) ? $_GET['idr'] : false;
/* Si on a une région, on procède à la requête */
if(false !== $idMarque)
{
    /* Cération de la requête pour avoir les modeles de cette marque */
    
	
	$req = $bdd->prepare('SELECT *  FROM modeles WHERE IDMARQUE = ?');
	$req->execute(array($idMarque));
	
    /* Un petit compteur pour les modeles */
    $nd = 0;
    /* On crée deux tableaux pour les numéros et les noms des modeles */
    $code_dept = array();
    $nom_dept = array();
    /* On va mettre les numéros et noms des modeles dans les deux tableaux */
	
	while ($donnees = $req->fetch())
	{
	  $code[] = $donnees['IDMODELE'];
      $nom[]  =  $donnees['libelle'];
      $nd++;	
	}
	
    /* Maintenant on peut construire la liste déroulante */
	$liste = "";
    $liste .= '<b><label class="w3-text-blue"><b>Modele</b></label>'."\n";
    $liste .= '<select class="w3-select" size="1" name="modele" id="modele" style="background-color:#fff;" required onchange="getPieces(this.value);">'."\n";
    $liste .= '<option></option>';
    for($d = 0; $d < $nd; $d++)
    {
        $liste .= '  <option value="'. $code[$d] .'">'. htmlentities($nom[$d]) .'</option>'."\n";
    }
    $liste .= '</select>'."\n";
    
    /* Affichage de la liste déroulante */
    echo($liste);
}
/* Sinon on retourne un message d'erreur */
else
{
    echo("<p>Une erreur s'est produite. La marque sélectionnée comporte une donnée invalide.</p>\n". $idMarque);
}
?>
