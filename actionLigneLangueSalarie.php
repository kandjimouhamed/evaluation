<?php
include('config/connexion.php');
if (isset($_POST['valider']) && isset($_POST['description']))
{
    
    $idLangue = $_POST['idLangue'];
    $idSalarie = $_POST['idSalarie'];
    $description = $_POST['description'];
  $pieces = implode(",", $description);
  
  

        $req = $bdd->prepare('INSERT INTO languesalarie(idLangue,  idSalarie, description) VALUES(:idLangue, :idSalarie, :description)');
        $req->execute(array(
            'idLangue' => $idLangue,
            'idSalarie' => $idSalarie,
            'description' => $pieces
            

        ));

        $message =  'ok';
        header('location:ajoutSalarie.php#mentions');
       
       
}

    
?>
