<?php
session_start();
include('config/connexion.php');

    if (trim($_GET['action']) == 'suppr')
    {
            if (isset($_GET['idDipSala']))
            {
                      
                $idDipSala = trim($_GET['idDipSala']);

            $req = $bdd->prepare('DELETE FROM diplomsalarie WHERE id = ?');
            $req->execute(array($idDipSala));
            header('location:modiffierSalarie.php?action=edit&idSalarie='.  $_SESSION['idSalarie'].'#about');
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
            header('location:modiffierSalarie.php?action=edit&idSalarie='.$_SESSION['idSalarie'].'#mentions');
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
            header('location:modiffierSalarie.php?action=edit&idSalarie='.$_SESSION['idSalarie'].'#critere');
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
            header('location:modiffierSalarie.php?action=edit&idSalarie='.$_SESSION['idSalarie'].'#mentions');
            exit;
        
    }

}
else if (isset($_GET['idOb']))
{
    $idob = trim($_GET['idOb']);

    if (trim($_GET['action']) == 'supprOb')
    {
        

            $req = $bdd->prepare('DELETE FROM objectifs WHERE id = ?');
            $req->execute(array($idob));
            header('location:modiffierSalarie.php?action=edit&idSalarie='.$_SESSION['idSalarie'].'#objective');
            exit;
        
    }

}
else
{
    header('location:modiffierSalarie.php?action=edit&idSalarie='.$_SESSION['idSalarie'].'#mentions');
    exit;
}


?>

