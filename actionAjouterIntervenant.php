<?php
include('config/connexion.php');
if (isset($_POST['valider']))
{
    $id = $_POST['id'];
    $filiale =$_POST['filiale'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $poste = $_POST['poste'];
    $email = $_POST['email'];
    $utilisateur = $_POST['utilisateur'];
    $pwd = $_POST['pwd'];
    $profil = $_POST['profil'];
   
    
    if ($id == -1)
    {
     
        $req = $bdd->prepare('SELECT count(codeintervenant)  FROM intervenant WHERE utilisateur = ?');
        $req->execute(array($utilisateur));
        $count = $req->fetchColumn();
        
        if ($count > 0)
        {
            header('location: ajouter_intervenant.php?message=Le compte '.$utilisateur .' est deja utilise.');
            exit;
        }
        
        $req = $bdd->prepare('INSERT INTO intervenant(nom, prenom, poste, email, utilisateur, pwd, filialecode,profil) VALUES(:nom, :prenom, :poste, :email, :utilisateur, :pwd, :filialecode, :profil)');
        $req->execute(array(
            'nom' => $nom,
            'prenom' => $prenom,
            'poste' => $poste,
            'email' => $email,
            'utilisateur' => $utilisateur,
            'pwd' => md5($pwd),
            'filialecode' => $filiale,
            'profil' => $profil
        ));
        
        $message =  'ok';
        
        
         header('location: ajouter_intervenant.php?message='.$message.'&message1=Enregistrement effectuee avec succes');
        exit;
    }
    
    else 
    {
      
        $req = $bdd->prepare('SELECT count(codeintervenant)  FROM intervenant WHERE utilisateur = ? AND codeintervenant != ?');
        $req->execute(array($utilisateur,$id));
        $count = $req->fetchColumn();
        
        if ($count > 0)
        {
            header('location: ajouter_intervenant.php?message='.$utilisateur.' est deja utilise, veuillez choisir un autre utilisateur&action=edit&id='.$id);
            exit;
        }
        
       

        $req = $bdd->prepare('UPDATE intervenant SET nom = :nom, prenom = :prenom, poste = :poste, email = :email, utilisateur = :utilisateur, pwd = :pwd, filialecode = :filialecode, profil = :profil WHERE codeintervenant = :id');
        $req->execute(array(
            'nom' => $nom,
            'prenom' => $prenom,
            'poste' => $poste,
            'email' => $email,
            'utilisateur' => $utilisateur,
            'pwd' => md5($pwd),
            'filialecode' => $filiale,
            'profil' => $profil,
            'id' => $id
        ));
        
        header('location: intervenant.php?message=ok&message1=Mise a jour effectuee avec succes');
        exit;
    }
    
}
else
{
header('location: intervenant.php');
        exit;
}
?>
