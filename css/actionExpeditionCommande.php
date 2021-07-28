<?php
include('config/connexion.php');
if (isset($_POST['valider']))
{
    $id = $_POST['id'];
    $libelle = $_POST['libelle'];
    
    if ($id == -1)
    {
        $req = $bdd->prepare('SELECT count(ID)  FROM expeditioncommande WHERE libelle = ?');
        $req->execute(array($libelle));
        $count = $req->fetchColumn();
        
        if ($count > 0)
        {
            header('location: ajouter_expeditioncommande.php?message='.$libelle.' deja cree.');
            exit;
        }
        
        
        $req = $bdd->prepare('INSERT INTO expeditioncommande(libelle) VALUES(:libelle)');
        $req->execute(array(
            'libelle' => $libelle
        ));
        
        $message =  'ok';
        
        
         header('location: ajouter_expeditioncommande.php?message='.$message.'&message1=Enregistrement effectuee avec succes');
        exit;
    }
    
    else 
    {
        $req = $bdd->prepare('SELECT count(ID)  FROM expeditioncommande WHERE libelle = ? AND ID!= ?');
        $req->execute(array($libelle,$id));
        $count = $req->fetchColumn();
        
        if ($count > 0)
        {
            header('location: ajouter_expeditioncommande.php?message='.$libelle.' existe dans la base, veuillez choisiir un autre libelle&action=edit&id='.$id);
            exit;
        }
        
        $req = $bdd->prepare('UPDATE expeditioncommande SET libelle = :libelle WHERE ID = :id');
        $req->execute(array(
            'libelle' => $libelle,
            'id' => $id
        ));
        
        header('location: expeditioncommande.php?message=ok&message1=Mise a jour effectuee avec succes');
        exit;
    }
    
}
?>
