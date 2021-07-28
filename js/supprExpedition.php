<?php
include('config/connexion.php');
   if ((isset($_GET['action'])) && (trim($_GET['action']) == 'suppr'))
    {
        $id = trim($_GET['id']);
        $req = $bdd->prepare('SELECT count(*) FROM commandeachat WHERE IDEXPEDITION = ?');
        $req->execute(array($id));
        $count = $req->fetchColumn();
        
        if ($count > 0)
        {
            header('location: expeditioncommande.php?message=Des objets sont ratachees a l\'etat selectionne, suppression immpossible');
            exit;
        }
        
            
            $req = $bdd->prepare('DELETE FROM expeditioncommande WHERE ID = ?');
            $req->execute(array($id));
            header('location: expeditioncommande.php?message=ok&message1=Suppression reussie');
            exit;
     
    }
    else
    {header('location: expeditioncommande.php');}
?>
