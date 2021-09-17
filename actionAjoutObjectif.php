<?php 
include('config/connexion.php');
if (isset($_POST['valider']))
{
    $id = $_POST['id'];
    $idSalarie = $_POST['idSalarie'];
    $libelle = $_POST['libelle'];
    $date = $_POST['date'];
   
    
    if ($id == -1)
    { 
        $req = $bdd->prepare('INSERT INTO objectifs(idSalarie, libelle, date) VALUES (:idSalarie, :libelle, :date)');
        $req->execute(array(
            'idSalarie' => $idSalarie,
            'libelle' => $libelle,
            'date' => $date
           
        ));
        
        $message =  'ok';
        
        
         header('location: ajoutObjectif.php?message='.$message.'&message1=Enregistrement effectuee avec succes');
        exit;
    }
    
    else 
    {
        
        
        $req = $bdd->prepare('UPDATE objectifs SET idSalarie = :idSalarie, libelle = :libelle ,date = :date WHERE id = :id');
        $req->execute(array(
         'idSalarie' => $idSalarie,
         'libelle' => $libelle,
         'date' => $date,
            'id' => $id
        ));
        
        header('location: objectif.php?message=ok&message1=Mise a jour effectuee avec succes');
        exit;
    }
    
}
else
{
	header('location: objectif.php');
    exit;
}
?>