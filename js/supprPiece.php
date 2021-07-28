<?php 
include('config/connexion.php');
if (trim($_GET['action'])=='suppr')
	{
	   
	   $id = $_GET['id']; 
	   
	   $req = $bdd->prepare('SELECT count(*) FROM ressource WHERE IDPIECE = ?');
	   $req->execute(array($id));
	   $count1 = $req->fetchColumn();
	   
	   $req = $bdd->prepare('SELECT count(*) FROM commandeachat WHERE IDPIECE = ?');
	   $req->execute(array($id));
	   $count2 = $req->fetchColumn();
	   
	   $req = $bdd->prepare('SELECT count(*) FROM commandempr WHERE IDPIECE = ?');
	   $req->execute(array($id));
	   $count3 = $req->fetchColumn();
	    
	    if ($count1 > 0)
	    {
	        header('location: piece.php?message=erreur');
	        exit;
	    }
	    
	    if ($count2 > 0)
	    {
	        header('location: piece.php?message=erreur');
	        exit;
	    }
	    
	    if ($count3 > 0)
	    {
	        header('location: piece.php?message=erreur');
	        exit;
	    }
	   
	    
	    $req = $bdd->prepare('DELETE FROM piece WHERE IDPIECE = ?');
	    $req->execute(array($id));
	    header('location: piece.php?message=ok');
	    exit;
	}
	else
	{header('location: piece.php?message=ok');}
?>
