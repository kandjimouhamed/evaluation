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


$sql = 'SELECT * FROM dossier WHERE 1';

if (($_SESSION['profil'] == 1) && (isset($_POST['filiale'])))
{
 $filtrefiliale = trim($_POST['filiale']);	
 if ($filtrefiliale != -1)
 {
 if ((isset($_POST['direction'])) && (trim($_POST['direction'])!=-1))
 {
  $idDirection = trim($_POST['direction']);	 
  $sql .= ' AND directioncode = '.$idDirection;	 
  $filtredirection = $idDirection;	 
 }
 else
 {
  $sql .= ' AND directioncode IN (SELECT directioncode FROM direction WHERE filialecode = '.$filtrefiliale.') ';	 
 }
}
else
{$filtrefiliale = '';}
 
}
else
{
  if (($_SESSION['profil'] != 1))	
  {
	 $filtrefiliale = $_SESSION['filialecode'];
	 if ((isset($_POST['direction'])) && (trim($_POST['direction'])!=-1))
     {
       $idDirection = trim($_POST['direction']);	 
       $sql .= ' AND directioncode = '.$idDirection;	 
       $filtredirection = $idDirection;	 
     }
     else
     {
     $sql .= ' AND directioncode IN (SELECT directioncode FROM direction WHERE filialecode = '.$filtrefiliale.') ';	 
     $filtredirection = '';
     }
	  
  }
  else
  {
	  $filtredirection = '';
	  $filtrefiliale = '';
  }
}



if((isset($_POST['client'])) && (trim($_POST['client'])!=-1))
{
	$filtreclient = trim($_POST['client']);
	$sql .=' AND IDCLIENT = '.$filtreclient;
}
else {$filtreclient='';}

if(isset($_POST['etat']))
{
	$filtreetat = trim($_POST['etat']);
	$sql .=' AND CRITERE_ACTION = '.$filtreetat;
}
else {$filtreetat = 1;}

if ((isset($_POST['from'])) && (isset($_POST['to'])))
{
 if ((trim($_POST['from']) != '') && (trim($_POST['to']) != ''))
 {
  $from = trim($_POST['from']);
  $to = trim($_POST['to']);
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

/*if ($_SESSION['profil'] == 1)
{
    
    
    $req = $bdd->prepare('SELECT * FROM dossier');
    $req->execute();
}
else 
{
    
    $req = $bdd->prepare('SELECT * FROM dossier WHERE directioncode IN (SELECT directioncode FROM direction WHERE filialecode = ?)');
    $req->execute(array($_SESSION['filialecode']));
}*/


?>
		<div id="content">
			<div id="content-header">
			<div id="breadcrumb">
				 <a href="index.php" title="Retour" class="tip-bottom"><i class="glyphicon glyphicon-home"></i> Accueil</a>
				<a href="#" class="current"><i class="glyphicon glyphicon-dashboard"></i>Tableau de bord</a>
			</div>
             	
			</div>
		
			<div class="container-fluid">
		 
		 <div class="row-fluid">
					<div class="span12">
						<div class="widget-box">
							<div class="widget-title">
								<span class="icon">
									<i class="glyphicon glyphicon-filter" style="color:grey;"></i>
								</span>
								<h5> Filtrer <?php //echo $requete; echo $req->debugDumpParams();?></h5>
							</div>
							<div class="widget-content">
							<form action="" name="filtre" method="post">
							<table style="border: 1px solid #aaa; width: 400px">
						
					<tr>
	                    	<td style="font-size: 12px;font-weight : bolder;">Filiale</td>
	                    	<td>
	                    	 <select name="filiale" size="1" class="" style="width:340px; background-color:#F6F6F6;font-size: 12px;" <?php if (($_SESSION['profil'] != 1)) {echo 'disabled';} ?> onchange="getFiltreDirections(this.value);" >
                                  
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
                                   </select>
	                    	</td>
						</tr>
						
						<tr>
	                    	<td style="font-size: 12px;font-weight : bolder;">Direction</td>
	                    	<td><div id="blocDirection">
	                    	 <select name="direction" size="1" class="" style="width:340px; background-color:#F6F6F6;font-size: 12px;">
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
                            </select>
	                    	</div></td>
						</tr>
						
						<tr>
	                    	<td style="font-size: 12px;font-weight : bolder;">Client</td>
	                    	<td>
							
	                    	 <select name="client" id="client" size="1" class="" style="width:340px; background-color:#F6F6F6;font-size: 12px;" onchange="getFiltreVehicules(this.value);" >
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
                           
	                    	</td>
	                    	
						</tr>
						
						<tr>
	                    	<td style="font-size: 12px;font-weight : bolder;">Vehicule</td>
	                    	<td>
							<div id ="blocFiltreVehicules">		
	                    	 <select name="vehicule" size="1" class="" style="width:340px; background-color:#F6F6F6;font-size: 12px;">
									 <option value="-1">Tous</option>
  <?php 
                                     while ($donnees = $req3->fetch())
                                     {
                                         if ($donnees['IDVEHICULE'] == $filtrevehicule)
                                         {echo '<option value="'.$donnees['IDVEHICULE'].'" selected>'.$donnees['immatriculation'].'</option>'; }
                                         else
                                         {echo '<option value="'.$donnees['IDVEHICULE'].'">'.$donnees['immatriculation'].'</option>'; }
                                     }
                         ?>  	          
                            </select>
                             </div>
	                    	</td>
						</tr>
						
						
						
							<tr>
	                    	<td style="font-size: 12px;font-weight : bolder;">Etat</td>
	                    	<td style="">
	                    	 <select name="etat" size="1" class="" style="width:340px; background-color:#F6F6F6; font-size: 12px;">
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
	                    	</td>
						</tr>
						
						<tr>
	                    	<td style="font-size: 12px;font-weight : bolder;">Date:</td>
	                    	<td><input type="date" style="font-size: 12px; width:163px; background-color:#F6F6F6;" name="from" value="<?php echo $from;?>">	                  
		                    	- <input type="date" style="font-size: 12px; width:165px; background-color:#F6F6F6;" name="to" id="to" value="<?php echo $to;?>"></td>
						</tr>
						
						<tr>
	                    	<td style="font-size: 12px;font-weight : bolder; text-align:center;" colspan="2"><input type="submit" value="Valider" name="valider" style="width: 390px;"/></td>
	                    	
						</tr>
						
					</table> 	
					</form>			
							</div>
						</div>
					</div>
				</div>
		 
			<div class="row-fluid">
				<div class="widget-box">
							<div class="widget-title">
								<span class="icon">
									<i class="icon-eye-open"></i>
								</span>
								<h5>Liste des OR</h5>
			
							</div>
							<div class="widget-content nopadding">
						  
						 
						  
			<table id="display-table" class="table table-bordered data-table table-striped table-layout ">
    <thead>
                  <th>OR</th>
                  <th>Devis</th>
                  <th>Client</th>
                  <th>Vehicule</th>
                  <th>Objet OR</th>
                  <th>Intervenant actuel</th>
                  <th>Etat</th>
                  <th>Debut</th>
                  <th>Fin</th>
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
                 
                  echo '<tr class="gradeA">';
                 echo  '<td>'.$donnees['nom'].'</td>'; 
                echo  '<td>'.$donnees['NUM_DEVIS'].'</td>'; 
                 echo  '<td>'.$client.'</td>'; 
                 echo  '<td>'.$vehicule.'</td>';
                 echo  '<td>'.$donnees['OBJET_OR'].'</td>'; 
                 echo  '<td>'.$intervenantActuel.'</td>';
                 echo  '<td>'.$etat.'</td>';
                 echo  '<td>'.strftime('%d-%m-%Y',strtotime($donnees['datedebut'])).'</td>'; 
                 echo  '<td>'.$fin.'</td>'; 
                
                 
                 echo '</tr>';
                $i++;
              }
             //}
                ?>
    </tbody>
</table>
			</div></div></div>
            	<div id="blocOR" class="row-fluid">
				<?php	
				  $reqActions = $bdd->prepare('SELECT * FROM actions WHERE dossiercode = ?');
                  $reqActions->execute(array($idDoc));

                  $reqRessource = $bdd->prepare('SELECT * FROM ressource WHERE dossiercode = ?');
                  $reqRessource->execute(array($idDoc));
                 ?> 
					<div class="span6">
						<div class="widget-box">
							<div class="widget-title">
								<span class="icon">
									<i class="icon-eye-open"></i>
								</span>
								<h5>Actions</h5>
							</div>
							<div class="widget-content nopadding">
								<table class="table table table-striped">
									<thead>
										<tr>
											<th>Libelle</th>
											<th>Resume</th>
											<th>Debut</th>
											<th>Etat</th>
											<th>Fin</th>
										</tr>
									</thead>
									<tbody>
									<?php 	
									 while ($donneesAction = $reqActions->fetch())
                                      {
										echo '<tr>';
										echo  '<td>'.$donneesAction['libelleaction'].'</td>';
				                        echo  '<td>'.$donneesAction['resumer'].'</td>'; 
				                        echo  '<td>'.$donneesAction['datedebut'].'</td>';	
				                        echo  '<td>'.getEtat($donneesAction['idetat'],$bdd).'</td>';
				                        echo  '<td>'.$donneesAction['datefin'].'</td>';
										echo '</tr>';
									 }
									?>
										
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="span6">
						<div class="widget-box">
							<div class="widget-title">
								<span class="icon">
									<i class="icon-arrow-right"></i>
								</span>
								<h5>Ressources</h5>
							</div>
							<div class="widget-content nopadding">
								<table class="table table-bordered table-striped">
									<thead>
										<tr>
											<th>Nature</th>
											<th>Piece</th>
											<th>Motif</th>
											<th>Debut</th>
											<th>Etat</th>
											<th>Fin</th>
										</tr>
									</thead>
									<tbody>
										<?php 	
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
									?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					
				</div><hr>

               
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
<script>

</script>

</body>

</html>
