<?php

include('config/connexion.php');
if (isset($_GET['idLangue'])) {
    $idLangue = trim($_GET['idLangue']);

    if (trim($_GET['action']) == 'suppr') {
        $req = $bdd->prepare('SELECT count(idLangue) FROM langue WHERE idLangue = ?');
        $req->execute(array($idLangue));
        $count = $req->fetchColumn();

        if ($count > 0) {
           /* header('location: langue.php?message=le service selectionnee intervient dans des circuits, suppression immpossible');
            exit;
        } else {*/

            $req = $bdd->prepare('DELETE FROM langue WHERE idLangue = ?');
            $req->execute(array($idLangue));

            header('location: langue.php?message=ok&message1=Suppression reussie');
            exit;
        }
    }

} else {
    header('location: langue.php');
    exit;
}
