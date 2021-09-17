<?php
include('config/connexion.php');
if (isset($_POST['valider']) && isset($_POST['description']))
{
    
  
    $idSalarie = $_POST['idSalarie'];
    $libelle = $_POST['libelle'];
    $description = $_POST['description'];
  $pieces = implode(",", $description);
  
  

        $req = $bdd->prepare('INSERT INTO langue(libelle, description, idSalarie) VALUES(:libelle, :description, :idSalarie)');
        $req->execute(array(
            'libelle' => $libelle,
            'description' => $pieces,
            'idSalarie' => $idSalarie

        ));

        $message =  'ok';
        header('location:ajoutSalarie.php#mentions?message=ok&message1=Enregistrement effectuee avec succes');
       
       
}

    
?>
