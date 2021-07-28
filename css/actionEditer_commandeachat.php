<?php 
include('config/connexion.php');
if(isset($_POST['valider']))
{

$etat = $_POST['etat'];
$expedition = $_POST['expedition'];
$arrive = $_POST['arrive'];
$idCommande = $_POST['idCommande'];


$req3 = $bdd->prepare('SELECT * FROM CMD_PIECE_MPR WHERE IDCMD = ?');
$req3->execute(array($idCommande));

while ($donnees3 = $req3->fetch())
 {
 $idCommandeMPR = $donnees3['IDCMDMPR'];
 
 $req2 = $bdd->prepare('UPDATE commandempr SET etat = :etat WHERE ID = :idCommande');
 $req2->execute(array(
             'etat' => $etat, 
             'idCommande' => $idCommandeMPR
         ));
         
 }
 
$req3 = $bdd->prepare('SELECT * FROM CMD_PIECE_OR WHERE IDCMD = ?');
$req3->execute(array($idCommande));
while ($donnees3 = $req3->fetch())
 {
 $ressourcecode = $donnees3['IDRESSOURCE'];
 $req2 = $bdd->prepare('UPDATE ressource SET resetat = :etat WHERE ressourcecode = :ressourcecode');
 $req2->execute(array(
             'etat' => $etat, 
             'ressourcecode' => $ressourcecode
         ));   
 } 
 
 $req = $bdd->prepare('UPDATE commandeachat SET DATE_ARRIVE = :arrive, IDEXPEDITION = :expedition, idetatcommande = :etat WHERE ID = :idCommande');
 $req->execute(array(
             'arrive' => $arrive,
             'expedition' => $expedition,
             'etat' => $etat, 
             'idCommande' => $idCommande
         ));
	//$req->debugDumpParams(); 
header('location: commandeachat.php?message=Mise a jour effectuee avec succes');
exit;		  
}
else
{
 header('location: commandeachat.php');
  exit;		
}

?>
