<?php 
include('config/connexion.php');
if (isset($_POST['valider']))
{
    
    $idDiplom = $_POST['idDiplom'];
    $libelle = $_POST['libelle'];
   
    
    if ($idDiplom == -1)
    {
        $req = $bdd->prepare('SELECT count(idDiplom)  FROM diplom WHERE libelle = ?');
        $req->execute(array($libelle));
        $count = $req->fetchColumn();
        
       
        
        $req = $bdd->prepare('INSERT INTO diplom(libelle) VALUES(:libelle)');
        $req->execute(array(
            'libelle' => $libelle,
                   ));
        
        $message =  'ok';
        
        
         header('location: ajoutDiplom.php?message='.$message.'&message1=Enregistrement effectuee avec succes');
        exit;
    }
    
    else 
    {
        $req = $bdd->prepare('SELECT count(idDiplom)  FROM diplom WHERE libelle = ? AND idDiplom!= ?');
        $req->execute(array($libelle,$idDiplom));
        $count = $req->fetchColumn();
        
        if ($count > 0)
        {
            header('location: ajoutDiplom.php?message='.$libelle.' existe dans la base, veuillez choisiir un autre sigle&action=edit&id='.$idDiplom);
            exit;
        }
        
        $req = $bdd->prepare('SELECT count(idDiplom)  FROM diplom WHERE libelle = ? AND idDiplom!= ?');
        $req->execute(array($libelle,$idDiplom));
        $count = $req->fetchColumn();
        
        if ($count > 0)
        {
            header('location: ajoutDiplom.php?message='.$libelle.' existe dans la base, veuillez choisiir un autre nom&action=edit&id='.$idDiplom);
            exit;
        }
        
        $req = $bdd->prepare('UPDATE diplom SET libelle = :libelle WHERE idDiplom = :idDiplom');
        $req->execute(array(
            'libelle' => $libelle,
           
            'idDiplom' => $idDiplom
        ));
        
        header('location: diploms.php?message=ok&message1=Mise a jour effectuee avec succes');
        exit;
    }
    
}
else
{
	header('location: diploms.php');
    exit;
}
?>