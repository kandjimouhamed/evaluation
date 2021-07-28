<?php 
include('config/connexion.php');

$filiale = $_POST['filiale'];
$direction = $_POST['direction'];
$marque = $_POST['marque'];
$piece = $_POST['piece'];
$fournisseur = $_POST['fournisseur'];
$etat = $_POST['etat'];
$expedition = $_POST['expedition'];
$arrive = $_POST['arrive'];
$user = $_POST['user'];

$jour = date("Y-m-d");

$total_mpr = 0;
$total_ressource = 0;
$total = 0;


$req = $bdd->prepare('SELECT MAX(NUM_CMD_USERCREATE)  FROM commandeachat WHERE USERCREATE = ?');
$req->execute(array($user));
$idCommandeAchat = $req->fetchColumn(); 
$idCommandeAchat = $idCommandeAchat + 1;


$req = $bdd->prepare('SELECT * FROM commandempr WHERE IDPIECE = ? AND etat = ? AND directioncode = ? AND CMD_GENERER = 0');
$req->execute(array($piece, $etat, $direction));
//echo $req->debugDumpParams();
while ($donnees = $req->fetch())
{
 $idCommande = $donnees['ID'];	
 $total_mpr =  $total_mpr + $donnees['quantite'];	
 
 $req2 = $bdd->prepare('UPDATE commandempr SET CMD_GENERER = 1 WHERE ID = :idCommande');
         $req2->execute(array(
             'idCommande' => $idCommande
         ));
//echo $req2->debugDumpParams();
$req3 = $bdd->prepare('INSERT INTO commandeachat_commandempr(IDCOMMANDEMPR, NUM_CMD_USERCREATE, USERCREATE) VALUES(:idcommande, :usercommande, :user)');
         $req3->execute(array(
             'idcommande' => $idCommande,
             'usercommande' => $idCommandeAchat,
             'user' => $user
         ));                        
}

$req = $bdd->prepare('SELECT * FROM dossier WHERE dossiercode  IN (SELECT dossiercode FROM ressource WHERE resetat = ? AND IDPIECE = ? AND CMD_GENERER = 0)  AND directioncode = ?');
$req->execute(array($etat, $piece, $direction));
//echo $req->debugDumpParams();
while ($donnees = $req->fetch())
{
 $codeDossier = $donnees['dossiercode'];	
 $tot = 0;
 $req2 = $bdd->prepare('UPDATE ressource SET CMD_GENERER = 1 WHERE dossiercode = :codeDossier AND IDPIECE = :piece AND resetat = :etat');
         $req2->execute(array(
             'codeDossier' => $codeDossier,
             'piece' => $piece,
             'etat' => $etat
         ));
 //echo $req2->debugDumpParams();
         
 $reponse = $bdd->query('SELECT * FROM ressource WHERE dossiercode = '.$codeDossier.' AND IDPIECE = '.$piece.' AND resetat = '.$etat);
 
 while ($donnees1 = $reponse->fetch())
 {
  $idRessource = $donnees1['ressourcecode']; 
  $valquantite = $donnees1['quantite']; 
  
  $total_ressource = $total_ressource + $valquantite;
  
  if($tot != 0)
 {
 $req = $bdd->prepare('INSERT INTO commandeachat_ressource(ressourcecode, NUM_CMD_USERCREATE, USERCREATE) VALUES(:ressourcecode, :usercommande, :user)');
         $req->execute(array(
             'ressourcecode' => $idRessource,
             'usercommande' => $idCommandeAchat,
             'user' => $user
         ));
 }
 
 
  //$total_ressource = $total_ressource + $tot;        
  }     
}

$total = $total_mpr + $total_ressource ;
//echo $total;
if ($total != 0)
{ 
$req = $bdd->prepare('INSERT INTO commandeachat(NUM_CMD_USERCREATE, IDPIECE, quantite, IDFOURNISSEUR, date_cmd, date_arrivee, IDEXPEDITION, idetatcommande, directioncode, USERCREATE) VALUES(:numero, :piece, :quantite, :fournisseur, :jour, :arrive, :expedition, :etat, :direction, :user)');
$req->execute(array(
             'numero' => $idCommandeAchat,
             'piece' => $piece, 
             'quantite' => $total,
             'fournisseur' => $fournisseur,
             'jour' => $jour,
             'arrive' => $arrive,
             'expedition' => $expedition,
             'etat' => $etat,
             'direction' => $direction,
             'user' => $user
         ));
 
 header('location: commandeachat.php?message=Generation effectuee avec succes');
 exit;        
 //echo $req->debugDumpParams();        
}
else
{
 header('location: commandeachat.php?message=Aucune donnees trouvees');
 exit;	
}

?>
