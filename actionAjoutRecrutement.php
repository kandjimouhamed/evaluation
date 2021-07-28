<?php 
include('config/connexion.php');
if (isset($_POST['valider']))
{
    $idRecrutement = $_POST['idRecrutement'];
    $libelle = $_POST['libelle'];
   
    
    if ($idRecrutement == -1)
    {
        $req = $bdd->prepare('SELECT count(idRecrutement)  FROM recrutement WHERE libelle = ?');
        $req->execute(array($libelle));
        $count = $req->fetchColumn();
        
       
        
        $req = $bdd->prepare('INSERT INTO recrutement(libelle) VALUES(:libelle)');
        $req->execute(array(
            'libelle' => $libelle,
                   ));
        
        $message =  'ok';
        
        
         header('location: ajoutRecrutement.php?message='.$message.'&message1=Enregistrement effectuee avec succes');
        exit;
    }
    
    else 
    {
        $req = $bdd->prepare('SELECT count(idRecrutement)  FROM recrutement WHERE libelle = ? AND idRecrutement!= ?');
        $req->execute(array($libelle,$idRecrutement));
        $count = $req->fetchColumn();
        
        if ($count > 0)
        {
            header('location: ajoutRecrutement.php?message='.$libelle.' existe dans la base, veuillez choisiir un autre sigle&action=edit&id='.$idRecrutement);
            exit;
        }
        
        $req = $bdd->prepare('SELECT count(idRecrutement)  FROM recrutement WHERE libelle = ? AND idRecrutement!= ?');
        $req->execute(array($libelle,$idRecrutement));
        $count = $req->fetchColumn();
        
        if ($count > 0)
        {
            header('location: ajoutRecrutement.php?message='.$libelle.' existe dans la base, veuillez choisiir un autre nom&action=edit&id='.$idRecrutement);
            exit;
        }
        
        $req = $bdd->prepare('UPDATE recrutement SET libelle = :libelle WHERE idRecrutement = :idRecrutement');
        $req->execute(array(
            'libelle' => $libelle,
           
            'idRecrutement' => $idRecrutement
        ));
        
        header('location: recrutement.php?message=ok&message1=Mise a jour effectuee avec succes');
        exit;
    }
    
}
else
{
	header('location: recrutement.php');
    exit;
}
?>