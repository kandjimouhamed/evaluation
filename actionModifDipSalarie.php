<?php
include('config/connexion.php');
if (isset($_POST['valider']) )
{
    $idSalarie = trim($_GET['idSalarie']);
    $idSalarie = $_POST['idSalarie'];
    $idDiplom = $_POST['idDiplom'];
    $libelle = $_POST['libelle'];
    $ecole = $_POST['ecole'];
   $_SESSION['idSalarie'] = $idSalarie;
        $req = $bdd->prepare('INSERT INTO diplomsalarie( idSalarie, idDiplom, libelleLigne, ecole) VALUES( :idSalarie, :idDiplom, :libelle, :ecole)');
        $req->execute(array(
            'idSalarie' => $idSalarie,
            'idDiplom' => $idDiplom,
            'libelle' => $libelle,
            'ecole' => $ecole,
        ));

        $message =  'ok';
        header('location:modiffierSalarie.php?action=edit&idSalarie='.$_SESSION['idSalarie'].'#about');   

}   

?>
