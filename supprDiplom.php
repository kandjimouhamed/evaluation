<?php 
include('config/connexion.php');
if (isset($_GET['idDplom']))
{
    $idDiplom = trim($_GET['idDplom']);
    
    if (trim($_GET['action']) == 'suppr')
    {
       
            
            $req = $bdd->prepare('DELETE FROM diplom WHERE idDiplom = ?');
            $req->execute(array($idDiplom));
            header('location: diploms.php?message=ok&message1=Suppression reussie');
            exit;
        
    }

}
else
{
 header('location: diploms.php');
 exit;
}
?>