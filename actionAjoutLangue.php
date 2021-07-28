<?php
include('config/connexion.php');
if (isset($_POST['valider']))
{
    $idLangue = $_POST['idLangue'];
    $libelle = $_POST['libelle'];
    $description= $_POST['description'];


    if ($idLangue == -1)
    {
        $req = $bdd->prepare('SELECT count(idLangue)  FROM langue WHERE libelle = ?');
        $req->execute(array($libelle));
        $count = $req->fetchColumn();

        if ($count > 0)
        {
            header('location: AjoutLangue.php?message='.$libelle.' existe dans la base, veuillez choisiir un autre libelle.');
            exit;
        }

        $req = $bdd->prepare('SELECT count(idLangue)  FROM langue WHERE description = ?');
        $req->execute(array($description));
        $count = $req->fetchColumn();

        if ($count > 0)
        {
            header('location: AjoutLangue.php?message='.$description.' existe dans la base, veuillez choisiir une autre descirpton.');
            exit;
        }

        $req = $bdd->prepare('INSERT INTO langue(libelle, description) VALUES(:libelle, :description)');
        $req->execute(array(
            'libelle' => $libelle,
            'description' => $description

        ));

        $message =  'ok';


        header('location: AjoutLangue.php?message='.$message.'&message1=Enregistrement effectuee avec succes');
        exit;
    }

    else
    {
        $req = $bdd->prepare('SELECT count(idLangue)  FROM langue WHERE libelle = ? AND idLangue!= ?');
        $req->execute(array($libelle,$idLangue));
        $count = $req->fetchColumn();

        if ($count > 0)
        {
            header('location: AjoutLangue.php?message='.$libelle.' existe dans la base, veuillez choisiir un autre sigle&action=edit&id='.$idLangue);
            exit;
        }

        $req = $bdd->prepare('SELECT count(idLangue)  FROM langue WHERE description = ? AND idLangue!= ?');
        $req->execute(array($libelle,$idLangue));
        $count = $req->fetchColumn();

        if ($count > 0)
        {
            header('location: AjoutLangue.php?message='.$description.' existe dans la base, veuillez choisiir un autre nom&action=edit&id='.$idLangue);
            exit;
        }

        $req = $bdd->prepare('UPDATE langue SET libelle = :libelle, description = :description WHERE idLangue = :idLangue');
        $req->execute(array(
            'libelle' => $libelle,
            'description' => $description,
            'idLangue' => $idLangue
        ));

        header('location: langue.php?message=ok&message1=Mise a jour effectuee avec succes');
        exit;
    }

}
else
{
    header('location: langue.php');
    exit;
}
?>
