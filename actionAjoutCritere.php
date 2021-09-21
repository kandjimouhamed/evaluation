<?php
include('config/connexion.php');
if (isset($_POST['valider']) && isset($_POST['idCoef']))
{
    
  
    $idSalarie = $_POST['idSalarie'];
    $idCoef = $_POST['idCoef'];
   // $pieces = implode(";", $_POST['idCoef']);
    foreach ($idCoef as $value) {
        $work = $value;
  
        $req = $bdd->prepare('INSERT INTO evaluer(idSalarie,idCoef) VALUES(:idSalarie, :idCoef)');
        $req->execute(array(
            'idSalarie' => $idSalarie,
            'idCoef' => $work

        ));
    }
        $message =  'ok';
        header('location:ajoutSalarie.php#critere');
       
       
}

    
?>
