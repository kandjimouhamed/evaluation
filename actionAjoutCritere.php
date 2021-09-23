<?php
include('config/connexion.php');
if (isset($_POST['valider']) )
{
    
  
    $idSalarie = $_POST['idSalarie'];
    $idCoef = $_POST['idCoef'];
    $note = $_POST['note'];
   // $pieces = implode(";", $_POST['idCoef']);
   
  
        $req = $bdd->prepare('INSERT INTO evaluer(idSalarie,idCoef,note) VALUES(:idSalarie, :idCoef, :note)');
        $req->execute(array(
            'idSalarie' => $idSalarie,
            'idCoef' => $idCoef,
            'note' => $note

        ));
   
        $message =  'ok';
        header('location:ajoutSalarie.php#critere');
       
       
}

    
?>
