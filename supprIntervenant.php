<?php
include('config/connexion.php');
if (isset($_GET['id']))
{
    $id = trim($_GET['id']);
    
    if (trim($_GET['action']) == 'suppr')
    {
        $req = $bdd->prepare('SELECT count(dossiercode) FROM dossier WHERE IDUTILISATEUR = ?');
        $req->execute(array($id));
        $count = $req->fetchColumn();
        
        if ($count > 0)
        {
            header('location: intervenant.php?message=Suppression impossible, des OR sont lies a cet utilisateur');
            exit;
        }
        else
        {
            
            $req = $bdd->prepare('DELETE FROM intervenant WHERE codeintervenant = ?');
            $req->execute(array($id));
            
            header('location: intervenant.php?message=ok&message1=Suppression reussie');
            exit; 
        }
    }

}
else
{
 header('location: intervenant.php');
            exit;
}
?>