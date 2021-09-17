<?php
include('config/connexion.php');
if (isset($_POST['valider']))
{
    $id = $_POST['id'];
    $nom = $_POST['nomservice'];
    $idFiliale = $_POST['idFiliale'];
    
    if ($id == -1)
    {
        $req = $bdd->prepare('SELECT count(ID)  FROM service WHERE NOM_SERVICE = ? AND idFiliale = ?');
        $req->execute(array($nom, $idFiliale));
        $count = $req->fetchColumn();
        
        if ($count > 0)
        {
            header('location: ajouter_service.php?message= '.$nom.' est deja cree.');
            exit;
        }
        
        $req = $bdd->prepare('INSERT INTO service(NOM_SERVICE, idFiliale) VALUES(:nom, :idFiliale)');
        $req->execute(array(
            'nom' => $nom,
            'idFiliale' => $idFiliale
        ));
        
        $message =  'ok';
        
        
         header('location: ajouter_service.php?message='.$message.'&message1=Enregistrement effectuee avec succes');
        exit;
    }
    
    else 
    {
        $req = $bdd->prepare('SELECT count(ID)  FROM service WHERE NOM_SERVICE = ? AND idFiliale = ? AND ID != ?');
        $req->execute(array($nom,$idFiliale,$id));
        $count = $req->fetchColumn();
        
        if ($count > 0)
        {
            header('location: ajouter_service.php?message='.$nom.' est deja cree, veuillez choisiir un autre nom&action=edit&id='.$id);
            exit;
        }
        
       
        
        $req = $bdd->prepare('UPDATE service SET NOM_SERVICE = :nom, idFiliale = :idFiliale WHERE ID = :id');
        $req->execute(array(
            'nom' => $nom,
            'idFiliale' => $idFiliale,
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