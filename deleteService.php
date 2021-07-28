<?php
include_once('config.php');

if($__POST['id']) {
	
	$service = $_POST['id'];
	$req = $bdd->prepare('SELECT count(ID) FROM etape WHERE IDSERVICE = ?');
    $req->execute(array($service));
    $count = $req->fetchColumn();
	
	if ($count  > 0) { 
		echo 0;
        exit;
       }
	else
	
	{ 
	$req = $bdd->prepare('DELETE FROM service WHERE ID = ?');
    $req->execute(array($service));
	echo 1;	
	exit;
    } 
  }
else
 {
	 echo -1;
     exit;
 }
		
?>
