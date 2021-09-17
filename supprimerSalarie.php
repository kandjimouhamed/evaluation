<?php
include('config/connexion.php');
if (isset($_GET['idSalarie']))
{
    $id = trim($_GET['idSalarie']);
    
    if (trim($_GET['action']) == 'suppr')
    {
        $req = $bdd->prepare('SELECT * FROM salarie WHERE idSalarie = ?');
        $req->execute(array($id));
        $count = $req->fetchColumn();
        
        if ($count > 0)
        {
            header('location: salarie.php?message=Suppression impossible, des OR sont lies a cet utilisateur');
            exit;
        }
        else
        {
            
            $req = $bdd->prepare('DELETE FROM salarie WHERE idSalarie = ?');
            $req->execute(array($id));
            
            header('location: salarie.php?message=ok&message1=Suppression reussie');
            exit; 
        }
    }

}
else
{
 header('location: salarie.php');
            exit;
}
?>