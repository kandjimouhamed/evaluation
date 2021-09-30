<?php
include('config/connexion.php');
if (isset($_GET['idDipSala']))
{
    $idDipSala = trim($_GET['idDipSala']);

    if (trim($_GET['action']) == 'suppr')
    {
        

            $req = $bdd->prepare('DELETE FROM diplomsalarie WHERE id = ?');
            $req->execute(array($idDipSala));
            header('location:ajoutSalarie.php#about');
            exit;
        
    }

}

else if (isset($_GET['idLS']))
{
    $idLS = trim($_GET['idLS']);

    if (trim($_GET['action']) == 'suppridLS')
    {
        

            $req = $bdd->prepare('DELETE FROM languesalarie WHERE idLS = ?');
            $req->execute(array($idLS));
            header('location:ajoutSalarie.php#mentions');
            exit;
        
    }

}
else if (isset($_GET['idC']))
{
    $idC = trim($_GET['idC']);

    if (trim($_GET['action']) == 'supprC')
    {
        

            $req = $bdd->prepare('DELETE FROM evaluer WHERE idEvaluer = ?');
            $req->execute(array($idC));
            header('location:ajoutSalarie.php#critere');
            exit;
        
    }

}
else if (isset($_GET['idLS']))
{
    $idLS = trim($_GET['idLS']);

    if (trim($_GET['action']) == 'suppridLS')
    {
        

            $req = $bdd->prepare('DELETE FROM languesalarie WHERE idLS = ?');
            $req->execute(array($idLS));
            header('location:ajoutSalarie.php#mentions');
            exit;
        
    }

}
else if (isset($_GET['idC']))
{
    $idC = trim($_GET['idC']);

    if (trim($_GET['action']) == 'supprO')
    {
        

            $req = $bdd->prepare('DELETE FROM objectifs WHERE id = ?');
            $req->execute(array($idC));
            header('location:ajoutSalarie.php#objective');
            exit;
        
    }

}
else
{
    header('location:ajoutSalarie.php#mentions');
    exit;
}
?>

