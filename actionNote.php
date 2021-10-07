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
if (isset($_POST['validerLangue']) && isset($_POST['description']))
{
    
    $idLangue = $_POST['idLangue'];
    $idSalarie = $_POST['idSalarie'];
    $description = $_POST['description'];
    $_SESSION['idSalarie'] = $idSalarie;
  $pieces = implode(",", $description);
  
  

        $req = $bdd->prepare('INSERT INTO languesalarie(idLangue,  idSalarie, description) VALUES(:idLangue, :idSalarie, :description)');
        $req->execute(array(
            'idLangue' => $idLangue,
            'idSalarie' => $idSalarie,
            'description' => $pieces
            

        ));

        $message =  'ok';
        $message =  'ok';
        header('location:notes.php?action=edit&idSalarie='.$_SESSION['idSalarie'].'#mentions');
        
}

if (isset($_POST['validerObjective']))
{
    $id = $_POST['id'];
    $idSalarie = $_POST['idSalarie'];
    $libelle = $_POST['libelle'];
    $date = $_POST['date'];
    $_SESSION['idSalarie'] = $idSalarie;

        $req = $bdd->prepare('INSERT INTO objectifs(idSalarie, libelle, date) VALUES (:idSalarie, :libelle, :date)');
        $req->execute(array(
            'idSalarie' => $idSalarie,
            'libelle' => $libelle,
            'date' => $date
           
        ));
        
        $message =  'ok';
        
        
        header('location:notes.php?action=edit&idSalarie='.$_SESSION['idSalarie'].'#objective');
        exit;
   
}
if (isset($_POST['validerCritere']) )
{
 
    $idSalarie = $_POST['idSalarie'];
    $idCoef = $_POST['idCoef'];
    $note = $_POST['note'];
    $_SESSION['idSalarie'] = $idSalarie;
     $req = $bdd->prepare('INSERT INTO evaluer(idSalarie,idCoef,note) VALUES(:idSalarie, :idCoef, :note)');
        $req->execute(array(
            'idSalarie' => $idSalarie,
            'idCoef' => $idCoef,
            'note' => $note

        ));
   
        $message =  'ok';
        header('location:notes.php?action=edit&idSalarie='.$_SESSION['idSalarie'].'#critere');
       
       
}

    
?>