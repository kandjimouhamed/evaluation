<pre>
<?php
include('config/connexion.php');
if (isset($_POST['valider']))
{
   // $str = $_POST['libele'];
   // $headers = explode(',', $str);
    
   
    $idSalarie = $_POST['idSalarie'];
    $idCoef = $_POST['idCoef'];
    $libelle = $_POST['libele'];
   
   ?>
</pre>
<?php
   

    foreach( $libelle as $key => $d ) {
        $sql = $bdd->prepare( "INSERT INTO evaluer (idSalarie, idCoef, libelle)
        VALUES (:idSalarie, :idCoef,:libelle')");

$sql->execute(array(
    'idSalarie' => $idSalarie,
    'idCoef' => $idCoef,
    'libelle' => $libelle
));
    }
}
    /*foreach ($libelle as $key => $value) {
        $req = $bdd->prepare('INSERT INTO evaluer(idSalarie,idCoef,libelle,) VALUES(:idSalarie, :idCoef, :libelle)');
        $req->execute(array(
            'idSalarie' => $idSalarie,
            'idCoef' => $idCoef,
            'libelle' => $libelle
        ));

        $message =  'ok';
        header('location: evaluer.php?message='.$message.'&message1=Enregistrement effectuee avec succes');
        exit;
}
    
       /* $req = $bdd->prepare('INSERT INTO evaluer(idSalarie,idCoef,libelle,) VALUES(:idSalarie, :idCoef, :libelle)');
        $req->execute(array(
            'idSalarie' => $idSalarie,
            'idCoef' => $idCoef,
            'libelle' => $libelle
        ));

        $message =  'ok';
        header('location: evaluer.php?message='.$message.'&message1=Enregistrement effectuee avec succes');
        exit;
}
else
{
    header('location: langue.php');
    exit;*/
//}

?>
