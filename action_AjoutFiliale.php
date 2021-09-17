<?php 
include('config/connexion.php');
if (isset($_POST['valider']))
{
    $id = $_POST['id'];
    $siglefiliale = $_POST['siglefiliale'];
    $nomfiliale = $_POST['nomfiliale'];
    $responsablefiliale = $_POST['responsblefiliale'];
    $adressefiliale = $_POST['adressefiliale'];
    $telephonefiliale = $_POST['telephonefiliale'];
    //shjsd
    
    if ($id == -1)
    {
        $req = $bdd->prepare('SELECT count(filialecode)  FROM filiale WHERE filialesigle = ?');
        $req->execute(array($siglefiliale));
        $count = $req->fetchColumn();
        
        if ($count > 0)
        {
            header('location: ajouter_filiale.php?message='.$siglefiliale.' existe dans la base, veuillez choisiir un autre sigle.');
            exit;
        }
        
        $req = $bdd->prepare('SELECT count(filialecode)  FROM filiale WHERE filialenom = ?');
        $req->execute(array($nomfiliale));
        $count = $req->fetchColumn();
        
        if ($count > 0)
        {
            header('location: ajouter_filiale.php?message='.$nomfiliale.' existe dans la base, veuillez choisiir un autre nom.');
            exit;
        }
        
        $req = $bdd->prepare('INSERT INTO filiale(filialesigle, filialenom, filialeresponsable, filialeadresse, filialetel) VALUES(:sigle, :nom, :responsable, :adresse, :filialetel)');
        $req->execute(array(
            'sigle' => $siglefiliale,
            'nom' => $nomfiliale,
            'responsable' => $responsablefiliale,
            'adresse' => $adressefiliale,
            'filialetel' => $telephonefiliale
        ));
        
        $message =  'ok';
        
        
         header('location: ajouter_filiale.php?message='.$message.'&message1=Enregistrement effectuee avec succes');
        exit;
    }
    
    else 
    {
        $req = $bdd->prepare('SELECT count(filialecode)  FROM filiale WHERE filialesigle = ? AND filialecode!= ?');
        $req->execute(array($siglefiliale,$id));
        $count = $req->fetchColumn();
        
        if ($count > 0)
        {
            header('location: ajouter_filiale.php?message='.$siglefiliale.' existe dans la base, veuillez choisiir un autre sigle&action=edit&id='.$id);
            exit;
        }
        
        $req = $bdd->prepare('SELECT count(filialecode)  FROM filiale WHERE filialenom = ? AND filialecode!= ?');
        $req->execute(array($nomfiliale,$id));
        $count = $req->fetchColumn();
        
        if ($count > 0)
        {
            header('location: ajouter_filiale.php?message='.$nomfiliale.' existe dans la base, veuillez choisiir un autre nom&action=edit&id='.$id);
            exit;
        }
        
        $req = $bdd->prepare('UPDATE filiale SET filialesigle = :sigle, filialenom = :nom ,filialeresponsable = :responsable, filialeadresse = :adresse, filialetel = :telephone WHERE filialecode = :id');
        $req->execute(array(
            'sigle' => $siglefiliale,
            'nom' => $nomfiliale,
            'responsable' => $responsablefiliale,
            'adresse' => $adressefiliale,
            'telephone' => $telephonefiliale,
            'id' => $id
        ));
        
        header('location: filiale.php?message=ok&message1=Mise a jour effectuee avec succes');
        exit;
    }
    
}
else
{
	header('location: filiale.php');
    exit;
}
?>