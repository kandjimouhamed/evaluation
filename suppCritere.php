<?php 
include('config/connexion.php');
if (isset($_GET['id']))
{
    $id = trim($_GET['id']);
    
    if (trim($_GET['action']) == 'suppr')
    {
       
            
            $req = $bdd->prepare('DELETE FROM coefs WHERE id = ?');
            $req->execute(array($id));
            header('location: coefs.php?message=ok&message1=Suppression reussie');
            exit;
        
    }

}
else
{
 header('location: coefs.php');
 exit;
}
?>