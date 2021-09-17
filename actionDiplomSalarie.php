<?php
include('config/connexion.php');
if (isset($_POST['valider']) )
{
    $idSalarie = $_POST['idSalarie'];
    $idDiplom = $_POST['idDiplom'];
    $libelle = $_POST['libelle'];
    $ecole = $_POST['ecole'];
  
  
  

        $req = $bdd->prepare('INSERT INTO diplomsalarie( idSalarie, idDiplom, libelle, ecole) VALUES( :idSalarie, :idDiplom, :libelle, :ecole)');
        $req->execute(array(
            'idSalarie' => $idSalarie,
            'idDiplom' => $idDiplom,
            'libelle' => $libelle,
            'ecole' => $ecole,
           
          
           

        ));

        $message =  'ok';


        header('location:ajoutSalarie.php#about');
       
}

    
?>
