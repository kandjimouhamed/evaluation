<?php 
include('config/connexion.php');
	if ((isset($_GET['action'])) && (trim($_GET['action'])=='suppr'))
	{
	    $id = $_GET['id'];	
	    $req = $bdd->prepare('SELECT count(*)  FROM commandeachat WHERE IDFOURNISSEUR = ?');
        $req->execute(array($id));
        $count = $req->fetchColumn();
	   // $req->debugDumpParams();
	    if ($count > 0)
	    {
	        header('location: fournisseur.php?message=erreur');
	        exit;
	    }
	    else
	    {
	    
	    $req = $bdd->prepare('DELETE FROM fournisseurs WHERE ID = ?');
	    $req->execute(array($id));
	    echo $req->debugDumpParams();
	    //ob_start(); 
	    header('location: fournisseur.php?message=ok');
	    //ob_end_flush(); 
	    exit;
	    }
	}
	else
	{header('location: fournisseur.php?message=ok');}
?>
