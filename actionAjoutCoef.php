<?php
include('config/connexion.php');
if (isset($_POST['valider']))
{
    $id = $_POST['id'];
    $libelle = $_POST['libelle'];
    $coef= $_POST['coef'];


    if ($id == -1)
    {
        $req = $bdd->prepare('SELECT count(id)  FROM coefs WHERE libelle = ?');
        $req->execute(array($libelle));
        $count = $req->fetchColumn();

        if ($count > 0)
        {
            header('location: ajoutCoef.php?message='.$libelle.' existe dans la base, veuillez choisiir un autre libelle.');
            exit;
        }
        

        $req = $bdd->prepare('INSERT INTO coefs(libelle, coef) VALUES(:libelle, :coef)');
        $req->execute(array(
            'libelle' => $libelle,
            'coef' => $coef

        ));

        $message =  'ok';


        header('location: ajoutCoef.php?message='.$message.'&message1=Enregistrement effectuee avec succes');
        exit;
    }

    else
    {
        $req = $bdd->prepare('SELECT count(id)  FROM coefs WHERE libelle = ? AND id!= ?');
        $req->execute(array($libelle,$id));
        $count = $req->fetchColumn();

        if ($count > 0)
        {
            header('location: ajoutCoef.php?message='.$libelle.' existe dans la base, veuillez choisiir un autre sigle&action=edit&id='.$id);
            exit;
        }

        $req = $bdd->prepare('SELECT count(id)  FROM coefs WHERE coef = ? AND id!= ?');
        $req->execute(array($libelle,$id));
        $count = $req->fetchColumn();

        if ($count > 0)
        {
            header('location: ajoutCoef.php?message='.$coef.' existe dans la base, veuillez choisiir un autre nom&action=edit&id='.$id);
            exit;
        }

        $req = $bdd->prepare('UPDATE coefs SET libelle = :libelle, coef = :coef WHERE id = :id');
        $req->execute(array(
            'libelle' => $libelle,
            'coef' => $coef,
            'id' => $id
        ));

        header('location: coefs.php?message=ok&message1=Mise a jour effectuee avec succes');
        exit;
    }

}
else
{
    header('location: coefs.php');
    exit;
}
?>
