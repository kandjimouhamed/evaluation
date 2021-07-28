<?php 
include('config/connexion.php');
if(isset($_POST['valider']))
{

 if (isset($_POST['piece']))
 {$piece = $_POST['piece'];}
 if (isset($_POST['qte']))
 {$qte = $_POST['qte'];}
 $etat = $_POST['etat'];
 $user = $_POST['user'];
 $userCreate = $_POST['userCreate'];
 $idOR = $_POST['idOR'];
 $idCommande = $_POST['idCommande'];
 
 if($idOR == -1)
 {
  if ($userCreate == $user)
  {
    $req = $bdd->prepare('UPDATE commandempr SET IDPIECE = :piece, quantite = :quantite, etat = :etat WHERE ID = :idCommande');
    $req->execute(array(
            'piece' => $piece,
            'quantite' => $qte,
            'etat' => $etat,
            'idCommande' => $idCommande
        ));	  
  }
  else
  {
  $req = $bdd->prepare('UPDATE commandempr SET etat = :etat WHERE ID = :idCommande');
    $req->execute(array(
            'etat' => $etat,
            'idCommande' => $idCommande
        ));	 	  
  }	 
 }
 
 else
 {
  
  if ($userCreate == $user)
  {
    $req = $bdd->prepare('UPDATE ressource SET resetat = :etat, quantite = :quantite, IDPIECE = :piece WHERE ressourcecode = :idCommande');
    $req->execute(array(
            'etat' => $etat,
            'quantite' => $qte,
            'piece' => $piece,
            'idCommande' => $idCommande
        ));	  
  }
  else
  {
  $req = $bdd->prepare('UPDATE ressource SET resetat = :etat WHERE ressourcecode = :idCommande');
    $req->execute(array(
            'etat' => $etat,
            'idCommande' => $idCommande
        ));	 	  
  }
  	 
 }
	
	$message =  'ok';
  
 // echo $req->debugDumpParams();
 header('location: commandempr.php?message='.$message);
  exit;		  
}
else
{
 header('location: commandempr.php');
  exit;		
}

?>
