<?php 
include('header.php');
if ($_SESSION['profil'] == 1)
{
  $reponse1 = $bdd->query('SELECT * FROM filiale ORDER BY filialenom ASC');
  $reponse2 = $bdd->query('SELECT * FROM direction ORDER BY directionnom ASC');
  $reponse3 = $bdd->query('SELECT * FROM piece ORDER BY designation ASC');
  $reponse5 = $bdd->query('SELECT * FROM fournisseurs ORDER BY nom ASC');
  
}
else 
{
  $reponse1 = $bdd->query('SELECT * FROM filiale WHERE filialecode = '.$_SESSION['filialecode'].' ORDER BY filialenom ASC');
  $reponse2 = $bdd->query('SELECT * FROM direction WHERE filialecode = '.$_SESSION['filialecode'].' ORDER BY directionnom ASC');
  $reponse3 = $bdd->query('SELECT * FROM piece WHERE filialecode = '.$_SESSION['filialecode'].' ORDER BY designation ASC');
  $reponse5 = $bdd->query('SELECT * FROM fournisseurs WHERE filialecode = '.$_SESSION['filialecode'].' ORDER BY nom ASC');
}

$reponse = $bdd->query('SELECT * FROM marques ORDER BY nom ASC');
$reponse2 = $bdd->query('SELECT * FROM modeles ORDER BY libelle ASC');
$reponse4 = $bdd->query('SELECT * FROM etatcommande');
$reponse6 = $bdd->query('SELECT * FROM expeditioncommande');
?>

		<div id="content">
			<div id="content-header">
				<div id="breadcrumb">
				<a href="index.php" title="Retour" class="tip-bottom"><i class="glyphicon glyphicon-home"></i> Accueil</a>
				<a href="commandempr.php"><i class="glyphicon glyphicon-tasks"></i>Supply Chan</a>
				<a href="#" class="current"><i class="glyphicon glyphicon-edit"></i>Generer Commande Achat</a>
				</div>
                <!--h1>Ajouter un vehicule</h1-->
			</div>
			
   
		  <div class="row-fluid">
			<div class="span12"> 
              <div class="widget-box">
                <div class="widget-title">
              
                <h5>Commande Fournisseur</h5>     
                </div>					
				
				<div class="w3-container w3-white" style="font-size:12px;">
                 <div class="w3-row-padding">
				 <form class="form-horizontal" method="post" action="actiongenerercommande.php" name="basic_validate">
                 <div class="w3-half">
				 <label>Filiale</label>
	<select class="w3-select w3-border" name="filiale" id="filiale" style="height:28px;" required onchange="getDirections(this.value);" >
		 <option value=""></option>
  <?php 
                                     while ($donnees = $reponse1->fetch())
                                     {
                                         if ($donnees['filialecode'] == $filiale)
                                         {echo '<option value="'.$donnees['filialecode'].'" selected>'.$donnees['filialenom'].'</option>'; }
                                         else
                                         { echo '<option value="'.$donnees['filialecode'].'">'.$donnees['filialenom'].'</option>'; }
                                     }
                         ?>             
</select> 
	<label>Direction</label>
	<div id="blocDirections">
    <select class="w3-select w3-border" name="direction" id="direction" required >
      <option value=""></option>
    
      <?php 
                                     while ($donnees = $reponse2->fetch())
                                     {
                                         if ($donnees['directioncode'] == $direction)
                                         {echo '<option value="'.$donnees['directioncode'].'" selected>'.$donnees['directionnom'].'</option>'; }
                                         else
                                         {echo '<option value="'.$donnees['directioncode'].'">'.$donnees['directionnom'].'</option>'; }
                                     }
                                     ?>                     
     </select>
</div> 
	<label>Marque</label>

    <select class="w3-select w3-border" name="marque" id="marque" required >
      <option value=""></option>
    
      <?php 
                                      while ($donnees = $reponse->fetch())
                   {
                     echo '<option value="'.$donnees['IDMARQUE'].'">'.$donnees['nom'].'</option>'; 
                   }
                                     ?>                     
     </select>
</div>
				 <div class="w3-half">
				<label>Fournisseur</label>

    <select class="w3-select w3-border" name="fournisseur" id="fournisseur" required >
      <option value=""></option>
    
      <?php 
                 while ($donnees = $reponse5->fetch())
                                     {
                                         //if ($donnees['ID'] == $)
                                         //{echo '<option value="'.$donnees['IDPIECE'].'" selected>'.$donnees['designation'].'</option>'; }
                                         //else
                                         {echo '<option value="'.$donnees['ID'].'">'.$donnees['nom'].'</option>'; }
                                     }
                                     ?>                     
     </select>
	 <label>Etat</label>

    <select class="w3-select w3-border" name="etat" id="etat" required >
      <option value=""></option>
    
      <?php 
                 while ($donnees = $reponse4->fetch())
                                     {
                                        echo '<option value="'.$donnees['ID'].'">'.$donnees['libelle'].'</option>'; 
                                     }
                                     ?>                     
     </select>
	 
	 <label>Mode Expedition</label>

    <select class="w3-select w3-border" name="expedition" id="expedition" required >
      <option value=""></option>
    
      <?php 
                 while ($donnees = $reponse6->fetch())
                                     {
                                        echo '<option value="'.$donnees['ID'].'">'.$donnees['libelle'].'</option>'; 
                                     }
                                     ?>                     
     </select>
				 </div>
		<label>Arrivage pr&eacute;vu</label>
    <input class="w3-input w3-border" type="date" name="arrive" style="height:28px;">		
    <input type="hidden" name="user" value = "<?php echo $_SESSION['codeintervenant']; ?>">            
			  </div>
    <hr>
    <button name="" type="submit"  class="w3-bar-item w3-button w3-light-grey" style="width:49%;" name="retour" value="Annuler" onclick="location.href='commandeachat.php'">Annuler</button>
  <button name="valider" type="submit"  class="w3-bar-item w3-button w3-light-grey" style="width:50%;">Valider</button>
  <br/><br/> 	
	
	</div></div></div></div>	</div>
			  
			  
		<div class="row-fluid">
  <div id="footer" class="span12"> 2019 &copy;  <a href="#">CCBM TECHNOLOGIES ET SOLUTIONS</a> </div>
</div>
            <script src="js/jquery.min.js"></script>
            <script src="js/jquery.ui.custom.js"></script>
            <script src="js/bootstrap.min.js"></script>
            <script src="js/jquery.uniform.js"></script>
            <!--script src="js/select2.min.js"></script-->
            <script src="js/jquery.validate.js"></script>
            <script src="js/maruti.js"></script>
            <script src="js/maruti.form_validation.js"></script>
            <script src="js/maruti.interface.js"></script>	
           <script type="text/javascript" src="js/ajax_xhr.js" charset="iso_8859-1"></script>
           <script src="js/divers.js"></script>
		   <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
	</body>

</html>
