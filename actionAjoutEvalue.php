<?php
include('config/connexion.php');
if (isset($_POST['valider']))
{
    $id = $_POST['id'];
    $idSalarie = $_POST['idSalarie'];
    $idCoef = $_POST['idCoef'];
    $libelle = $_POST['libelle'];
        $req = $bdd->prepare('INSERT INTO evaluer(idSalarie,idCoef,libelle,) VALUES(:idSalarie, :idCoef, :libelle)');
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
    header('location: langue.php');
    exit;
}
?>
