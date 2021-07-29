<?php
include('config/connexion.php');
if (isset($_POST['valider']))
{
    $id = $_POST['id'];
    $idSalarie = $_POST['idSalarie'];
    $idCoef = $_POST['idCoef'];
    $libelle = $_POST['libelle'];
    



    if ($idSalarie == -1)
    {
        $req = $bdd->prepare('SELECT count(id)  FROM evaluer WHERE libelle = ?');
        $req->execute(array($libelle));
        $count = $req->fetchColumn();



        $req = $bdd->prepare('INSERT INTO evaluer (idSalarie,idCoef,libelle ) VALUES(:idSalarie,:idCoef,:libelle )');
        $req->execute(array(

            'idSalarie' => $idSalarie,
            'idCoef' => $idCoef,
           'libelle' => $libelle
            
        ));
        $message =  'ok';
        header('location: evaluer.php?message='.$message.'&message1=Enregistrement effectuee avec succes');
        exit;
    }

    else
    {
        $req = $bdd->prepare('SELECT count(id)  FROM evaluer WHERE libelle = ?  AND idCoef = ? AND idSalarie != ?');
        $req->execute(array($idSalarie,$libelle,$idCoef));
        $count = $req->fetchColumn();

        if ($count > 0)
        {
            header('location: evaluer.php');
            exit;
        }



        $req = $bdd->prepare('UPDATE evaluer SET idSalarie =:idSalarie, idCoef= :idCoef WHERE id = :id');
        $req->execute(array(
            
            'idSalarie' => $idSalarie,
            'idCoef' => $idCoef,
           'libelle' => $libelle
        ));


        header('location: evaluer.php?message=ok&message1=Mise a jour effectuee avec succes');
        exit;
    }

}
else
{
    header('evaluer: salarie.php');
    exit;
}
?>