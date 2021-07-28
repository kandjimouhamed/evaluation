<?php 
ini_set('display_errors', '1');
ini_set('error_reporting', E_ALL);
include('config/connexion.php');

if(isset($_POST['valider']))
{
    
  if((isset($_POST['prenom'])) || (($_POST['prenom']) != ""))
  {
      $prenom = $_POST['prenom'];
  }
  else {$prenom ="";}
  
  $type = $_POST['type'];
  $nom = $_POST['nom'];
  $numero = $_POST['numero'];
  $email = $_POST['email'];
  $telephone = $_POST['telephone'];
  $adresse = $_POST['adresse'];
  
  $filiale = $_POST['filiale'];
  $user = $_POST['idUser'];
        
  $req = $bdd->prepare('SELECT count(numero) FROM fournisseurs WHERE numero = ?');
  $req->execute(array($numero));
  $count = $req->fetchColumn();
  
  if ($count > 0)
  {
	header('location: ajouter_fournisseur.php?message= '.$numero.' est deja dans la base de donnees');
   exit; 
  }
  
  /*$req = $bdd->prepare('SELECT count(nom) FROM clients WHERE telephone = ?');
  $req->execute(array($telephone));
  $count = $req->fetchColumn();
  
  if ($count > 0)
  {
      header('location: ajouter_client.php?message= '.$telephone.' est deja dans la base de donnees');
      exit;
  }*/
  
 // else
 // {	  
  
  $req = $bdd->prepare('INSERT INTO fournisseurs(type, numero, nom,prenom, email, telephone, adresse, filialecode, USERCREATE) VALUES(:type, :numero, :nom, :prenom, :email, :telephone, :adresse, :filiale, :user)');
$req->execute(array(
	'type' => $type,
	'numero' => $numero,
    'nom' => $nom,
    'prenom' => $prenom,
    'email' => $email,
    'telephone' => $telephone,
    'adresse' => $adresse,
    'filiale' => $filiale,
    'user' => $user
	));
//$req->debugDumpParams();
$message =  'ok';
  
  
   header('location: ajouter_fournisseur.php?message='.$message);
   exit;	
//}
}
else if (isset($_POST['modifier']))
{
    if((isset($_POST['prenom'])) || (($_POST['prenom']) != ""))
    {
        $prenom = $_POST['prenom'];
    }
    else {$prenom ="";}
    
    $id = $_POST['id'];
    $type = $_POST['type'];
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $adresse = $_POST['adresse'];
    
    $req = $bdd->prepare('SELECT count(nom) FROM clients WHERE email = ? and IDCLIENT != ?');
    $req->execute(array($email,$id));
    $count = $req->fetchColumn();
    
  /*  if ($count > 0)
    {
        header('location: gestion_client.php?message= '.$email.' est deja dans la base de donnees&action=edit&id='.$id);
        exit;
    }
    
    $req = $bdd->prepare('SELECT count(nom) FROM clients WHERE telephone = ? and IDCLIENT != ?');
    $req->execute(array($telephone,$id));
    $count = $req->fetchColumn();
    
    if ($count > 0)
    {
        header('location: gestion_client.php?message= '.$telephone.' est deja dans la base de donnees&action=edit&id='.$id);
        exit;
    }
    
   */
    
    $req = $bdd->prepare('UPDATE fournisseurs SET type = :type, nom = :nom ,prenom = :prenom, email = :email, telephone = :telephone , adresse = :adresse WHERE ID = :id');
    $req->execute(array(
        'type' => $type,
        'nom' => $nom,
        'prenom' => $prenom,
        'email' => $email,
        'telephone' => $telephone,
        'adresse' => $adresse,
        'id' => $id
    ));
    
    $message =  'ok';
    
    
    header('location: fournisseur.php?message='.$message);
    exit;
    
}
else
{
	header('location: index.php');
   exit;
}
?>
