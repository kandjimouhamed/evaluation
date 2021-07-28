<?php 
ini_set('display_errors', '1');
ini_set('error_reporting', E_ALL);
include('config/connexion.php');
include('config/functions.php');


if(isset($_POST['validerRessource']))
{
 $idDossier = trim($_POST['idDossier']);
 $idEtape = trim($_POST['idEtape']);
 $idIntervenant = trim($_POST['idIntervenant']);
 $idIntervenantRessource = trim($_POST['idIntervenantRessource']);
 $nature = trim($_POST['nature']);
 $piece = trim($_POST['piece']);
 $cout = trim($_POST['cout']);
 $quantite = trim($_POST['quantite']);
 $etat = trim($_POST['etat']);
 $motif = trim($_POST['motif']);
 $finance = trim($_POST['finance']);
 $observation = trim($_POST['observation']);
 $idRessource = trim($_POST['idRessource']);
 
 $req = $bdd->prepare('SELECT count(ressourcecode)  FROM ressource WHERE dossiercode = ? AND IDPIECE = ?');
 $req->execute(array($idDossier,$piece));
 $count = $req->fetchColumn();
 //$req->debugDumpParams(); 
 if (($count > 0) && ($idRessource == -1))
 {
	header('location: edit_dossier.php?editressource=ok&codedossier='.$idDossier.'&message=Piece deja inser&eacute;');
   exit;
 }
 
 $req = $bdd->prepare('SELECT count(ressourcecode)  FROM ressource WHERE dossiercode = ? AND IDPIECE = ? AND ressourcecode != ?');
 $req->execute(array($idDossier,$piece,$idRessource));
 $count1 = $req->fetchColumn();
 
 
  if (($count1 > 0) && ($idRessource > 0))
 {
	 header('location: edit_dossier.php?editressource=ok&codedossier='.$idDossier.'&message=Piece deja inser&eacute;'); 
	 //$req->debugDumpParams();
     exit;
 }
 
 $uploads_dir = './uploads/ressources';
 $uploads = array();
 $repertoire = $uploads_dir.'/'.$idDossier;
 if (!is_dir($repertoire)) {
        mkdir($repertoire);
    }
  $repertoire = $uploads_dir.'/'.$idDossier.'/'.$idEtape;  
   if (!is_dir($repertoire)) {
        mkdir($repertoire);
    }
   $repertoire = $uploads_dir.'/'.$idDossier.'/'.$idEtape.'/'.$piece;  
   if (!is_dir($repertoire)) {
        mkdir($repertoire);
    } 
    
    foreach ($_FILES["justifs"]["error"] as $key => $error) {
        if ($error == UPLOAD_ERR_OK) {
            $tmp_name = $_FILES["justifs"]["tmp_name"][$key];
            $name = $_FILES["justifs"]["name"][$key];
            move_uploaded_file($tmp_name, "$repertoire/$name");
            $uploads[] = "$name";
        }
    } 
   
    $jour = date("Y-m-d");
    
     if ($idRessource == -1)
     { 	 
     $req = $bdd->prepare('INSERT INTO ressource(nature, IDPIECE, resetat, motif, cout, finance, quantite, datedebut, dossiercode, observations, IDINTERVENANT) VALUES(:nature, :piece, :resetat, :motif, :cout, :finance, :quantite, :datedebut, :dossiercode, :observations, :IDINTERVENANT)');
         $req->execute(array(
             'nature' => $nature,
             'piece' => $piece, 
             'resetat' => $etat,
             'motif' => $motif,
             'cout' => $cout,
             'finance' => $finance,
             'quantite' => $quantite,
             'datedebut' => $jour,
             'dossiercode' => $idDossier,
             'observations' => $observation,
             'IDINTERVENANT' => $idIntervenant
         ));
       }
    else
       {
	        if ($etat == 1) {$fin = null;}
	     else {$fin = $jour;}   
	     if($idIntervenantRessource == $idIntervenant)
	     { 
	     $req = $bdd->prepare('UPDATE ressource SET nature = :nature, IDPIECE = :piece, resetat = :resetat, motif = :motif, cout = :cout,  finance = :finance, quantite = :quantite, datedebut = :datedebut, datefin = :datefin, observations = :observations WHERE ressourcecode = :ressourcecode');
         $req->execute(array(
             'nature' => $nature,
             'piece' => $piece,
             'resetat' => $etat,
             'motif' => $motif,
             'cout' => $cout,
             'quantite' => $quantite,
             'finance' => $finance,
             'datedebut' => $jour,
             'datefin' => $fin,
             'observations' => $observation,
             'ressourcecode' => $idRessource
         ));
	     }
	     else
	     { 
	     $req = $bdd->prepare('UPDATE ressource SET resetat = :resetat, datefin = :datefin WHERE ressourcecode = :ressourcecode');
         $req->execute(array(
             'resetat' => $etat,
             'datefin' => $fin,
             'ressourcecode' => $idRessource
         ));
	     }
	   }
         //$req->debugDumpParams();
  header('location: edit_dossier.php?editressource=ok&codedossier='.$idDossier.'&message1=Mise a jour effectue avec succes');
  exit;
}


if(isset($_POST['validerAction']))
{
 $idDossier = trim($_POST['idDossier']);
 $idEtape = trim($_POST['idEtape']);
 $idIntervenant = trim($_POST['idIntervenant']);
 $idIntervenantAction = trim($_POST['idIntervenantAction']);
 $libelle = trim($_POST['libelle']);
 $resume = trim($_POST['resume']);
 $etat = trim($_POST['etat']);
 $mep = trim($_POST['mep']);
 $delai = trim($_POST['delai']);
 $idAction = trim($_POST['idAction']);
 
 if(isset($_POST['mes']) && !empty($_POST['mes']))
 { $mes_Array = $_POST['mes']; }
 else
 {$mes_Array = array();}

$req = $bdd->prepare('SELECT count(actioncode)  FROM actions WHERE dossiercode = ? AND libelleaction = ?');
 $req->execute(array($idDossier,$libelle));
 $count = $req->fetchColumn();
 //$req->debugDumpParams(); 
 if (($count > 0) && ($idRessource == -1))
 {
	header('location: edit_dossier.php?editressource=ok&codedossier='.$idDossier.'&message=Ressource deja cree');
   exit;
 }
 
 $req = $bdd->prepare('SELECT count(actioncode)  FROM actions WHERE dossiercode = ? AND libelleaction = ? AND actioncode != ?');
 $req->execute(array($idDossier,$libelle,$idAction));
 $count1 = $req->fetchColumn();
 
  if (($count1 > 0) && ($idRessource > 0))
 {
	 header('location: edit_dossier.php?editressource=ok&codedossier='.$idDossier.'&message=Ressource deja cree'); 
	 //$req->debugDumpParams();
     exit;
 } 

 
 $uploads_dir = './uploads/actions';
 $uploads = array();
 $repertoire = $uploads_dir.'/'.$idDossier;
 if (!is_dir($repertoire)) {
        mkdir($repertoire);
    }
  $repertoire = $uploads_dir.'/'.$idDossier.'/'.$idEtape;  
   if (!is_dir($repertoire)) {
        mkdir($repertoire);
    }
   $repertoire = $uploads_dir.'/'.$idDossier.'/'.$idEtape.'/'.$libelle;  
   if (!is_dir($repertoire)) {
        mkdir($repertoire);
    } 
    
    foreach ($_FILES["justifs"]["error"] as $key => $error) {
        if ($error == UPLOAD_ERR_OK) {
            $tmp_name = $_FILES["justifs"]["tmp_name"][$key];
            $name = $_FILES["justifs"]["name"][$key];
            move_uploaded_file($tmp_name, "$repertoire/$name");
            $uploads[] = "$name";
        }
    } 
   
    $jour = date("Y-m-d");
    
     if ($idAction == -1)
     {
     $req = $bdd->prepare('INSERT INTO actions(libelleaction, resumer, idetat, datedebut, dossiercode, delai, IDINTERVENANT, MEP) VALUES(:libelle, :resumer, :etat, :datedebut, :dossiercode, :delai, :intervenant, :mep)');
         $req->execute(array(
             'libelle' => $libelle,
             'resumer' => $resume, 
             'etat' => $etat,
             'datedebut' => $jour,
             'dossiercode' => $idDossier,
             'delai' => $delai,
             'intervenant' => $idIntervenant,
             'mep' => $mep
         ));
         
         $req = $bdd->prepare('SELECT MAX(actioncode)  FROM actions WHERE IDINTERVENANT = ?');
         $req->execute(array($idIntervenant));
         $idAct = $req->fetchColumn();
         
		  foreach($mes_Array as $mes)
		 {
		  $req = $bdd->prepare('INSERT INTO mes(IDACTION, IDINTERVENANT) VALUES(:action, :mes)');
         $req->execute(array(
             'action' => $idAct,
             'mes' => $mes
         ));	  
	     } 
       }
       else
       {
	     if ($etat == 1) {$fin = null;}
	     else {$fin = $jour;}    
	     if ($idIntervenant == $idIntervenantAction)
	     {
	     $req = $bdd->prepare('UPDATE actions SET libelleaction = :libelleaction, resumer = :resumer, idetat = :idetat, datefin = :datefin, delai = :delai, MEP = :mep  WHERE actioncode = :actioncode');
         $req->execute(array(
             'libelleaction' => $libelle,
             'resumer' => $resume,
             'idetat' => $etat,
             'datefin' => $fin,
             'delai' => $delai,
             'mep' => $mep,
             'actioncode' => $idAction
         ));
         
          $req = $bdd->prepare('DELETE FROM mes WHERE IDACTION = ?');
          $req->execute(array($idAction));
          
           foreach($mes_Array as $mes)
		 {
		  $req = $bdd->prepare('INSERT INTO mes(IDACTION, IDINTERVENANT) VALUES(:action, :mes)');
         $req->execute(array(
             'action' => $idAction,
             'mes' => $mes
         ));	  
	     } 
          
	    }
	    else
	    {
	     $req = $bdd->prepare('UPDATE actions SET idetat = :idetat, datefin = :datefin, MEP = :mep WHERE actioncode = :actioncode');
         $req->execute(array(
             'idetat' => $etat,
             'datefin' => $fin,
             'mep' => $mep,
             'actioncode' => $idAction
         ));
	    }
	   }
       // $req->debugDumpParams();
  header('location: edit_dossier.php?editaction=ok&codedossier='.$idDossier.'&message1=Mise a jour effectue avec succes');
   exit;
}


session_start();
if(!isset($_SESSION['codeintervenant']))
{
    header('location: login.php');
    exit;
}

if(!isset($_GET['codedossier']))

{
  header('location: dossier.php');
  exit;
}




$codeDossier = trim($_GET['codedossier']);
$req = $bdd->prepare('SELECT *  FROM dossier WHERE dossiercode = ?');
$req->execute(array($codeDossier));


while ($donnees = $req->fetch())
{
    $direction = $donnees['directioncode'];
    $client = $donnees['IDCLIENT'];
    $vehicule = $donnees['IDVEHICULE'];
    $circuit = $donnees['IDCIRCUIT'];
    $nom = $donnees['nom'];
    $devis = $donnees['NUM_DEVIS'];
    $souche = $donnees['SOUCHE'];
    $kilometrage = $donnees['KILOMETRAGE'];
    $objetor = $donnees['OBJET_OR'];
    $observations = $donnees['OBSERVATIONS'];
    $travaux = $donnees['TRAVAUX_EFFECTUES'];
    $travauxdemandes = $donnees['TRAVAUX_DEMANDE'];
    $etatdossier = $donnees['idetat'];
    $datedebut = $donnees['datedebut'];
    $datefin = $donnees['datefin'];
    $ressource = $donnees['RESSOURCE'];
   
}

if ($etatdossier == 1) {$fin = "En cours";}
else {$fin = strftime('%d-%m-%Y',strtotime($datefin));}
$debut =  strftime('%d-%m-%Y',strtotime($datedebut));

$nomFiliale = getFiliale($direction,$bdd);
$nomDirection = getDirection($direction,$bdd);
$nomCircuit = getCircuit($circuit,$bdd);
$idFiliale = getIdFiliale($direction,$bdd);

$req = $bdd->prepare('SELECT *  FROM clients WHERE IDCLIENT = ?');
$req->execute(array($client));


while ($donnees = $req->fetch())
{
    $nomClient = $donnees['nom'];
    $prenom = $donnees['prenom'];
    $email = $donnees['email'];
    $telephone = $donnees['telephone'];
    $adresse = $donnees['adresse'];
    $contact = $donnees['personneacontacter'];
    $telcontact = $donnees['telephonepersacontacter'];
    
}

$reqV = $bdd->prepare('SELECT *  FROM vehicules WHERE IDVEHICULE = ?');
$reqV->execute(array($vehicule));


while ($donnees = $reqV->fetch())
{
    $idmodele = $donnees['IDMODELE'];
    $immat = $donnees['immatriculation'];
    $chassis = $donnees['numchassis'];
    $moteur = $donnees['nummoteur'];
    $bc = $donnees['numbc'];
    $dmc = $donnees['dmc'];
    
    $nomModele = getModele($idmodele,$bdd);
    $nomMarque = getMarque($idmodele,$bdd);
    
}

$idEtapeActuel = getIdEtapeActuel($codeDossier,$bdd);
$idIntervenantActuel = getIdIntervenantActuel($codeDossier,$bdd);
$idServiceActuel = getIdServiceFromEtape($idEtapeActuel,$bdd);
$nomServiceActuel = getService($idServiceActuel,$bdd);

$nomIntervenantActuel = getIntervenantActuel($codeDossier,$bdd);
$nomEtapeActuel = getEtapeActuel($codeDossier,$bdd);

$reqVehicule = $bdd->prepare('SELECT * FROM etape WHERE IDCIRCUIT = ? ORDER BY position ASC');
$reqVehicule->execute(array($circuit));

$uploads_dir = './uploads/dossiers';
$repertoire = $uploads_dir.'/'.$nom.'/';


$reqEtat = $bdd->prepare('SELECT * FROM etat');
$reqEtat->execute();

$reqEtat2 = $bdd->prepare('SELECT * FROM etat');
$reqEtat2->execute();

$reqEtat3 = $bdd->prepare('SELECT * FROM etat');
$reqEtat3->execute();

$reqActions = $bdd->prepare('SELECT * FROM actions WHERE dossiercode = ?');
$reqActions->execute(array($codeDossier));

$reqRessource = $bdd->prepare('SELECT * FROM ressource WHERE dossiercode = ?');
$reqRessource->execute(array($codeDossier));

$reqPrincipale = $bdd->prepare('SELECT * FROM intervenant WHERE filialecode = ?');
$reqPrincipale->execute(array($idFiliale));

$reqSecond = $bdd->prepare('SELECT * FROM intervenant WHERE filialecode = ?');
$reqSecond->execute(array($idFiliale));

$reponse = $bdd->query('SELECT * FROM marques ORDER BY nom ASC');
$reponse2 = $bdd->query('SELECT * FROM modeles ORDER BY libelle ASC');
$reponse3 = $bdd->query('SELECT * FROM piece ORDER BY designation ASC');
$reponse4 = $bdd->query('SELECT * FROM etatcommande');



if(isset($_GET['idRessource']))

{

 $idRessource = trim($_GET['idRessource']);
 $codedossier = trim($_GET['codedossier']);	 
 $req = $bdd->prepare('SELECT *  FROM ressource WHERE ressourcecode = ?');
 $req->execute(array($idRessource));
 
 while ($donnees = $req->fetch())
{
    $valnatureressource = $donnees['nature'];
    $valpieceressource = $donnees['IDPIECE'];
    $valmotifressource = $donnees['motif'];
    $valetatressource = $donnees['resetat'];
    $valcoutressource = $donnees['cout'];
    $valquantite = $donnees['quantite'];
    $valfinanceressource = $donnees['finance'];
    $valobservationsressource = $donnees['observations'];
    $idIntervenantRessource = $donnees['IDINTERVENANT'];
    
    $reqPiece = $bdd->prepare('SELECT IDMODELE FROM piece WHERE IDPIECE = ?');
    $reqPiece->execute(array($valpieceressource));
    $valmodeleressource = $reqPiece->fetchColumn();
    //echo $valmodeleressource;exit;
    
    $reqPiece = $bdd->prepare('SELECT IDMARQUE FROM modeles WHERE IDMODELE = ?');
    $reqPiece->execute(array($valmodeleressource));
    $valmarqueressource = $reqPiece->fetchColumn();
   // echo $valmarqueressource; $reqPiece->debugDumpParams();  exit;
    
}
 if (trim($_GET['editressource']) == "suppr") 
{ 
 $req = $bdd->prepare('DELETE FROM ressource WHERE ressourcecode = ?');
 $req->execute(array($idRessource));
 $uploads_dir = './uploads/ressources';
 $repertoire = $uploads_dir.'/'.$codedossier.'/'.$idEtapeActuel.'/'.$vallibelle;  
 RepEfface($repertoire);
  header('location: edit_dossier.php?editressource=ok&codedossier='.$codedossier);
   exit;
}
 
}
else
{
    $idRessource = -1;
    $valnatureressource = "";
    $valpieceressource = -1;
    $valmotifressource = "";
    $valetatressource = "";
    $valcoutressource = 0;
    $valquantite = 0;
    $valfinanceressource = "";
    $valobservationsressource = "";
    $idIntervenantRessource = -1;
    
    $valmodeleressource = -1;
    $valmarqueressource = -1;
}


if(isset($_GET['idAction']) )

{

 $idAction = trim($_GET['idAction']);
 $codedossier = trim($_GET['codedossier']);	 
 $req = $bdd->prepare('SELECT *  FROM actions WHERE actioncode = ?');
 $req->execute(array($idAction));
 
 while ($donnees = $req->fetch())
{
    $vallibelle = $donnees['libelleaction'];
    $valresume = $donnees['resumer'];
    $valetat = $donnees['idetat'];
    $valdelai = $donnees['delai'];
    $idIntervenantAction = $donnees['IDINTERVENANT'];
    $valmep = $donnees['MEP'];
    
}

    $req = $bdd->prepare('SELECT *  FROM mes WHERE IDACTION = ?');
	$req->execute(array($idAction));
    $mes = array();
	while ($donnees = $req->fetch())
	{
	  $mes[] = $donnees['IDINTERVENANT'];	
	}

 if (trim($_GET['editaction']) == "suppr") 
{ 
 $req = $bdd->prepare('DELETE FROM actions WHERE actioncode = ?');
 $req->execute(array($idAction));
 $uploads_dir = './uploads/actions';
 $repertoire = $uploads_dir.'/'.$codedossier.'/'.$idEtapeActuel.'/'.$vallibelle;  
 RepEfface($repertoire);
  header('location: edit_dossier.php?editaction=ok&codedossier='.$codedossier);
   exit;
}
 
}
else
{
	$idAction = -1;
	$vallibelle = "";
    $valresume = "";
    $valetat = "";
    $valdelai = 0;
    $idIntervenantAction = -1;
    $valmep = "";
}

?>
<!DOCTYPE html>
<html lang="fr">
	
<head>
		<title>GESTION DES ORDRES DE REPARATION | EDITION MARQUES</title><meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="css/bootstrap.min.css" />
		<link rel="stylesheet" href="css/bootstrap-responsive.min.css" />
		<link rel="stylesheet" href="css/uniform.css" />
		<link rel="stylesheet" href="css/select2.css" />		
		<link rel="stylesheet" href="css/maruti-style.css" />
		<link rel="stylesheet" href="css/jquery.gritter.css" />
		<link rel="stylesheet" href="css/maruti-media.css" class="skin-color" />	
		<link rel="stylesheet" href="css/style.css" />	
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
		
		
	</head>
	<body>
		
<!--Header-part-->
<div id="header">
  <h1><a href="#">GESTION DES ORDRES DE REPARATION</a></h1>
</div>
<!--close-Header-part--> 

<!--top-Header-messaages-->
<!--div class="btn-group rightzero"> <a class="top_message tip-left" title="Manage Files"><i class="icon-file"></i></a> <a class="top_message tip-bottom" title="Manage Users"><i class="icon-user"></i></a> <a class="top_message tip-bottom" title="Manage Comments"><i class="icon-comment"></i><span class="label label-important">5</span></a> <a class="top_message tip-bottom" title="Manage Orders"><i class="icon-shopping-cart"></i></a> </div>
<!--close-top-Header-messaages--> 

<!--top-Header-menu-->
<div id="user-nav" class="navbar navbar-inverse">
  <ul class="nav">
    <li class="" ><a title="" href="#"><i class="glyphicon glyphicon-user"></i> <span class="text"><?php echo $_SESSION['utilisateur'].'('.$_SESSION['filialenom'].')'; ?></span></a></li>
    
    <li class=""><a title="" href="logout.php"><i class=" glyphicon glyphicon-log-out "></i> <span class="text">Deconnexion</span></a></li>
  </ul>
</div>
<!-- >div id="search">
  <input type="text" placeholder="Search here..."/>
  <button type="submit" class="tip-left" title="Search"><i class="icon-search icon-white"></i></button>
</div-->
<!--close-top-Header-menu-->     
<div id="sidebar"><a href="#" class="visible-phone"><i class="icon-home"></i> Menu</a><ul>
    <li class="active"><a href="index.php"><i class="glyphicon glyphicon-dashboard"></i> <span>Tableau de bord</span></a> </li>
     <li class="submenu"> <a href="#"><i class="glyphicon glyphicon-th-list"></i> <span>OR</span> </a>
      <ul>
        <li><a href="dossier.php">OR</a></li>
        <li><a href="dossier.php?page=afaire">A faire</a></li>
        <li><a href="dossier.php?page=historiques">Historiques</a></li> 
      </ul>
    </li>
    <li class=""><a href="#"><i class="glyphicon glyphicon-tasks"></i> <span>Suivi Commande</span></a> 
     <ul>
        <li><a href="commandempr.php">MPR</a></li>
        <li><a href="commandeachat.php">SUPPLY CHAN</a></li>   
      </ul>
    </li>
    <li class=""><a href="commandempr.php"><i class="glyphicon glyphicon-tasks"></i> <span>Commande MPR</span></a> </li>
    <?php  if ((isset($_SESSION['profil'])) && ($_SESSION['profil'] == 1)) {?>
    <!--li> <a href="intervenants.php"><i class="icon icon-inbox"></i> <span>Edition</span></a> </li>
    <li><a href="commande_mpr.php"><i class="icon icon-th"></i> <span>Commandes MPR</span></a></li-->
    <li class="submenu"> <a href="#"><i class="glyphicon glyphicon-wrench"></i> <span>Gestion</span> </a>
      <ul>
        <li><a href="client.php">Clients</a></li>
        <li><a href="marque.php">Marques</a></li>
        <li><a href="modele.php">Modele de vehicule</a></li>
         <li><a href="vehicule.php">Vehicules</a></li>
        <li><a href="circuit.php">Gestion des circuits</a></li>
        
      </ul>
    </li>
    
    <li class="submenu"> <a href="#"><i class="glyphicon glyphicon-cog"></i> <span>Administration</span> </a>
      <ul>
        <li><a href="filiale.php">Filiale</a></li>
        <li><a href="direction.php">Direction</a></li>
        <li><a href="parc.php">Parc</a></li>
        <li><a href="service.php">Service</a></li>
        <li><a href="intervenant.php">Intervenants/Compte</a></li>
        <li><a href="etat.php">Etat</a></li>
        
      </ul>
    </li>
   <?php } ?>
  </ul>
</div>

		<div id="content">
			<div id="content-header">
				<div id="breadcrumb">
				<a href="index.php" title="Retour" class="tip-bottom"><i class="icon-home"></i> Accueil</a>
				<a href="dossier.php"><i class="icon-list"></i> OR</a>
				<a href="#" class="current"><i class="icon-edit"></i><?php echo $nom;?></a>
				</div>
			</div>
			
			
			
			
			<div class="container-fluid">
				<div class="row-fluid">
					<div class="span12">
                  <div class="w3-container w3-white">
           <h2>Editer OR</h2>
          <ul class="w3-ul w3-small">
         <li><b>Filiale: </b><?php echo $nomFiliale;?></li>
         <li><b>Direction: </b><?php echo $nomDirection;?></li>
         <li><b>Circuit: </b><?php echo $nomCircuit;?></li>
         <li><b>OR: </b><?php echo $nom;?></li>
         <li><b>Etape: </b><?php echo $nomEtapeActuel;?></li>
         <li><b>Service: </b><?php echo $nomServiceActuel;?></li>
         <li><b>Intervenant: </b><?php echo $nomIntervenantActuel;?></li>
         <li><b>Numero Devis: </b><?php echo $devis;?></li>
         <li><b>Souche: </b><?php echo $souche;?></li>
         <li><b>Kilometrage: </b><?php echo $kilometrage;?></li>
         <li><b>Critere valeur: </b><?php echo number_format($ressource, 0, ',', ' ');?></li>
         <li><b>Date Debut: </b><?php echo $debut;?></li>
         <li><b>Date fin: </b><?php echo $fin;?></li>
         <li><b>Traveaux demand&eacute;s: </b><?php echo $travauxdemandes;?></li>
         <li><b>Objet OR: </b><?php echo $objetor;?></li>
         <li><b>Observations: </b><?php echo $observations;?></li>
         <li><b>Pieces jointes: </b> <br/><?php echo lister_fichiers($repertoire);?></li>
         <li>
	<table class="w3-table-all table table-striped w-auto">
    <tr>
      <th>Action</th>
      <th>Resume</th>
      <th>MEP</th>
      <th>MES</th>
      <th>Etat</th>
      <th>Debut</th>
      <th>Fin</th>
      <th>Pieces jointes</th>
    </tr>
    <?php
    while ($donnees = $reqActions->fetch())
				{
				    $idAct2 = $donnees['actioncode'];
				    $libelle = $donnees['libelleaction'];
				    $resume = $donnees['resumer'];
				    $etat = $donnees['idetat'];
				    $debut = $donnees['datedebut'];
				    $datefin = $donnees['datefin'];
				    $idIntervenantEncours = $donnees['IDINTERVENANT'];
				    $idMep = $donnees['MEP'];
				    $mep = getPrenomNom($idMep,$bdd);
				    
				    $reqMes = $bdd->prepare('SELECT *  FROM mes WHERE IDACTION = ?');
                    $reqMes->execute(array($idAct2));
                    $i = 1;
                    $mes="";
                    while ($donneesMes = $reqMes->fetch())
				    {
					 if($i > 1)
					 {
					   $mes .= ', ';
					 }
					 $mes .= getPrenomNom($donneesMes['IDINTERVENANT'],$bdd);
					 $i++;
					} 
				    
				    $uploads_dir = 'uploads/actions';
				    $repertoire = $uploads_dir.'/'.$codeDossier.'/'.$idEtapeActuel.'/'.$libelle; 
				    
				    $valeurEtat = getEtat($etat,$bdd);
				    if (is_null($datefin)) {$fin = '';}
				    else
				    {$fin = strftime('%d-%m-%Y',strtotime($datefin));}
				    
				    
				    echo '<tr>';
				    echo '<td>'.$libelle.'</td>';
				   echo  '<td>'.$resume.'</td>';
				   echo  '<td>'.$mep.'</td>';
				   echo  '<td>'.$mes.'</td>';
				   echo  '<td>'.$valeurEtat.'</td>';
				   echo '<td>'.strftime('%d-%m-%Y',strtotime($debut)).'</td>';
				   echo '<td>'.$fin.'</td>';
				   //echo '<td>'.lister_fichiers($repertoire.'/').'</td>';
				   echo '<td> <a data-toggle="modal" href="#" data-target="#modal" class="LienModal" rel="'.$repertoire.'"><i class="glyphicon glyphicon-paperclip"></i></a></td>';
				   
				   echo '</tr>';
				    
	             }
				    
?>    
 </table>	 
		 </li>
		 <li>
<table class="w3-table-all table table-striped w-auto">
    <tr>
      <th>Ressource</th>
      <th>Piece</th>
      <th>Motif</th>
      <th>Cout</th>
      <th>Quantite</th>
      <th>Finance</th>
      <th>Etat</th>
      <th>Debut</th>
      <th>Fin</th>
      <th>Observations</th>
      <th>Pieces jointes</th>
    </tr>
    <?php
    while ($donnees = $reqRessource->fetch())
				{
				    $idRes = $donnees['ressourcecode'];
				    $nature = $donnees['nature'];
				    $piece = $donnees['IDPIECE'];
				    $motif = $donnees['motif'];
				    $etat = $donnees['resetat'];
				    $cout = $donnees['cout'];
				    $quantite = $donnees['quantite'];
				    $finance = $donnees['finance'];
				    $debut = $donnees['datedebut'];
				    $datefin = $donnees['datefin'];
				    $observations = $donnees['observations'];
				    $idIntervenantEncours = $donnees['IDINTERVENANT'];
				    $uploads_dir = 'uploads/ressources';
				    $repertoire = $uploads_dir.'/'.$codeDossier.'/'.$idEtapeActuel.'/'.$piece; 
				    
				    $valeurEtat = getEtatCommande($etat,$bdd);
				    if (is_null($datefin)) {$fin = '';}
				    else
				    {$fin = strftime('%d-%m-%Y',strtotime($datefin));}
				    
				     $reqPiece = $bdd->prepare('SELECT designation FROM piece WHERE IDPIECE = ?');
                     $reqPiece->execute(array($piece));
                     $libellePiece = $reqPiece->fetchColumn();
				    
				    echo '<tr>';
				    echo '<td>'.$nature.'</td>';
				    echo '<td>'.$libellePiece.'</td>';
				   echo  '<td>'.$motif.'</td>';
				   echo  '<td>'.$cout.'</td>';
				   echo  '<td>'.$quantite.'</td>';
				   echo  '<td>'.$finance.'</td>';
				   echo  '<td>'.$valeurEtat.'</td>';
				   echo '<td>'.strftime('%d-%m-%Y',strtotime($debut)).'</td>';
				   echo '<td>'.$fin.'</td>';
				   echo  '<td>'.$observations.'</td>';
				   //echo '<td>'.lister_fichiers($repertoire.'/').'</td>';
				   echo '<td> <a data-toggle="modal" href="#" data-target="#modal" class="LienModal" rel="'.$repertoire.'"><i class="glyphicon glyphicon-paperclip"></i></a></td>';
				   
				   echo '</tr>';
				    
	             }
				    
?>    
 </table>	
 
	    </li>
	    
	     <li>
         <button class="w3-button w3-blue" onclick="document.getElementById('id01').style.display='block'">Client</button> 
         <button class="w3-button w3-blue" onclick="document.getElementById('id02').style.display='block'">Vehicule</button> 
         
         </li>
	    
         </ul>
         <div id="id01" class="w3-panel w3-blue w3-display-container" style="display:none">
           <span onclick="this.parentElement.style.display='none'" class="w3-button w3-blue w3-display-topright">x</span>
         <ul class="w3-ul w3-small">
         <li><b>Nom: </b><?php echo $nomClient;?></li>
         <li><b>Prenom: </b><?php echo $prenom;?></li>
         <li><b>Adresse: </b><?php echo $adresse;?></li>
         <li><b>Telephone: </b><?php echo $telephone;?></li>
         <li><b>Email: </b><?php echo $email;?></li>
         <li><b>Contact: </b><?php echo $contact;?></li>
         <li><b>Telephone: </b><?php echo $telcontact;?></li>
         </ul>
      </div>
      <div id="id02" class="w3-panel w3-blue w3-display-container" style="display:none">
        <span onclick="this.parentElement.style.display='none'" class="w3-button w3-blue w3-display-topright">x</span>
         <ul class="w3-ul w3-small">
         <li><b>Immatriculation: </b><?php echo $immat;?></li>
         <li><b>Modele: </b><?php echo $nomModele;?></li>
         <li><b>Marque: </b><?php echo $nomMarque;?></li>
         <li><b>Chassis: </b><?php echo $chassis;?></li>
         <li><b>Moteur: </b><?php echo $moteur;?></li>
         <li><b>Numero BC: </b><?php echo $bc;?></li>
         <li><b>DMC: </b><?php echo $dmc;?></li>
      </ul>
      </div>


							
					</div>
				</div>
				 </div>
				
			</div>
		<div class="row-fluid">
  <div id="footer" class="span12"> 2019 &copy;  <a href="#">CCBM TECHNOLOGIES ET SOLUTIONS</a> </div>
</div>


            <script src="js/jquery.min.js"></script>
            <script src="js/jquery.ui.custom.js"></script>
            <script src="js/bootstrap.min.js"></script>
            <script src="js/jquery.uniform.js"></script>
            <script src="js/jquery.validate.js"></script>
            <script src="js/maruti.js"></script>
            <script src="js/maruti.form_validation.js"></script>
            <script type="text/javascript" src="js/ajax_xhr.js" charset="iso_8859-1"></script>	 
            <script>
function openCity(cityName) {
  var i;
  var x = document.getElementsByClassName("city");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  document.getElementById(cityName).style.display = "block";  
}
</script>


 <script>
 
$(".LienModal").click(function(oEvt){
    oEvt.preventDefault();
    var Id=$(this).attr("rel");
        $(".modal-body").fadeIn(1000).html('<div style="text-align:center; margin-right:auto; margin-left:auto">Patientez...</div>');
        $.ajax({
            type:"GET",
            data : "Id="+Id,
            url:"ajaxfile.php",
            error:function(msg){
                $(".modal-body").addClass("tableau_msg_erreur").fadeOut(800).fadeIn(800).fadeOut(400).fadeIn(400).html('<div style="margin-right:auto; margin-left:auto; text-align:center">Impossible de charger cette page</div>');
            },
            success:function(data){
                $(".modal-body").fadeIn(1000).html(data);
            }
        });
    });
    </script>




   <!-- Event Modal -->
<div id="modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
 
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Pieces jointes</h4>
                </div>
                <div class="modal-body">
                    <p>Loading...</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                    
                </div>
 
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- Event modal -->
	</body>

</html>
