<?php
include('config/connexion.php');
if (isset($_GET['idPO']))
{
    $idPO = trim($_GET['idPO']);

    if (trim($_GET['action']) == 'suppr')
    {
        $req = $bdd->prepare('SELECT count(*) FROM posteocupee WHERE idPO = ?');
        $req->execute(array($idPO));
        $count = $req->fetchColumn();

        if ($count > 0)
        {
            header('location: PosteOcupee.php?message=Des direction sont ratachees a la filiale selectionnee, suppression immpossible');
            exit;
        }
        else
        {

            $req = $bdd->prepare('DELETE FROM posteocupee WHERE idPO = ?');
            $req->execute(array($idPO));
            header('location: posteocupee.php?message=ok&message1=Suppression reussie');
            exit;
        }
    }

}
else
{
    header('location: PosteOcupee.php');
    exit;
}
?>
