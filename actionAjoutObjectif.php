<?php 
include('config/connexion.php');
if (isset($_POST['valider']))
{
    $id = $_POST['id'];
    $idSalarie = $_POST['idSalarie'];
    $libelle = $_POST['libelle'];
    $date = $_POST['date'];
   
    
    
       
        $req = $bdd->prepare('INSERT INTO objectifs(idSalarie, libelle, date) VALUES (:idSalarie, :libelle, :date)');
        $req->execute(array(
            'idSalarie' => $idSalarie,
            'libelle' => $libelle,
            'date' => $date
           
        ));
        
        $message =  'ok';
        
        
         header('location:ajoutSalarie.php#objective');
        exit;
   
}
?>