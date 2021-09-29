<?php 
include('config/connexion.php');
if (isset($_POST['valider']))
{
    
    $idLangue = $_POST['idLangue'];
    $libelle = $_POST['libelle'];
   
    
    if ($idLangue == -1)
    {
        $req = $bdd->prepare('SELECT count(idLangue)  FROM langue WHERE libelle = ?');
        $req->execute(array($libelle));
        $count = $req->fetchColumn();
        
       
        
        $req = $bdd->prepare('INSERT INTO langue(libelle) VALUES(:libelle)');
        $req->execute(array(
            'libelle' => $libelle,
                   ));
        
        $message =  'ok';
        
        
         header('location: ajoutLangue.php?message='.$message.'&message1=Enregistrement effectuee avec succes');
        exit;
    }
    
    else 
    {
        $req = $bdd->prepare('SELECT count(idLangue)  FROM langue WHERE libelle = ? AND idLangue!= ?');
        $req->execute(array($libelle,$idLangue));
        $count = $req->fetchColumn();
        
        if ($count > 0)
        {
            header('location: ajoutLangue.php?message='.$libelle.' existe dans la base, veuillez choisiir un autre sigle&action=edit&id='.$idLangue);
            exit;
        }
        
        $req = $bdd->prepare('SELECT count(idLangue)  FROM langue WHERE libelle = ? AND idLangue!= ?');
        $req->execute(array($libelle,$idLangue));
        $count = $req->fetchColumn();
        
        if ($count > 0)
        {
            header('location: ajoutDiplom.php?message='.$libelle.' existe dans la base, veuillez choisiir un autre nom&action=edit&id='.$idLangue);
            exit;
        }
        
        $req = $bdd->prepare('UPDATE langue SET libelle = :libelle WHERE idLangue = :idLangue');
        $req->execute(array(
            'libelle' => $libelle,
           
            'idLangue' => $idLangue
        ));
        
        header('location: langue.php?message=ok&message1=Mise a jour effectuee avec succes');
        exit;
    }
    
}
else
{
	header('location: diploms.php');
    exit;
}
?>