<?php
include('header.php');
if (isset($_GET['action']))
{
	$id = $_GET['id'];	
	
	
	$req = $bdd->prepare('SELECT IDCLIENT  FROM vehicules, clientvehicule WHERE vehicules.IDVEHICULE =  clientvehicule.IDVEHICULE AND vehicules.IDVEHICULE = ?');
	$req->execute(array($id));
	$idclient = $req->fetchColumn();
	//$req->debugDumpParams();
	if (trim($_GET['action'])=='suppr')
	{
	    
	    $req = $bdd->prepare('SELECT count(*) FROM vehicules WHERE IDVEHICULES = ?');
	    $req->execute(array($id));
	    $count = $req->fetchColumn();
	    
	    if ($count > 0)
	    {
	        header('location: vehicule.php?message=erreur');
	        exit;
	    }
	    else
	    {
	    
	    $req = $bdd->prepare('DELETE FROM vehicules WHERE IDVEHICULE = ?');
	    $req->execute(array($id));
	    $req = $bdd->prepare('DELETE FROM clientvehicule WHERE IDVEHICULE = ? AND IDCLIENT = ? AND fin_acquis is null');
	    $req->execute(array($id, $idclient));
	    header('location: vehicule.php?message=ok');
	    exit;
	    }
	}
	else 
	    
	{
	    
	    $req = $bdd->prepare('SELECT *  FROM vehicules WHERE IDVEHICULE = ?');
	    $req->execute(array($id));
	    
	    
	    while ($donnees = $req->fetch())
	    {
	        $idmodele = $donnees['IDMODELE'];
	        $immatriculation = $donnees['immatriculation'];
	        $numchassis =$donnees['numchassis'];
	        $nummoteur = $donnees['nummoteur'];
	        $numbc = $donnees['numbc'];
	        $dmc = $donnees['dmc'];
	        
	    }
	    
	    
	    $reponse = $bdd->query('SELECT * FROM marques ORDER BY nom ASC');
	    $reponse1 = $bdd->query('SELECT * FROM clients ORDER BY nom ASC');
	    $reponse2 = $bdd->query('SELECT * FROM modeles ORDER BY libelle ASC');
	    
	    $req = $bdd->prepare('SELECT IDMARQUE  FROM modeles WHERE IDMODELE = ?');
	    $req->execute(array($idmodele));
	    $idmarque = $req->fetchColumn();
	
	 ?>

		<div id="content">
			<div id="content-header">
				<div id="breadcrumb">
				<a href="index.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Accueil</a>
				<a href="vehicule.php">Vehicule</a>
				<a href="#" class="current"><i class="icon-edit"></i>Modifier vehicule</a>
				</div>
                <!--h1>Modifier vehicule</h1-->
			</div>
			
			<div class="container-fluid">
				<div class="row-fluid">
					<div class="span12">
						
				<div class="w3-container w3-white"><div class="w3-cell-row"><div class="w3-container w3-grey w3-cell">
			     <h3>Modification Vehicule</h3>
              <div style="border-radius: 5px;background-color: #f2f2f2;padding: 20px;">
			  <form class="form-horizontal" method="post" action="actionVehicule.php" name="basic_validate" id="basic_validate" novalidate="novalidate">
                <label class="w3-text-blue"><b>Marque</b> </label>
                  <select class="w3-select" name="marque" id = "marque" onchange="getModeles(this.value);">
                 
                  <?php 
                   while ($donnees = $reponse->fetch())
                   {
                       if ($donnees['IDMARQUE'] == $idmarque)
                       { echo '<option value="'.$donnees['IDMARQUE'].'" selected>'.$donnees['nom'].'</option>'; }
                       else 
                       { echo '<option value="'.$donnees['IDMARQUE'].'">'.$donnees['nom'].'</option>'; }
                   }
                   ?>
                  </select>
               <div class="control-group" id="blocModeles">
                <label class="w3-text-blue"><b>Modele</b></label>
                  <select class="w3-select" name="modele" id = "modele">
                    <?php 
                   while ($donnees = $reponse2->fetch())
                   {
                       if ($donnees['IDMODELE'] == $idmodele)
                       {echo '<option value="'.$donnees['IDMODELE'].'" selected>'.$donnees['libelle'].'</option>';}
                       else
                       { echo '<option value="'.$donnees['IDMODELE'].'">'.$donnees['libelle'].'</option>'; }
                   }
                   ?>
                  </select>
              </div>                    
                <label class="w3-text-blue"><b>Client</b></label>
                  <select class="w3-select" name="client" id = "client">
                  <option value="">---</option>
                  <?php 
                   while ($donnees = $reponse1->fetch())
                   {
                       if ($donnees['IDCLIENT'] == $idclient)
                       { echo '<option value="'.$donnees['IDCLIENT'].'" selected>'.$donnees['nom'].' | '. $donnees['email'] . ' | ' . $donnees['telephone'] . '</option>'; }
                       else
                       {echo '<option value="'.$donnees['IDCLIENT'].'">'.$donnees['nom'].' | '. $donnees['email'] . ' | ' . $donnees['telephone'] . '</option>'; }
                   }
                   ?>
                  </select>
                <label class="w3-text-blue"><b>Immatriculation</b></label>
                <input type="text" name="immatriculation" id="immatriculation" class="w3-input w3-border" placeholder="Immatriculation" value = "<?php echo $immatriculation; ?>"/>
               <label class="w3-text-blue"><b>Chassis</b></label>
               <input type="text" name="chassis" id="chassis" class="w3-input w3-border" placeholder="Chassis" value = "<?php echo $numchassis; ?>"/>
               <label class="w3-text-blue"><b>Numero moteur</b></label>
               <input type="text" name="nummoteur" id="nummoteur" class="w3-input w3-border" placeholder="Numero moteur" value = "<?php echo $nummoteur; ?>"/>
               <label class="w3-text-blue"><b>Numero BC</b></label>
               <input type="text" name="numbc" id="numbc" class="w3-input w3-border" placeholder="Numero BC" value = "<?php echo $numbc; ?>"/>
               <label class="w3-text-blue"><b>DMC</b></label>
               <input type="text" name="dmc" id="dmc" class="w3-input w3-border" placeholder="DMC" value = "<?php echo $dmc; ?>"/>
               <input type="hidden" name="id" value = "<?php echo $id; ?>"/>
               <input type="hidden" name="idclient" value = "<?php echo $idclient; ?>"/>
               <br/><br/><input type="submit" class="w3-btn w3-blue" name="modifier" value="Valider">
               <input type="submit" class="w3-btn w3-blue" name="retour" value="Annuler" onclick="location.href='vehicule.php'" >
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
             <script type="text/javascript" src="js/modele_xhr.js" charset="iso_8859-1"></script>
           <script src="js/divers.js"></script>
	</body>

</html>

  
  
  <?php
}
}
else
{
	header('location: index.php');
   exit;	
}
	
?>
