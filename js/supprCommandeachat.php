<?php 
include('config/connexion.php');
if(isset($_GET['idCommande']))
{
 $idCommande = trim($_GET['idCommande']);
 
$req3 = $bdd->prepare('SELECT * FROM CMD_PIECE_MPR WHERE IDCMD = ?');
$req3->execute(array($idCommande));

while ($donnees3 = $req3->fetch())
 {
 $idCommandeMPR = $donnees3['IDCMDMPR'];
 
 $req2 = $bdd->prepare('UPDATE commandempr SET etat = 1, CMD_GENERER = 0 WHERE ID = :idcommandempr');
 $req2->execute(array(
             'idcommandempr' => $idCommandeMPR
         ));
         
 }
 
$req3 = $bdd->prepare('SELECT * FROM CMD_PIECE_OR WHERE IDCMD = ?');
$req3->execute(array($idCommande));
while ($donnees3 = $req3->fetch())
 {
 $ressourcecode = $donnees3['IDRESSOURCE'];
 $req2 = $bdd->prepare('UPDATE ressource SET resetat = 1, CMD_GENERER = 0 WHERE ressourcecode = :ressourcecode');
 $req2->execute(array(
             'ressourcecode' => $ressourcecode
         ));   
 } 
 
 $req = $bdd->prepare('DELETE FROM commandeachat WHERE ID = :idCommande');
 $req->execute(array(
             'idCommande' => $idCommande
         ));
 	
// echo $req->debugDumpParams();
 header('location: commandeachat.php?message=Commande supprime avec succes');
  exit;		  
}
else
{
 header('location: commandeachat.php');
  exit;		
}

?>
