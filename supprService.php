<?php 
include('config/connexion.php');
if (isset($_GET['id']))
{
    $id = trim($_GET['id']);
    
    if (trim($_GET['action']) == 'suppr')
    {
        $req = $bdd->prepare('SELECT count(ID) FROM etape WHERE IDSERVICE = ?');
        $req->execute(array($id));
        $count = $req->fetchColumn();
        
        if ($count > 0)
        {
            header('location: service.php?message=le service selectionnee intervient dans des circuits, suppression immpossible');
            exit;
        }
        else
        {
            
            $req = $bdd->prepare('DELETE FROM service WHERE ID = ?');
            $req->execute(array($id));
            
            header('location: service.php?message=ok&message1=Suppression reussie');
            exit;
        }
    }

}
else
{
 header('location: service.php');
            exit;
}
?>