<?php
include('config/connexion.php');
if (isset($_POST['valider']))
{
    $id = $_POST['id'];
    $filiale = $_POST['filiale'];
    $nomdirection = $_POST['nomdirection'];
    $emaildirection = $_POST['emaildirection'];
    
    
    if ($id == -1)
    {
        $req = $bdd->prepare('SELECT count(directioncode)  FROM direction WHERE directionnom = ? AND filialecode = ?');
        $req->execute(array($nomdirection, $filiale));
        $count = $req->fetchColumn();
        
        if ($count > 0)
        {
            header('location: direction.php?message= '.$nomdirection.' est deja cree.');
            exit;
        }
        
        
        
        $req = $bdd->prepare('INSERT INTO direction(directionnom, emailnotification, filialecode) VALUES(:nom, :email, :filiale)');
        $req->execute(array(
            'nom' => $nomdirection,
            'email' => $emaildirection,
            'filiale' => $filiale
        ));
        
        $message =  'ok';
        
        
         header('location: direction.php?message='.$message.'&message1=Enregistrement effectuee avec succes');
        exit;
    }
    
    else 
    {
        $req = $bdd->prepare('SELECT count(directioncode)  FROM direction WHERE directionnom = ? AND filialecode = ? AND directioncode != ?');
        $req->execute(array($nomdirection,$filiale,$id));
        $count = $req->fetchColumn();
        
        if ($count > 0)
        {
            header('location: direction.php?message='.$nomdirection.' est deja cree, veuillez choisiir un autre nom&action=edit&id='.$id);
            exit;
        }
        
       
        
        $req = $bdd->prepare('UPDATE direction SET directionnom = :nom, emailnotification = :email ,filialecode = :filiale WHERE directioncode = :id');
        $req->execute(array(
            'nom' => $nomdirection,
            'email' => $emaildirection,
            'filiale' => $filiale,
            'id' => $id
        ));
        
        header('location: ajouter_direction.php?message=ok&message1=Mise a jour effectuee avec succes');
        exit;
    }
    
}
else
{
 header('location: direction.php');
 exit;
}
?>