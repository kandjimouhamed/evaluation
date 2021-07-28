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
			
			<div class="container-fluid
				<div class="row-fluid">
					<div class="span12"> 	
						<?php if ((isset($_GET['message'])) && (trim($_GET['message'])=='ok')){?>
							<div class="alert alert-success"> <a class="close" data-dismiss="alert" href="#">x</a>
              <h4 class="alert-heading">Succes!</h4>
              Enregistrement effectue avec succes !</div>
              <?php } ?>
              <?php if ((isset($_GET['message'])) && (trim($_GET['message'])!='ok')){?>
				 <div class="alert alert-danger"> <a class="close" data-dismiss="alert" href="#">x</a>
              <h4 class="alert-heading">Erreur!</h4>
               <?php echo $_GET['message']; ?> </div>
              <?php } ?>		
				<div class="w3-container w3-white w3-div w3-small"><div class="w3-cell-row"><div class="w3-container w3-grey w3-cell">
			     <h6>Generer Commande</h6>
              <div style="border-radius: 5px;background-color: #f2f2f2;padding: 20px;">
		      
			<form class="form-horizontal" method="post" action="actiongenerercommande.php" name="basic_validate">
				<label class="w3-text-blue"><b>Filiale</b></label>
                  <select class="w3-select" name="filiale" id = "filiale" onchange="getDirections(this.value);" required>
				  <option></option>	  
                  <?php 
                   while ($donnees = $reponse1->fetch())
                   {
					   
                     echo '<option value="'.$donnees['filialecode'].'">'.$donnees['filialenom']. '</option>'; 
                   }
                   ?>
                  </select>
				
				<div id="blocDirections">
   <label class="w3-text-blue"><b>Direction</b></label>
     <select class="w3-select" name="direction" id="direction" required>
     <option></option>
    
      <?php 
                                     while ($donnees = $reponse2->fetch())
                                     {
                                      //   if ($donnees['directioncode'] == $direction)
                                        // {echo '<option value="'.$donnees['directioncode'].'" selected>'.$donnees['directionnom'].'</option>'; }
                                         //else
                                         {echo '<option value="'.$donnees['directioncode'].'">'.$donnees['directionnom'].'</option>'; }
                                     }
                                     ?>                     
     </select>           
    </div> 
     <label class="w3-text-blue"><b>Marque</b></label>
                	
                  <select class="w3-select" name="marque" id = "marque">
                  <option></option>
                  <?php 
                   while ($donnees = $reponse->fetch())
                   {
                     echo '<option value="'.$donnees['IDMARQUE'].'">'.$donnees['nom'].'</option>'; 
                   }
                   ?>
                  </select>
               

   
      <label class="w3-text-blue"><b>Fournisseur</b></label>
     <select class="w3-select" name="fournisseur" id="fournisseur" required>
     <option></option>
    
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

    <label class="w3-text-blue"><b>Etat</b></label>
     <select class="w3-select" name="etat" id="etat" required>    
      <?php 
                                     while ($donnees = $reponse4->fetch())
                                     {
                                        echo '<option value="'.$donnees['ID'].'">'.$donnees['libelle'].'</option>'; 
                                     }
                                     ?>                     
     </select>    
     
    <label class="w3-text-blue"><b>Mode Expedition</b></label>
     <select class="w3-select" name="expedition" id="expedition" required>    
      <?php 
                                     while ($donnees = $reponse6->fetch())
                                     {
                                        echo '<option value="'.$donnees['ID'].'">'.$donnees['libelle'].'</option>'; 
                                     }
                                     ?>                     
     </select>
     
    <label class="w3-text-blue"><b>Arrivage pr&eacute;vu</b></label>
    <input type="date" name="arrive" id="arrive" class="w3-input w3-border" />
     <input type="hidden" name="user" value = "<?php echo $_SESSION['codeintervenant']; ?>">
     
                <br/><br/>
                 <input type="submit" class="w3-btn w3-blue" name="retour" value="Annuler" onclick="location.href='commandeachat.php'" >
                 <input type="submit" class="w3-btn w3-blue" name="valider" value="Valider">
                </form>	  
                
			  </div></div></div></div>	
			  </div></div></div>
			  
		<div class="row-fluid">
  <div id="footer" class="span12"> 2019 &copy;  <a href="#">CCBM TECHNOLOGIES ET SOLUTIONS</a> </div>
</div>
            <script src="js/jquery.min.js"></script>
            <script src="js/jquery.ui.custom.js"></script>
            <script src="js/bootstrap.min.js"></script>
            <script src="js/jquery.uniform.js"></script>
            <script src="js/select2.min.js"></script>
            <script src="js/jquery.validate.js"></script>
            <script src="js/maruti.js"></script>
            <script src="js/maruti.form_validation.js"></script>
            <script src="js/maruti.interface.js"></script>	
           <script type="text/javascript" src="js/ajax_xhr.js" charset="iso_8859-1"></script>
           <script src="js/divers.js"></script>
	</body>

</html>
