<?php 
include('config/connexion.php');
if (isset($_GET['id']))
{
    $id = trim($_GET['id']);
    
    if (trim($_GET['action']) == 'suppr')
    {
        $req = $bdd->prepare('SELECT count(*) FROM direction WHERE filialecode = ?');
        $req->execute(array($id));
        $count = $req->fetchColumn();
        
        if ($count > 0)
        {
            header('location: filiale.php?message=Des direction sont ratachees a la filiale selectionnee, suppression immpossible');
            exit;
        }
        else
        {
            
            $req = $bdd->prepare('DELETE FROM filiale WHERE filialecode = ?');
            $req->execute(array($id));
            header('location: filiale.php?message=ok&message1=Suppression reussie');
            exit;
        }
    }

}
else
{
 header('location: filiale.php');
 exit;
}
?>