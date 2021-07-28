<?php 
include('config/connexion.php');
if (isset($_GET['idRecrutement']))
{
    $idRecrutement = trim($_GET['idRecrutement']);
    
    if (trim($_GET['action']) == 'suppr')
    {
       /*  $req = $bdd->prepare('SELECT count(*) FROM recrutement WHERE idRecrutement = ?');
        $req->execute(array($idRecrutement));
        $count = $req->fetchColumn();
        
        if ($count > 0)
        {
            header('location: recrutement.php?message=Des direction sont ratachees a la filiale selectionnee, suppression immpossible');
            exit;
        }
        else
        { */
            
            $req = $bdd->prepare('DELETE FROM recrutement WHERE idRecrutement = ?');
            $req->execute(array($idRecrutement));
            header('location: recrutement.php?message=ok&message1=Suppression reussie');
            exit;
        // }
    }

}
else
{
 header('location: recrutement.php');
 exit;
}
?>