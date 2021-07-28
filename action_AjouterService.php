<?php
include('config/connexion.php');
if (isset($_POST['valider']))
{
    $id = $_POST['id'];
    $direction = $_POST['direction'];
    $nom = $_POST['nomservice'];
    $filiale = $_POST['filialeservice'];
    
    if ($id == -1)
    {
        $req = $bdd->prepare('SELECT count(ID)  FROM service WHERE NOM_SERVICE = ? AND directioncode = ?');
        $req->execute(array($nom, $direction));
        $count = $req->fetchColumn();
        
        if ($count > 0)
        {
            header('location: ajouter_service.php?message= '.$nom.' est deja cree.');
            exit;
        }
        
        $req = $bdd->prepare('INSERT INTO service(NOM_SERVICE, directioncode) VALUES(:nom, :direction)');
        $req->execute(array(
            'nom' => $nom,
            'direction' => $direction
        ));
        
        $message =  'ok';
        
        
         header('location: ajouter_service.php?message='.$message.'&message1=Enregistrement effectuee avec succes');
        exit;
    }
    
    else 
    {
        $req = $bdd->prepare('SELECT count(ID)  FROM service WHERE NOM_SERVICE = ? AND directioncode = ? AND ID != ?');
        $req->execute(array($nom,$direction,$id));
        $count = $req->fetchColumn();
        
        if ($count > 0)
        {
            header('location: ajouter_service.php?message='.$nom.' est deja cree, veuillez choisiir un autre nom&action=edit&id='.$id);
            exit;
        }
        
       
        
        $req = $bdd->prepare('UPDATE service SET NOM_SERVICE = :nom, directioncode = :direction WHERE ID = :id');
        $req->execute(array(
            'nom' => $nom,
            'direction' => $direction,
            'id' => $id
        ));
        
        header('location: service.php?message=ok&message1=Mise a jour effectuee avec succes');
        exit;
    }
    
}
else
{
header('location: service.php');
exit;
}
?>