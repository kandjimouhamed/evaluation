<?php
include('config/connexion.php');
  if (trim($_GET['action']) == 'suppr')
    {
		$id = trim($_GET['id']);
        $req = $bdd->prepare('SELECT count(*) FROM dossier WHERE directioncode = ?');
        $req->execute(array($id));
        $count = $req->fetchColumn();
        
        if ($count > 0)
        {
            header('location: direction.php?message=Des dossiers sont ratachees à la direction selectionnee, suppression immpossible');
            exit;
        }
        else
        {
            
            $req = $bdd->prepare('DELETE FROM direction WHERE directioncode = ?');
            $req->execute(array($id));
            header('location: direction.php?message=ok&message1=Suppression reussie');
            exit;
        }
    }
	else
	{
	header('location: direction.php');
            exit;	
		
	}
?>