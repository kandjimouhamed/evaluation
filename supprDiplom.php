<?php 
include('config/connexion.php');
if (isset($_GET['idDiplom']))
{
    $idDiplom = trim($_GET['idDiplom']);
    
    if (trim($_GET['action']) == 'suppr')
    {
        $req = $bdd->prepare('SELECT count(*) FROM diplom WHERE idDiplom = ?');
        $req->execute(array($idDiplom));
        $count = $req->fetchColumn();
        
        if ($count > 0)
        {
            header('location: diploms.php?message=Des direction sont ratachees a la filiale selectionnee, suppression immpossible');
            exit;
        }
        else
        {
            
            $req = $bdd->prepare('DELETE FROM diplom WHERE idDiplom = ?');
            $req->execute(array($idDiplom));
            header('location: diploms.php?message=ok&message1=Suppression reussie');
            exit;
        }
    }

}
else
{
 header('location: diploms.php');
 exit;
}
?>