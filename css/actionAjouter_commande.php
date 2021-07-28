<?php 
include('config/connexion.php');
if(isset($_POST['valider']))
{
 $direction = $_POST['direction'];	
 $piece = $_POST['piece'];
 $qte = $_POST['qte'];
 $etat = $_POST['etat'];
 $user = $_POST['user'];
 
  $req = $bdd->prepare('INSERT INTO commandempr(IDPIECE, quantite, etat,directioncode, USERCREATE) VALUES(:piece, :qte, :etat, :direction, :user)');
     $req->execute(array(
	'piece' => $piece,
	'qte' => $qte,
    'etat' => $etat,
    'direction' => $direction,
    'user' => $user
	));
	
	$message =  'ok';
  
  //echo $req->debugDumpParams();
 header('location: ajouter_commande.php?message='.$message);
  exit;		  
}
else
{
  header('location: commandempr.php');
  exit;	
}
?>
