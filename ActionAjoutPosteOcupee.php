<?php
include('config/connexion.php');
if (isset($_POST['valider']))
{
   
    $idPO = $_POST['idPO'];
    $libelle = $_POST['libelle'];
  


    if ($idPO == -1)
    {
        $req = $bdd->prepare('SELECT count(idPO)  FROM posteocupee WHERE libelle = ?');
        $req->execute(array($libelle));
        $count = $req->fetchColumn();



        $req = $bdd->prepare('INSERT INTO posteocupee(libelle) VALUES(:libelle)');
        $req->execute(array(
            'libelle' => $libelle,
        ));

        $message =  'ok';


        header('location: AjoutPosteOcupee.php?message='.$message.'&message1=Enregistrement effectuee avec succes');
        exit;
    }

    else
    {
        $req = $bdd->prepare('SELECT count(idPO)  FROM posteocupee WHERE libelle = ? AND idPO!= ?');
        $req->execute(array($libelle,$idPO));
        $count = $req->fetchColumn();

        if ($count > 0)
        {
            header('location: AjoutPosteOcupee.php?message='.$libelle.' existe dans la base, veuillez choisiir un autre sigle&action=edit&id='.$idPO);
            exit;
        }

        $req = $bdd->prepare('SELECT count(idPO)  FROM posteocupee WHERE libelle = ? AND idPO!= ?');
        $req->execute(array($libelle,$idPO));
        $count = $req->fetchColumn();

        if ($count > 0)
        {
            header('location: AjoutPosteOcupee.php?message='.$libelle.' existe dans la base, veuillez choisiir un autre nom&action=edit&id='.$idPO);
            exit;
        }

        $req = $bdd->prepare('UPDATE posteocupee SET libelle = :libelle WHERE idPO= :idPO');
        $req->execute(array(
            'libelle' => $libelle,
            'idPO' => $idPO
        ));

        header('location: PosteOcupee.php?message=ok&message1=Mise a jour effectuee avec succes');
        exit;
    }

}
else
{
    header('location: PosteOcupee.php');
    exit;
}
?>