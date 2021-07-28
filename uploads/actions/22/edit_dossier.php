<?php
include('config/connexion.php');
include('config/functions.php');
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
	header('location: edit_dossier.php?editaction=ok&codedossier='.$idDossier.'&messageAction=Action deja cree');
   exit;
 }
 
 $req = $bdd->prepare('SELECT count(actioncode)  FROM actions WHERE dossiercode = ? AND libelleaction = ? AND actioncode != ?');
 $req->execute(array($idDossier,$libelle,$idAction));
 $count1 = $req->fetchColumn();
 
  if (($count1 > 0) && ($idRessource > 0))
 {
	 header('location: edit_dossier.php?editaction=ok&codedossier='.$idDossier.'&messageAction=Action deja cree'); 
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
  header('location: edit_dossier.php?editaction=ok&codedossier='.$idDossier.'&messageAction1=Mise a jour effectue avec succes');
   exit;
}



if(isset($_POST['validerRessource']))
{
 $idDossier = trim($_POST['idDossier']);
 $idEtape = trim($_POST['idEtape']);
 $idIntervenant = trim($_POST['idIntervenant']);
 $idIntervenantRessource = trim($_POST['idIntervenantRessource']);
 $piece = trim($_POST['piece']);
 $quantite = trim($_POST['quantite']);
 $etat = trim($_POST['etat']);
 $idRessource = trim($_POST['idRessource']);
 $refacreer = trim($_POST['refacreer']);
 
 if($refacreer != "") {$piece = 0;}
 
 $req = $bdd->prepare('SELECT count(ressourcecode)  FROM ressource WHERE dossiercode = ? AND IDPIECE = ?');
 $req->execute(array($idDossier,$piece));
 $count = $req->fetchColumn();
 //$req->debugDumpParams(); 
 if (($count > 0) && ($idRessource == -1))
 {
   if($refacreer == "")	 
  { 
	  header('location: edit_dossier.php?editressource=ok&codedossier='.$idDossier.'&messageRessource=Piece deja inser&eacute;');
      exit;
  }
 }
 
 $req = $bdd->prepare('SELECT count(ressourcecode)  FROM ressource WHERE dossiercode = ? AND IDPIECE = ? AND ressourcecode != ?');
 $req->execute(array($idDossier,$piece,$idRessource));
 $count1 = $req->fetchColumn();
 
 
  if (($count1 > 0) && ($idRessource > 0))
 {
	
	 if($refacreer == "")	 
  { 
	 header('location: edit_dossier.php?editressource=ok&codedossier='.$idDossier.'&messageRessource=Piece deja inser&eacute;'); 
	 //$req->debugDumpParams();
     exit;
  }
 }
 
 /*
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
 */  
    $jour = date("Y-m-d");
    
     if ($idRessource == -1)
     { 	 
     $req = $bdd->prepare('INSERT INTO ressource(IDPIECE, resetat, quantite, datedebut, reference_a_creer, dossiercode, IDINTERVENANT) VALUES(:piece, :resetat, :quantite, :datedebut, :reference_a_creer, :dossiercode, :IDINTERVENANT)');
         $req->execute(array(
             'piece' => $piece, 
             'resetat' => $etat,
             'quantite' => $quantite,
             'datedebut' => $jour,
             'reference_a_creer' => $refacreer,
             'dossiercode' => $idDossier, 
             'IDINTERVENANT' => $idIntervenant
         ));
       }
    else
       {
	        if ($etat == 1) {$fin = null;}
	     else {$fin = $jour;}   
	     if($idIntervenantRessource == $idIntervenant)
	     { 
	     $req = $bdd->prepare('UPDATE ressource SET IDPIECE = :piece, resetat = :resetat, quantite = :quantite, datedebut = :datedebut, datefin = :datefin, reference_a_creer = :reference_a_creer WHERE ressourcecode = :ressourcecode');
         $req->execute(array(
             'piece' => $piece,
             'resetat' => $etat,
             'quantite' => $quantite,
             'datedebut' => $jour,
             'datefin' => $fin,
             'reference_a_creer' => $refacreer,
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
	 // echo  $req->debugDumpParams();
     //exit;
         //$req->debugDumpParams();
  header('location: edit_dossier.php?editressource=ok&codedossier='.$idDossier.'&messageRessource1=Mise a jour effectue avec succes');
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
    $garantie = $donnees['GARANTIE'];
    $observations = $donnees['OBSERVATIONS'];
    $travaux = $donnees['TRAVAUX_EFFECTUES'];
    $travauxdemandes = $donnees['TRAVAUX_DEMANDE'];
    $etatdossier = $donnees['CRITERE_ACTION'];
    $datedebut = $donnees['datedebut'];
    $datefin = $donnees['datefin'];
    $parc = $donnees['IDPARC'];
   
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

$reqActions2 = $bdd->prepare('SELECT * FROM actions WHERE dossiercode = ?');
$reqActions2->execute(array($codeDossier));

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
$reponse5 = $bdd->query('SELECT * FROM libelleaction');

$reqParc = $bdd->prepare('SELECT * FROM parcautomobiles');
$reqParc->execute();

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
    $refacreer = $donnees['reference_a_creer'];
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
    $refacreer = "";
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

?>
<html>  
    <head>  
        <title>GESTION DES ORDRES DE REPARATION | EDITION MARQUE</title>  
        <!--script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script-->
        <!--script type="text/javascript" src="http://www.w3cschool.cc/try/jeasyui/jquery.easyui.min.js"></script-->
        <script src="js/jquery.min.js"></script>
        <script src="js/jquery.ui.custom.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.uniform.js"></script>
        <!--script src="js/select2.min.js"></script-->
        <script src="js/jquery.validate.js"></script>
        <script src="js/maruti.js"></script>
        <script src="js/maruti.form_validation.js"></script>
        <script src="js/maruti.interface.js"></script>	
		<script src="js/bootstrap-colorpicker.js"></script> 
        <script src="js/bootstrap-datepicker.js"></script>
        <script>
		$('mes').select2();
		function openCity(evt, cityName) {
		  var i, x, tablinks;
		  x = document.getElementsByClassName("city");
		  for (i = 0; i < x.length; i++) {
			x[i].style.display = "none";
		  }
		  tablinks = document.getElementsByClassName("tablink");
		  for (i = 0; i < x.length; i++) {
			//tablinks[i].className = tablinks[i].className.replace(" w3-grey", "");
		  }
		  document.getElementById(cityName).style.display = "block";
		  //evt.currentTarget.className += " w3-grey";
		}
		</script>
		
		
  <link rel="stylesheet" type="text/css" href="http://www.w3cschool.cc/try/jeasyui/themes/default/easyui.css">
  <link rel="stylesheet" type="text/css" href="http://www.w3cschool.cc/try/jeasyui/themes/icon.css">

  <link rel="stylesheet" href="css/bootstrap.min.css" />
  <link rel="stylesheet" href="css/bootstrap-responsive.min.css" />
  <link rel="stylesheet" href="css/uniform.css" />
  <!--link rel="stylesheet" href="css/select2.css" /-->		
  <link rel="stylesheet" href="css/maruti-style.css" />
  <link rel="stylesheet" href="css/jquery.gritter.css" />
  <link rel="stylesheet" href="css/maruti-media.css" class="skin-color" />	
  <link rel="stylesheet" href="css/style.css" />	
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
  <script src="js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="css/style.css" />	
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
  
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
  <!--script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script-->
  
   <script src='lib/jquery-3.0.0.js' type='text/javascript'></script>

        <!-- select2 css -->
        <link href='lib/select2/dist/css/select2.min.css' rel='stylesheet' type='text/css'>

        <!-- select2 script -->
        <script src='lib/select2/dist/js/select2.min.js'></script>
        <script>
        $(document).ready(function(){

            $("#piece").select2({
                ajax: {
                    url: "getData.php",
                    type: "post",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            searchTerm: params.term // search term
                        };
                    },
                    processResults: function (response) {
                        return {
                            results: response
                        };
                    },
                    cache: true
                }
            });
        });
        
         $(document).ready(function() {
    $('.js-example-basic-single').select2();
});
        
        </script>
  
 

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
			
	<div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title">
   <div class="w3-bar w3-light-grey">
    <button class="w3-bar-item w3-button tablink" onclick="openCity(event,'London')">OR</button>
    <button class="w3-bar-item w3-button tablink" onclick="openCity(event,'Paris')">Actions</button>
    <button class="w3-bar-item w3-button tablink" onclick="openCity(event,'Tokyo')">Ressource</button>
  </div>    
          </div>
		  
  <div class="w3-container w3-white" style="font-size:12px;">
  
 
  <br>
  <div id="London" class="w3-container city" style="witdh:100%;">
 <form name="expedier" action="expedier_dossier.php" method="post" enctype="multipart/form-data"> 
<div class="w3-row">
  <div class="w3-col s4">
    <b>OR: </b><?php echo $nom;?><br/><br/>
	<b>Kilometrage: </b><?php echo $kilometrage;?><br/><br/>
	<b>Debut: </b><?php echo $debut;?><br/><br/>
	<b>Fin: </b><?php echo $fin;?><br/><br/>
	<b>Traveaux demand&eacute;s: </b><?php echo $travauxdemandes;?><br/><br/>
	<b>GARANTIE: </b><?php echo $garantie;?><br/><br/>
	<b>Observations: </b><?php echo $observations;?><br/><br/>
	<label><b>Etat OR</b></label>
                  <select name="etatdossier" style="width: 100%;"  class="w3-select w3-border js-example-basic-single">	
		 <?php 
    while ($donnees = $reqEtat3->fetch())
                   {
                       if($donnees['ID'] == $etatdossier) {echo '<option value="'.$donnees['ID'].'" selected>'.$donnees['libelle'].'</option>';}
                       else {echo '<option value="'.$donnees['ID'].'">'.$donnees['libelle'].'</option>'; }
                   }
                   ?>
    </select>
	
	
  </div>
  <div class="w3-col s4">
    <b>Client: </b><?php echo $nomClient .' '.$prenom;?><br/><br/>
	<b>Adresse: </b><?php echo $adresse;?><br/><br/>
	<b>Tel: </b><?php echo $adresse;?><br/><br/>
	<b>Adresse: </b><?php echo $telephone;?><br/><br/>
	<b>Email: </b><?php echo $email;?><br/><br/>
	<b>Contact: </b><?php echo $contact;?><br/><br/>
	<b>Tel Contact: </b><?php echo $telcontact;?><br/><br/>
	<label><b>Parc</b></label>
                  <select name="parc" style="width: 100%;"  class="w3-select w3-border js-example-basic-single">	
		 <?php 
    while ($donnees = $reqParc->fetch())
                   {
                       if($donnees['IDPARCS'] == $parc) {echo '<option value="'.$donnees['IDPARCS'].'" selected>'.$donnees['nom'].'</option>';}
                       else {echo '<option value="'.$donnees['IDPARCS'].'">'.$donnees['nom'].'</option>'; }
                   }
                   ?>
    </select>
  </div>
  <div class="w3-col s4">
    <b>Immatriculation vehicule: </b><?php echo $immat;?><br/><br/>
	<b>Marque/Modele: </b><?php echo $nomMarque;?>/<?php echo $nomModele;?><br/><br/>
	<b>Chassis: </b><?php echo $chassis;?><br/><br/>
	<b>Moteur: </b><?php echo $moteur;?><br/><br/>
	<b>BC: </b><?php echo $bc;?><br/><br/>
	<b>DMC: </b><?php echo $dmc;?><br/><br/>
	<b>Pieces jointes: </b><?php echo lister_fichiers($repertoire);?><!--br/><br/-->
	<?php 
	$uploads_dir = 'uploads/actions';
	$repertoire = $uploads_dir.'/'.$codeDossier.'/'.$idEtapeActuel.'/'; 
	while ($donnees = $reqActions2->fetch())
	{
	  $lib = $donnees['libelleaction']; 
	  $repertoire .= $lib.'/';
	  echo lister_fichiers($repertoire);
	}
	?>
  </div>
  <div class="w3-col s12">
  <label><b>Travaux effectu&eacute;s</b></label>
    <textarea class="w3-input w3-border" name="travauxeffectues"><?php echo $travaux;?></textarea>	 
	
  </div>
</div>

<input type="hidden" name="idEtape" value = "<?php echo $idEtapeActuel; ?>">
<input type="hidden" name="idDossier" value = "<?php echo $codeDossier; ?>">
<input type="hidden" name="idIntervenant" value = "<?php echo $idIntervenantActuel; ?>"> 
<input type="hidden" name="cout" value = "<?php echo $ressource; ?>"> 
<input type="hidden" name="idCircuit" value = "<?php echo $circuit; ?>">

<hr/>
 <button name="enregistrer" type="submit"  class="w3-bar-item w3-button w3-light-grey" style="width:49%;">Enregistrer</button> 
 <button name="expedier" type="submit"  class="w3-bar-item w3-button w3-light-grey" style="width:50%;">Expedier</button>
</form>
 <br/> <br/> <br/> 


  </div>

  <div id="Paris" class="w3-container city" style="display:none">
   
    <div class="w3-container">
    <?php if( isset($_GET['messageAction'])){ ?>
	  <hr>
	<div class="alert alert-danger">
              <button class="close" data-dismiss="alert">X</button>
    <?php echo $_GET['messageAction']; ?>
    </div>
	<?php
    } 
    
    if (isset($_GET['messageAction1']))
        
    {
        ?>
     <div class="alert alert-success">
              <button class="close" data-dismiss="alert">X</button>
    <?php echo $_GET['messageAction1']; ?>
    </div>
   
   <?php }  ?>
   
   <form name="" action="" method="post" enctype="multipart/form-data" class="form-horizontal">
<div class="w3-row-padding">
  <div class="w3-half">
    <label>Type d&acute;action</label>
	<select name="libelle" style="width:100%;" class="w3-select w3-border js-example-basic-single" <?php if (($idIntervenantAction != $idIntervenantActuel) && ($idAction!= -1)) {echo "disabled";} else { echo "required";}?>>
                    <option value=""></option>
                     <?php 
    while ($donnees = $reponse5->fetch())
                   {
                       if($donnees['ID'] == $valetat) {echo '<option value="'.$donnees['ID'].'" selected>'.$donnees['libelle'].'</option>';}
                       else {echo '<option value="'.$donnees['ID'].'">'.$donnees['libelle'].'</option>'; }
                   }
                   ?>
                  </select>
				  <label>R&eacute;sum&eacute;</label>
                   <input class="w3-select w3-border" type="text" id="resume" name="resume" style="width:100%;height:28px;" value="<?php echo $valresume;?>" <?php if (($idIntervenantAction != $idIntervenantActuel) && ($idAction!= -1)) {echo "disabled";} else { echo "required";}?>>
				  <label>Etat</label>
				  <select name="etat" style="width:100%" class="w3-select w3-border js-example-basic-single">
				  <!--option value="" ></option-->
    <?php 
    while ($donnees = $reqEtat->fetch())
                   {
                       if($donnees['ID'] == $valetat) {echo '<option value="'.$donnees['ID'].'" selected>'.$donnees['libelle'].'</option>';}
                       else {echo '<option value="'.$donnees['ID'].'">'.$donnees['libelle'].'</option>'; }
                   }
                   ?>
    </select>
<label>Pieces jointes</label>	
    <input class="w3-select w3-border" type="file" id="justifs" name="justifs[]" multiple="multiple" class="custom-file-input" <?php if (($idIntervenantAction != $idIntervenantActuel) && ($idAction!= -1)) {echo "disabled";}?>>
   <input type="hidden" name="idEtape" value = "<?php echo $idEtapeActuel; ?>">
    <input type="hidden" name="idDossier" value = "<?php echo $codeDossier; ?>">
    <input type="hidden" name="idIntervenant" value = "<?php echo $idIntervenantActuel; ?>">
    <input type="hidden" name="idAction" value = "<?php echo $idAction; ?>">
    <input type="hidden" name="idIntervenantAction" value = "<?php echo $idIntervenantAction; ?>">    
  </div>
  <div class="w3-half">
  <label>MEP</label>
    <select class="w3-select w3-border js-example-basic-single" name="mep" style="width:100%" <?php if (($idIntervenantAction != $idIntervenantActuel) && ($idAction!= -1)) {echo "disabled";} else { echo "required";}?>>
                    <option value=""  ></option>	
    <?php 
     while ($donnees = $reqPrincipale->fetch())
                   {
                       if($donnees['codeintervenant'] == $valmep) {echo '<option value="'.$donnees['codeintervenant'].'" selected>'.$donnees['prenom'].' '.$donnees['nom'].'</option>';}
                       else {echo '<option value="'.$donnees['codeintervenant'].'">'.$donnees['prenom'].' '.$donnees['nom'].'</option>'; }
                   }
                   ?>
                  </select>
				  <label>MES</label>
				  <select class="w3-select w3-border js-example-basic-single" name="mes[]" style="width:100%" <?php if (($idIntervenantAction != $idIntervenantActuel) && ($idAction!= -1)) {echo "disabled";} else { echo "required";}?>>
                    <option value=""></option>	
    <?php 
    while ($donnees = $reqSecond->fetch())
                   {
                       if(in_array($donnees['codeintervenant'], $mes) == true) {echo '<option value="'.$donnees['codeintervenant'].'" selected>'.$donnees['prenom'].' '.$donnees['nom'].'</option>';}
                       else {echo '<option value="'.$donnees['codeintervenant'].'">'.$donnees['prenom'].' '.$donnees['nom'].'</option>'; }
                   }
                   ?>
                  </select>
				  <label>Delai</label>
				  <input class="w3-input w3-border" type="number" id="delai" name="delai" style="width:100%;height:28px;" value="<?php echo $vallibelle;?>" <?php if (($idIntervenantAction != $idIntervenantActuel) && ($idAction!= -1)) {echo "disabled";} else { echo "required";}?>>

  </div>

</div>
  <hr><p style="text-align:left;"><button name="validerAction" type="submit"  class="w3-bar-item w3-button w3-light-grey" style="width:100%;">Valider</button></p>
  </form>
  <hr/>
  
  <div class="w3-container">
  <table class="w3-table-all table table-striped w-auto">
    <tr>
      <th>Libelle</th>
      <th>Resume</th>
      <th>MEP</th>
      <th>MES</th>
      <th>Etat</th>
      <th>Debut</th>
      <th>Fin</th>
      <th></th>
      <th>Action</th>
    </tr>
    <?php
    while ($donnees = $reqActions->fetch())
				{
				  
	  $idAct2 = $donnees['actioncode'];
				    $IdLibelle = $donnees['libelleaction'];
				    $resume = $donnees['resumer'];
				    $etat = $donnees['idetat'];
				    $debut = $donnees['datedebut'];
				    $datefin = $donnees['datefin'];
				    $idIntervenantEncours = $donnees['IDINTERVENANT'];
				    $idMep = $donnees['MEP'];
				    $mep = getPrenomNom($idMep,$bdd);
					$libelle = getLibelleAction($IdLibelle,$bdd);
				    
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
				    $repertoire = "";  
				    $uploads_dir = 'uploads/actions';
				    $repertoire = $uploads_dir.'/'.$codeDossier.'/'.$idEtapeActuel.'/'.$IdLibelle; 
				    
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
				   echo '<td>'.$repertoire.'</td>';
				   //echo '<td> <a data-toggle="modal" href="#" data-target="#modal" class="LienModal" rel="'.$repertoire.'"><i class="glyphicon glyphicon-paperclip"></i></a></td>';
				   echo '<td><a href = "edit_dossier.php?editaction=ok&codedossier='.$codeDossier.'&idAction='.$idAct2.'"><i class="glyphicon glyphicon-edit"></i></a>';
				if ($idIntervenantEncours == $idIntervenantActuel)  echo '<a href = "edit_dossier.php?editaction=suppr&codedossier='.$codeDossier.'&idAction='.$idAct2.'" onclick="return(confirm(\'Etes-vous sur de vouloir supprimer cette entree?\'));"><i class="glyphicon glyphicon-trash"></i></a></td>';
				   echo '</tr>';
				    
	             }
				    
?>    
 </table>
  </div>
  </div></div>
  


	
  <div id="Tokyo" class="w3-container city" style="display:none">
     <?php if( isset($_GET['messageRessource'])){ ?>
	  <hr>
	<div class="alert alert-danger">
              <button class="close" data-dismiss="alert">X</button>
    <?php echo $_GET['messageRessource']; ?>
    </div>
   
	<?php
    } 
    
    if (isset($_GET['messageRessource1']))
        
    {
        ?>
     <div class="alert alert-success">
              <button class="close" data-dismiss="alert">X</button>
    <?php echo $_GET['messageRessource1']; ?>
    </div> 
   <?php }  ?>

<form action="" method="post" enctype="multipart/form-data">   
 <div class="w3-row-padding">
  <div class="w3-quarter">
    <label>Piece</label>
	<!--select name="piece" style="width:100%;height:28px;" class="w3-select w3-border">
     <option></option!-->
     <select id="piece" name="piece" style="width:100%;height:28px;" >
<option value='0'>- Rechercher une piece -</option>
</select>
    
      <?php 
                                /*     while ($donnees = $reponse3->fetch())
                                     {
                                         if ($donnees['IDPIECE'] == $valpieceressource)
                                         {echo '<option value="'.$donnees['IDPIECE'].'" selected>'.$donnees['reference'].'/'.$donnees['designation'].'</option>'; }
                                         else
                                         {echo '<option value="'.$donnees['IDPIECE'].'">'.$donnees['reference'].'/'.$donnees['designation'].'</option>'; }
                                     }*/
                                     ?>                     
     <!--/select-->
  </div>
  <div class="w3-quarter">
     <label>Piece a remplacer</label>
	 <input class="w3-input w3-border" type="text" id="refacreer" name="refacreer" style="width:100%;height:28px;" value="<?php echo $refacreer;?>" <?php if (($idIntervenantRessource != $idIntervenantActuel) && ($idRessource!= -1)) {echo "disabled";}?>>
  </div>
  <div class="w3-quarter">
    <label>Quantite</label>
	 <input class="w3-input w3-border" type="number" id="quantite" name="quantite" style="width:100%;height:28px;" value="<?php echo $valquantite;?>" <?php if (($idIntervenantRessource != $idIntervenantActuel) && ($idRessource!= -1)) {echo "disabled";}?>>
    <input type="hidden" name="idEtape" value = "<?php echo $idEtapeActuel; ?>">
    <input type="hidden" name="idDossier" value = "<?php echo $codeDossier; ?>">
    <input type="hidden" name="idIntervenant" value = "<?php echo $idIntervenantActuel; ?>">
    <input type="hidden" name="idRessource" value = "<?php echo $idRessource; ?>">
    <input type="hidden" name="idIntervenantRessource" value = "<?php echo $idIntervenantRessource; ?>">
  </div>
  <div class="w3-quarter">
     <label>Etat</label>
	<select name="etat" style="width:100%;height:28px;" class="w3-select w3-border js-example-basic-single">
    <?php 
    while ($donnees = $reponse4->fetch())
                   {
                        if($donnees['ID'] == $valetatressource) {echo '<option value="'.$donnees['ID'].'" selected>'.$donnees['libelle'].'</option>';}
                       else {echo '<option value="'.$donnees['ID'].'">'.$donnees['libelle'].'</option>'; }
                   }
                   ?>
    </select>
  </div>
</div>

  <hr><p style="text-align:left;"><button name="validerRessource" type="submit"  class="w3-bar-item w3-button w3-light-grey" style="width:100%;">Valider</button></p>
  
 </form>
    

<hr/>

 <table class="w3-table-all table table-striped w-auto">
    <tr>
      <th>R&eacute;f&eacute;rence Piece</th>
       <th>D&eacute;signation Piece</th>
       <th>Piece a remplacer</th>
      <th>Quantite</th>
      <th>Etat</th>
      <th>Debut</th>
      <th>Fin</th>
      <th>Action</th>
    </tr>
    <?php
    while ($donnees = $reqRessource->fetch())
				{
				    $idRes = $donnees['ressourcecode'];
				    $piece = $donnees['IDPIECE'];
				    $etat = $donnees['resetat'];
				    $quantite = $donnees['quantite'];
				    $debut = $donnees['datedebut'];
				    $datefin = $donnees['datefin'];
				    $refacreer = $donnees['reference_a_creer'];
				    $idIntervenantEncours = $donnees['IDINTERVENANT'];
				    
				    $valeurEtat = getEtatCommande($etat,$bdd);
				    if (is_null($datefin)) {$fin = '';}
				    else
				    {$fin = strftime('%d-%m-%Y',strtotime($datefin));}
				    
				     $reqPiece = $bdd->prepare('SELECT designation FROM piece WHERE IDPIECE = ?');
                     $reqPiece->execute(array($piece));
                     $libellePiece = $reqPiece->fetchColumn();
                     
                     $reqPiece = $bdd->prepare('SELECT reference FROM piece WHERE IDPIECE = ?');
                     $reqPiece->execute(array($piece));
                     $referencePiece = $reqPiece->fetchColumn();
				    
				    echo '<tr>';
				    echo '<td>'.$referencePiece.'</td>';
				    echo '<td>'.$libellePiece.'</td>';
				    echo '<td>'.$refacreer.'</td>';
				   echo  '<td>'.$quantite.'</td>';
				   echo  '<td>'.$valeurEtat.'</td>';
				   echo '<td>'.strftime('%d-%m-%Y',strtotime($debut)).'</td>';
				   echo '<td>'.$fin.'</td>';
				   //echo '<td>'.lister_fichiers($repertoire.'/').'</td>';
				   echo '<td><a href = "edit_dossier.php?editressource=ok&codedossier='.$codeDossier.'&idRessource='.$idRes.'"><i class="glyphicon glyphicon-edit"></i></a>';
				   if ($idIntervenantEncours == $idIntervenantActuel) echo'<a href = "edit_dossier.php?editressource=suppr&codedossier='.$codeDossier.'&idRessource='.$idRes.'" onclick="return(confirm(\'Etes-vous sur de vouloir supprimer cette entree?\'));"><i class="glyphicon glyphicon-trash"></i></a></td>';
				   echo '</tr>';
				    
	             }
				    
?>    
 </table>	
  </div>
  
  
   </div>
   </div></div></div></div>

		
<?php if(isset($_GET['editaction']))

{
 echo '<script type="text/javascript">openCity(event,\'Paris\');</script>'; 		
}

if(isset($_GET['editressource']))

{
 echo '<script type="text/javascript">openCity(event,\'Tokyo\')</script>'; 	
	
}
?>			
<div class="row-fluid">
  <div id="footer" class="span12"> 2019 &copy;  <a href="#">CCBM TECHNOLOGIES ET SOLUTIONS</a> </div>
</div>
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


