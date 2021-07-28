<?php 
include('header.php');
$reponse1 = $bdd->query('SELECT * FROM filiale ORDER BY filialenom ASC');
if (($_SESSION['profil'] != 1))	
{
	$req1 = $bdd->prepare('SELECT * FROM direction WHERE filialecode = ? ORDER BY directionnom ASC');
    $req1->execute(array($_SESSION['filialecode']));
    
    $req2 = $bdd->prepare('SELECT * FROM clients WHERE filialecode = ? ORDER BY nom ASC');
    $req2->execute(array($_SESSION['filialecode']));
    
    $req3 = $bdd->prepare('SELECT * FROM vehicules WHERE filialecode = ? ORDER BY immatriculation ASC');
    $req3->execute(array($_SESSION['filialecode']));
}
else
{
	$req1 = $bdd->prepare('SELECT * FROM direction ORDER BY directionnom ASC');
    $req1->execute();
    
    $req2 = $bdd->prepare('SELECT * FROM clients ORDER BY nom ASC');
    $req2->execute();
    
    $req3 = $bdd->prepare('SELECT * FROM vehicules ORDER BY immatriculation ASC');
    $req3->execute();
}
//$reponse3 = $bdd->query('SELECT * FROM clients ORDER BY nom ASC');
$reponse4 = $bdd->query('SELECT * FROM vehicules ORDER BY immatriculation ASC');
$reponse5 = $bdd->query('SELECT * FROM etat');
$reponse6 = $bdd->query('SELECT * FROM etat ORDER BY ID ASC');
$reponse7 = $bdd->query('SELECT * FROM parcautomobiles ORDER BY IDPARCS ASC');
$reponse8 = $bdd->query('SELECT * FROM parcautomobiles ORDER BY IDPARCS ASC');
$tabEtat= array();
if ($_SESSION['profil'] == 1) {$initfiliale = -1;} 
else {$initfiliale = trim($_SESSION['profil'] );}
$initdirection = -1;
$initclient = -1;
$initvehicule = -1;



$sql = 'SELECT * FROM dossier WHERE 1';

if (($_SESSION['profil'] == 1) && (isset($_REQUEST['filiale'])))
{
 $filtrefiliale = trim($_REQUEST['filiale']);	
 if ($filtrefiliale != -1)
 {
 if ((isset($_REQUEST['direction'])) && (trim($_REQUEST['direction'])!=-1))
 {
  $idDirection = trim($_REQUEST['direction']);	 
  $sql .= ' AND directioncode = '.$idDirection;	 
  $filtredirection = $idDirection;	 
 }
 else
 {
  $sql .= ' AND directioncode IN (SELECT directioncode FROM direction WHERE filialecode = '.$filtrefiliale.') ';	 
 }
}
else
{$filtrefiliale = -1;}
 
}
else
{
  if (($_SESSION['profil'] != 1))	
  {
	 $filtrefiliale = $_SESSION['filialecode'];
	 if ((isset($_REQUEST['direction'])) && (trim($_REQUEST['direction'])!=-1))
     {
       $idDirection = trim($_REQUEST['direction']);	 
       $sql .= ' AND directioncode = '.$idDirection;	 
       $filtredirection = $idDirection;	 
     }
     else
     {
     $sql .= ' AND directioncode IN (SELECT directioncode FROM direction WHERE filialecode = '.$filtrefiliale.') ';	 
     $filtredirection = -1;
     }
	  
  }
  else
  {
	  $filtredirection = -1;
	  $filtrefiliale = -1;
  }
}



if((isset($_REQUEST['client'])) && (trim($_REQUEST['client'])!=-1))
{
	$filtreclient = trim($_REQUEST['client']);
	$sql .=' AND IDCLIENT = '.$filtreclient;
}
else {$filtreclient=-1;}

if((isset($_REQUEST['etat'])) && (trim($_REQUEST['etat'])!=-1))
{
	$filtreetat = trim($_REQUEST['etat']);
	$sql .=' AND CRITERE_ACTION = '.$filtreetat;
}
else {$filtreetat = -1;}

if((isset($_REQUEST['localisation'])) && (trim($_REQUEST['localisation'])!=-1))
{
	$filtrelocalisation = trim($_REQUEST['localisation']);
	$sql .=' AND IDPARC = '.$filtrelocalisation;
}
else {$filtrelocalisation=-1;}


if ((isset($_REQUEST['from'])) && (isset($_REQUEST['to'])))
{
 if ((trim($_REQUEST['from']) != '') && (trim($_REQUEST['to']) != ''))
 {
  $from = trim($_REQUEST['from']);
  $to = trim($_REQUEST['to']);
  $sql .=" AND datedebut BETWEEN '$from' AND '$to'";	 
 }
 else
 {
  $from = "";
  $to = "";	 
 }	
}
else
{
 $from = "";
 $to = "";	
}


$mysqli = new mysqli($hote, $user_bd, $pwd_bd, $bd);
$result = $mysqli->query($sql);


?>
		<div id="content">
			<div id="content-header">
			<div id="breadcrumb">
				 <a href="index.php" title="Retour" class="tip-bottom"><i class="glyphicon glyphicon-home"></i> Accueil</a>
				<a href="#" class="current"><i class="glyphicon glyphicon-dashboard"></i>Tableau de bord</a>
			</div>
             	
			</div>
		
			<div class="container-fluid w3-white" style="font-size:12px;">
		    
			 <div class="w3-row w3-border">
             <div class="w3-col s3">
			 <form action="" name="filtre" method="post">
			 <label>Filiale</label>
  
  <select class="w3-select w3-border" name="filiale" id="filiale" style="" onchange="getDirections(this.value);" >
		 <option value="-1">Tous</option>
  <?php 
                                     while ($donnees = $reponse1->fetch())
                                     {
                                         if ($donnees['filialecode'] == $filtrefiliale)
                                         {echo '<option value="'.$donnees['filialecode'].'" selected>'.$donnees['filialenom'].'</option>'; }
                                         else
                                         { echo '<option value="'.$donnees['filialecode'].'">'.$donnees['filialenom'].'</option>'; }
                                     }
                         ?>             
</select>
 <label>Direction</label>
  
 <div id="blocDirections"> <select class="w3-select w3-border" name="direction" id="direction">
      <option value="-1">Tous</option>
    
      <?php 
                                     while ($donnees = $req1->fetch())
                                     {
                                         if ($donnees['directioncode'] == $filtredirection)
                                         {echo '<option value="'.$donnees['directioncode'].'" selected>'.$donnees['directionnom'].'</option>'; }
                                         else
                                         {echo '<option value="'.$donnees['directioncode'].'">'.$donnees['directionnom'].'</option>'; }
                                     }
                                     ?>                     
     </select></div>
	 
	 <label>Client</label>
  
  <select class="w3-select w3-border" name="client" id="client" style="">
		 <option value="-1">Tous</option>
  <?php 
                                     while ($donnees = $req2->fetch())
                                     {
                                         if ($donnees['IDCLIENT'] == $filtreclient)
                                         {echo '<option value="'.$donnees['IDCLIENT'].'" selected>'.$donnees['nom'].'</option>'; }
                                         else
                                         {echo '<option value="'.$donnees['IDCLIENT'].'">'.$donnees['nom'].'</option>'; }
                                     }
                         ?>             
</select>

	 <label>Vehicule</label>
  
  <select class="w3-select w3-border" name="vehicule" id="vehicule" style="">
		 <option value="-1">Tous</option>
  <?php 
                                     while ($donnees = $reponse4->fetch())
                                     {
                                         if ($donnees['IDVEHICULE'] == $filtrevehicule)
                                         {echo '<option value="'.$donnees['IDVEHICULE'].'" selected>'.$donnees['numchassis'].'</option>'; }
                                         else
                                         {echo '<option value="'.$donnees['IDVEHICULE'].'">'.$donnees['numchassis'].'</option>'; }
                                     }
                         ?>             
</select>
<label>Etat</label>
  
  <select class="w3-select w3-border" name="etat" id="etat" style="">
		 <option value="-1">Tous</option>
  <?php 
                                     while ($donnees = $reponse5->fetch())
                                     {
                                         if ($donnees['ID'] == $filtreetat)
                                         {echo '<option value="'.$donnees['ID'].'" selected>'.$donnees['libelle'].'</option>'; }
                                         else
                                         {echo '<option value="'.$donnees['ID'].'">'.$donnees['libelle'].'</option>'; }
                                     }
                         ?>             
</select>
<label>Localisation</label>
  
  <select class="w3-select w3-border" name="localisation" id="localisation" style="">
		 <option value="-1">Tous</option>
  <?php 
                                     while ($donnees = $reponse8->fetch())
                                     {
                                         if ($donnees['IDPARCS'] == $filtrelocalisation)
                                         {echo '<option value="'.$donnees['IDPARCS'].'" selected>'.$donnees['nom'].'</option>'; }
                                         else
                                         {echo '<option value="'.$donnees['IDPARCS'].'">'.$donnees['nom'].'</option>'; }
                                     }
                         ?>             
</select>
<button name="valider" type="submit" style="width:100%;" class="" style="color:white;">Filtrer</button>	 
			 </form>
			 </div>
             <div class="w3-col s9">
			 <table id="" class="table table-bordered">
			  <caption style="caption-side:top;text-align:center;">LOCALISATION DES VEHICULES</caption>
    <tr>
	    <th>Site</th>
	    
		<?php 
		  while ($donnees = $reponse6->fetch())
        { 
	     echo '<th>'.$donnees['libelle'].'</th>';
		 $tabEtat[] = $donnees['ID'];
	    }
		echo '<th>Total</th>';
		$total2 = 0;
		  while ($donnees = $reponse7->fetch())
        {
         echo '<tr>';
		 $idParc = $donnees['IDPARCS'];
		 $libelleParc = $donnees['nom'];
		 $total = 0;
		 echo '<td>'.$libelleParc.'</td>';
		 for ($i = 0; $i < sizeof($tabEtat); $i++)
         {
          $req = $bdd->prepare('SELECT count(*)  FROM dossier WHERE idetat = ? AND IDPARC = ?');
          $req->execute(array($tabEtat[$i],$idParc));
    
          $tot = $req->fetchColumn();
          $total = $total + $tot;
          //echo '<td style="text-align:right;font-weight: bold;">'.$tot.'</td>';	
		  echo '<td style="text-align:right;"><a href = "tableaudebord.php?etat='.$tabEtat[$i].'&localisation='.$idParc.'&filiale='.$initfiliale.'&direction='.$initdirection.'&client='.$initclient.'&vehicule='.$initvehicule.'">'.$tot.'</a></td>';	  
	     }
		 //echo '<td style="text-align:right;font-weight: bold;">'.$total.'</td>';
		 echo '<td style="text-align:right;font-weight: bold;"><a href = "tableaudebord.php?etat=-1&localisation='.$idParc.'&filiale='.$initfiliale.'&direction='.$initdirection.'&client='.$initclient.'&vehicule='.$initvehicule.'">'.$total.'</a></td>';
		 
         echo '</tr>';
         $total2 = $total2 +$total;		 
        }
		$col = sizeof($tabEtat)+1;
		echo '<tr><td>Total</td>';
		echo '<td colspan="'.$col.'" style="text-align:right;font-weight: bold;"><a href = "tableaudebord.php?etat=-1&localisation=-1&filiale='.$initfiliale.'&direction='.$initdirection.'&client='.$initclient.'&vehicule='.$initvehicule.'">'.$total2.'</a></td></tr>';
		?>
                  
    </table>
			 
			 </div>
             </div> 
            
		 
			<div class="row-fluid">
				<div class="widget-box">
							<!--div class="widget-title">
								<span class="icon">
									<i class="icon-eye-open"></i>
								</span>
								<h5>Details</h5-->
			
							<!--/div-->
							<!--div class="widget-content nopadding">
						  <br/><br/><br/><br/-->
						 
 <!--div style="color: white;padding: 15px;width: 100%;overflow: scroll;border: 1px solid #ccc;"-->						  
  <table id="example" class="table display" style="width:100%;">
    <thead>
                  <tr>
				  <th colspan="9">OR</th>
				  <th colspan="5">Action</th>
				  <th colspan="5">Ressource</th>
				  </tr><tr>
				  <th>Nom</th>
                  <th><div style="width: 100px;">Client</div></th>
                  <th>Vehicule</th>
				  <th>Garantie</th>
                  <th><div style="width: 100px;">Travaux demand&eacute;s</div></th>
                  <th><div style="width: 100px;">Intervenant actuel</div></th>
                  <th><div style="width: 50px;">Etat</div></th>
                  <th>Debut</th>
                  <th>Fin</th>
				  
				  <th>Libelle</th>
				  <th>Resume</th>
				  <th>Debut</th>
				  <th><div style="width: 50px;">Etat</div></th>
				  <th>Fin</th>
				  
				  <th>Piece</th>
				  <th>Motif</th>
				  <th>Debut</th>
				  <th><div style="width: 50px;">Etat</div></th>
				  <th>Fin</th>
				 
				  <!--th>Ressource</th-->
				  </tr>
    </thead>
    <tbody>
         <?php 
              $i =1;
              $idDoc = -1;
            //  while ($donnees = $req->fetch())
            // if ($result->num_rows === 0) {
              while ($donnees =$result->fetch_assoc())
              {
				  if($i== 1){$idDoc=$donnees['dossiercode'];}
                  $client = getClient($donnees['IDCLIENT'],$bdd);
                  $vehicule = getVehicule($donnees['IDVEHICULE'],$bdd);
                  $intervenantActuel = getIntervenantActuel($donnees['dossiercode'],$bdd);
                  $etat0 = getEtat($donnees['idetat'],$bdd);
                  $etat = getEtat($donnees['CRITERE_ACTION'],$bdd);
                  
                  if ($etat0 = 1) {$fin = "";}
                  else {$fin = strftime('%d-%m-%Y',strtotime($donnees['datefin']));}
                 
                  echo '<tr>';
                 echo  '<td>'.$donnees['nom'].'</td>';  
                 echo  '<td>'.$client.'</td>'; 
                 echo  '<td>'.$vehicule.'</td>';
				 echo  '<td>'.$donnees['GARANTIE'].'</td>';
                 echo  '<td>'.$donnees['TRAVAUX_DEMANDE'].'</td>'; 
                 echo  '<td>'.$intervenantActuel.'</td>';
                 echo  '<td>'.$etat.'</td>';
                 echo  '<td>'.strftime('%d-%m-%Y',strtotime($donnees['datedebut'])).'</td>'; 
                 echo  '<td>'.$fin.'</td>'; 
                 $libelle = "";
				 $resume = "";
				 $debut = "";
				 $etat = "";
				 $fin = "";
				 
				 $nature = "";
				 $piece = "";
				 $motif = "";
				 $debutR ="";
				 $etatR = "";
				 $finR = "";
				 
				 $reqActions = $bdd->prepare('SELECT * FROM actions WHERE dossiercode = ?');
                 $reqActions->execute(array($donnees['dossiercode'])); 
				 while ($donneesAction = $reqActions->fetch())
                {
				 $libelle = $libelle .' <br/><hr/>'.$donneesAction['libelleaction'];
				 $resume = $resume .' <br/><hr/>'.$donneesAction['resumer'];
				 $debut = $debut .' <br/><hr/>'.$donneesAction['datedebut'];
				 $fin = $fin .' <br/><hr/>'.$donneesAction['datefin'];
				 $etat = $etat .' <br/><hr/>'.getEtat($donneesAction['idetat'],$bdd);
				}
				
				$reqRessource = $bdd->prepare('SELECT * FROM ressource WHERE dossiercode = ?');
                $reqRessource->execute(array($donnees['dossiercode']));
				while ($donneesRessource = $reqRessource->fetch())
				{
				 $piece = $piece .' <br/><hr/>'.getPiece($donneesRessource['IDPIECE'],$bdd);
				 $motif = $motif .' <br/><hr/>'.$donneesRessource['motif'];
				 $debutR = $debutR .' <br/><hr/>'.$donneesRessource['datedebut'];
				 $etatR = $etatR .' <br/><hr/>'.$donneesRessource['resetat'];
				 $finR = $finR .' <br/><hr/>'.$donneesRessource['datefin'];
				}
				 echo '<td>'.$libelle.'</td><td>'.$resume.'</td><td>'.$debut.'</td><td>'.$etat.'</td><td>'.$fin.'</td>';
				 echo '<td>'.$piece.'</td><td>'.$motif.'</td><td>'.$debutR.'</td><td>'.$etatR.'</td><td>'.$finR.'</td>';
				/*while ($donneesAction = $reqActions->fetch())
                {
				 if ($i > 1) 
				 {echo '</tr><tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>';}
                 echo  '<td>'.$donneesAction['libelleaction'].'</td>';
				 echo  '<td>'.$donneesAction['resumer'].'</td>'; 
				 echo  '<td>'.$donneesAction['datedebut'].'</td>';	
				 echo  '<td>'.getEtat($donneesAction['idetat'],$bdd).'</td>';
				 echo  '<td>'.$donneesAction['datefin'].'</td>';			    
			     $i++;
				}/*
				
				 
				 /*echo '<td>';
				 echo '<table>';
				 $reqRessource = $bdd->prepare('SELECT * FROM ressource WHERE dossiercode = ?');
                 $reqRessource->execute(array($donnees['dossiercode']));
				 while ($donneesRessource = $reqRessource->fetch())
                                      {
										echo '<tr>';
										echo  '<td>'.$donneesRessource['nature'].'</td>';
				                        echo  '<td>'.getPiece($donneesRessource['IDPIECE'],$bdd).'</td>'; 
				                        echo  '<td>'.$donneesRessource['motif'].'</td>'; 
				                        echo  '<td>'.$donneesRessource['datedebut'].'</td>';	
				                        echo  '<td>'.getEtat($donneesRessource['resetat'],$bdd).'</td>';
				                        echo  '<td>'.$donneesRessource['datefin'].'</td>';
										echo '</tr>';
									 }
				 echo '</table>';
				 echo '</td>';*/
                 
                echo '</tr>';
                $i++;
              }
             //}
                ?>
    </tbody>
	<tfoot>
           <tr>
				  <th colspan="9">OR</th>
				  <th colspan="5">Action</th>
				  <th colspan="5">Ressource</th>
				  </tr><tr>
				  <th>Nom</th>
                  <th><div style="width: 100px;">Client</div></th>
                  <th>Vehicule</th>
				  <th>Garantie</th>
                  <th><div style="width: 100px;">Travaux demand&eacute;s</div></th>
                  <th><div style="width: 100px;">Intervenant actuel</div></th>
                  <th><div style="width: 50px;">Etat</div></th>
                  <th>Debut</th>
                  <th>Fin</th>
				  
				  <th>Libelle</th>
				  <th>Resume</th>
				  <th>Debut</th>
				  <th><div style="width: 50px;">Etat</div></th>
				  <th>Fin</th>
				  
				  <th>Piece</th>
				  <th>Motif</th>
				  <th>Debut</th>
				  <th><div style="width: 50px;">Etat</div></th>
				  <th>Fin</th>
				  
				  <!--th>Ressource</th-->
				  </tr>
        </tfoot>
</table>
<!--/div-->			<!--/div--></div></div>
            	</div></div>

               
		<div class="row-fluid">
  <div id="footer" class="span12"> 2019 &copy;  <a href="#">CCBM TECHNOLOGIES ET SOLUTIONS</a> </div>
</div>
	<script src="js/jquery.min.js"></script> 
<script src="js/jquery.ui.custom.js"></script> 
<script src="js/bootstrap.min.js"></script> 
<script src="js/jquery.uniform.js"></script> 

<script src="js/jquery.dataTables.min.js"></script> 
<script src="js/maruti.js"></script> 
<script src="js/maruti.tables.js"></script>
<script src="js/jquery.validate.js"></script>
<script src="js/maruti.form_validation.js"></script>
<script src="js/ajax_xhr.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/autofill/2.3.5/js/dataTables.autoFill.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/3.3.1/js/dataTables.fixedColumns.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/fixedheader/3.1.7/js/dataTables.fixedHeader.js"></script>
<!--script type="text/javascript" src="jquery.dataTables.js"></script-->

<script>

$(document).ready(function() {
    var table = $('#example').DataTable( {
        scrollY:        "300px",
        scrollX:        true,
        scrollCollapse: true,
        paging:         true,
		"lengthChange": false,
        fixedColumns:   {
            leftColumns: 9
        },
	
		
		"oLanguage": {
                   "sProcessing": "Traitement en cours...",
                   "sSearch": "Rechercher&nbsp;:",
                   "sLengthMenu": "Afficher _MENU_ &eacute;l&eacute;ments",
                   "sInfo": "Affichage de l'&eacute;lement _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
                   "sInfoEmpty": "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
                   "sInfoFiltered": "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
                   "sInfoPostFix": "",
                   "sLoadingRecords": "Chargement en cours...",
                   "sZeroRecords": "Aucun &eacute;l&eacute;ment &agrave; afficher",
                   "sEmptyTable": "Aucune donn&eacute;e disponible dans le tableau",
                   "oPaginate": {
                       "sFirst": "Premier&nbsp;&nbsp;",
                       "sPrevious": "Pr&eacute;c&eacute;dent&nbsp;&nbsp;",
                       "sNext": "Suivant",
                       "sLast": "&nbsp;&nbsp;Dernier"
		}, },
		
	
    } );
	
		
} );
</script>
</body>

</html>
