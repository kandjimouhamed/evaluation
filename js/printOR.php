<?php
include('config/connexion.php');
include('config/functions.php');

$idDossier = $_GET['Id'];
$req = $bdd->prepare('SELECT *  FROM dossier WHERE dossiercode = ?');
$req->execute(array($idDossier));
$reqActions = $bdd->prepare('SELECT * FROM actions WHERE dossiercode = ?');
$reqActions->execute(array($idDossier));

$reqRessource = $bdd->prepare('SELECT * FROM ressource WHERE dossiercode = ?');
$reqRessource->execute(array($idDossier));

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
    $travauxdemandes = $donnees['TRAVAUX_DEMANDE'];
    $travauxeffectues = $donnees['TRAVAUX_EFFECTUES'];
    $etatdossier = $donnees['idetat'];
    $datedebut = $donnees['datedebut'];
    $datefin = $donnees['datefin'];
    $ressource = $donnees['RESSOURCE'];
    $idUser = $donnees['IDUTILISATEUR'];
    
}

if ($etatdossier == 1) {$fin = "En cours";}
else {$fin = strftime('%d-%m-%Y',strtotime($datefin));}
$debut =  strftime('%d-%m-%Y',strtotime($datedebut));

$nomFiliale = getFiliale($direction,$bdd);
$nomDirection = getDirection($direction,$bdd);
$nomCircuit = getCircuit($circuit,$bdd);

$req = $bdd->prepare('SELECT *  FROM clients WHERE IDCLIENT = ?');
$req->execute(array($client));


while ($donnees = $req->fetch())
{
    $numeroClient = $donnees['numero'];
    $nomClient = $donnees['nom'];
    $prenom = $donnees['prenom'];
    $email = $donnees['email'];
    $telephone = $donnees['telephone'];
    $adresse = $donnees['adresse'];
    $contact = $donnees['personneacontacter'];
    $telcontact = $donnees['telephonepersacontacter'];
    
}

$req = $bdd->prepare('SELECT *  FROM vehicules WHERE IDVEHICULE = ?');
$req->execute(array($vehicule));


while ($donnees = $req->fetch())
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

$idEtapeActuel = getIdEtapeActuel($idDossier,$bdd);
$idIntervenantActuel = getIdIntervenantActuel($idDossier,$bdd);
$idServiceActuel = getIdServiceFromEtape($idEtapeActuel,$bdd);
$nomServiceActuel = getService($idServiceActuel,$bdd);

$nomIntervenantActuel = getIntervenantActuel($idDossier,$bdd);
$nomEtapeActuel = getEtapeActuel($idDossier,$bdd);

$reqEtape = $bdd->prepare('SELECT * FROM etape WHERE IDCIRCUIT = ? ORDER BY position ASC');
$reqEtape->execute(array($circuit));

$reqEtape2 = $bdd->prepare('SELECT * FROM etape WHERE IDCIRCUIT = ? ORDER BY position ASC');
$reqEtape2->execute(array($circuit));

$uploads_dir = './uploads/dossiers';
$repertoire = $uploads_dir.'/'.$nom.'/';

 
//exit;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<title>CCBM INDUSTRIES|GESTION DES ORDRES DE REPARATION</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<!--link rel="stylesheet" href="css/bootstrap.min.css" /-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<link rel="stylesheet" href="css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="css/uniform.css" />
<!--link rel="stylesheet" href="css/select2.css" /-->
<link rel="stylesheet" href="css/maruti-style.css" />
<link rel="stylesheet" href="css/maruti-media.css" class="skin-color" />
<link rel="stylesheet" href="css/style.css" />	
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
<link rel="stylesheet" href="css/jquery.gritter.css" />
<script>
function imprimer(divName) {
      var printContents = document.getElementById(divName).innerHTML;    
   var originalContents = document.body.innerHTML;      
   document.body.innerHTML = printContents;     
   window.print();     
   document.body.innerHTML = originalContents;
   }
</script>
<body>
<div class="w3-container w3-white" style="font-size:12px;">
<div id='sectionAimprimer'>
<div class="w3-row">
  
  <div class="w3-col s12">
    <img src="images/logoccbmi.png" style="max-width: 100%; height: auto;"/><hr style="border: 1px ridge;"/>
  </div>

</div>

<div class="w3-row w3-border"> 
  <div class="w3-col s4 w3-border" style="padding:5px;">
   <b>Receptionniste: </b><?php echo getPrenomNom($idUser,$bdd);?><br/><br/>
   <b>NUMERO OR: </b><?php echo $nom;?><br/><br/>
   
  </div>
  <div class="w3-col s4 w3-border" style="padding:5px;">
  <b>Service: </b><?php echo $nomEtapeActuel;?><br/> <br/>
   <b>ETAT OR: </b><?php echo getEtat($etatdossier,$bdd);?><br/><br/>

  </div>
  <div class="w3-col s4 w3-border" style="padding:5px;">
  <b>Date Debut: </b><?php echo $debut;?><br/> <br/>
   <b>Date fin: </b><?php echo $fin;?><br/> <br/>
  </div>
 
</div>
<div class="w3-row"><div class="w3-col s12"> <hr style="border: 1px ridge;"/></div></div>

<div class="w3-row w3-border"> 
  <div class="w3-col s4 w3-border" style="padding:5px;">
   <b>Marque: </b><?php echo $nomMarque;?><br/><br/>
   <b>Modele: </b><?php echo $nomModele;?><br/><br/>
   <b>Immatriculation: </b><?php echo $immat;?><br/> <br/>
   
  </div>
  <div class="w3-col s4 w3-border" style="padding:5px;">
  <b>Numero Moteur: </b><?php echo $moteur;?><br/> <br/>
  <b>Chassis: </b><?php echo $chassis;?><br/><br/>
  <b>Numero BC: </b><?php echo $bc;?><br/> <br/>

  </div>
  <div class="w3-col s4 w3-border" style="padding:5px;">
  <b>DMC: </b><?php echo $dmc;?><br/> <br/>
  <b>Kilometrage: </b><?php echo $kilometrage;?><br/> <br/>
  <b>Garantie: </b><?php echo $garantie;?><br/> <br/>
  </div>
 
</div>


<div class="w3-row"><div class="w3-col s12"> <hr style="border: 1px ridge;"/></div></div>
<div class="w3-row">
<div class="w3-col s6" style="padding:5px;"> 
<table class="w3-table-all table">
    <thead>
      <th>Action</th>
      <th>Resume</th>
      <th>MEP</th>
      <th>MES</th>
      <th>Etat</th>
      <th>Debut</th>
      <th>Fin</th>
    </thead>
	
	   <?php
    while ($donnees = $reqActions->fetch())
				{
				    $idAct2 = $donnees['actioncode'];
				    $libelle = getLibelleAction($donnees['libelleaction'],$bdd);
				    $resume = $donnees['resumer'];
				    $etat = $donnees['idetat'];
				    $debut = $donnees['datedebut'];
				    $datefin = $donnees['datefin'];
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
				   echo '</tr>';
				    
	             }
				    
?>
</table>
</div>
<div class="w3-col s6" style="padding:5px;"> 
<table class="w3-table-all table">
    <thead>
      <th>Piece</th>
      <th>Quantite</th>
      <th>Etat</th>
      <th>Debut</th>
      <th>Fin</th>
    </thead>
	
	<?php
    while ($donnees = $reqRessource->fetch()){				
				    $piece = $donnees['IDPIECE'];
				    $etat = $donnees['resetat'];
				    $quantite = $donnees['quantite'];
				    $debut = $donnees['datedebut'];
				    $datefin = $donnees['datefin'];
				    $valeurEtat = getEtatCommande($etat,$bdd);
				    if (is_null($datefin)) {$fin = '';}
				    else
				    {$fin = strftime('%d-%m-%Y',strtotime($datefin));}
				    
				     $reqPiece = $bdd->prepare('SELECT designation FROM piece WHERE IDPIECE = ?');
                     $reqPiece->execute(array($piece));
                     $libellePiece = $reqPiece->fetchColumn();
				    
				    echo '<tr>';
				    echo '<td>'.$libellePiece.'</td>';
				   echo  '<td>'.$quantite.'</td>';
				   echo  '<td>'.$valeurEtat.'</td>';
				   echo '<td>'.strftime('%d-%m-%Y',strtotime($debut)).'</td>';
				   echo '<td>'.$fin.'</td>';
				   echo '</tr>';
				    
	             }
				    
?>    
	
</table>	
</div>
</div>
<div class="w3-row"><div class="w3-col s12"> <hr style="border: 1px ridge;"/></div></div>

<div class="w3-row"><div class="w3-col s12"> 
		<b style="text-decoration: underline;">TRAVAUX DEMANDES: </b> <?php echo $travauxdemandes;?><br/><br/>
		<b style="text-decoration: underline;">TRAVAUX EFFECTUES PAR LE TECHNICIEN: </b>  <?php echo $travauxeffectues;?><br/><br/>
		<b style="text-decoration: underline;">OBSERVATION: </b> <?php echo $observations;?><br/><br/>
</div></div>

<div class="w3-row"><div class="w3-col s12"> <hr style="border: 1px ridge;"/></div></div>


</div> </div>
<button onClick="imprimer('sectionAimprimer')">Imprimer</button>
<div class="w3-row"><div class="w3-col s12"> <hr style="border: 1px ridge;"/></div></div></td></tbody>
</body>
</html>