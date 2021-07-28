<?php
include('header.php');
if (isset($_GET['action']))
{
	$id = $_GET['id'];	
	
	$req = $bdd->prepare('SELECT *  FROM fournisseurs WHERE ID = ?');
	$req->execute(array($id));
	
	
	while ($donnees = $req->fetch())
	{
	    $type = $donnees['type'];
	    $numero = $donnees['numero'];
	    $nom = $donnees['nom'];
	    $prenom = $donnees['prenom'];
	    $email =$donnees['email'];
	    $telephone = $donnees['telephone'];
	    $adresse = $donnees['adresse'];
	    
	}
	  
	 ?>


		<div id="content">
			<div id="content-header">
				<div id="breadcrumb">
				<a href="index.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Accueil</a>
				<a href="fournisseur.php"><i class="icon-user"></i>Fournisseur</a>
				<a href="#" class="current"><i class="icon-edit"></i>Modifier Fournisseur</a>
				</div>
                
			</div>
			
			<div class="container-fluid">
				<div class="row-fluid">
					<div class="span12">
						
						
		<div class="w3-container w3-white"><div class="w3-cell-row"><div class="w3-container w3-grey w3-cell">
       <h3>Modifier Client</h3>
       <div style="border-radius: 5px;background-color: #f2f2f2;padding: 20px;">	
		  <?php if ((isset($_GET['message'])) && (trim($_GET['message'])=='ok')){?>
							<div class="alert alert-success alert-block"> <a class="close" data-dismiss="alert" href="#">x</a>
              <h4 class="alert-heading">Succes!</h4>
              Modification effectuee avec succes !</div>
              <?php } ?>
              <?php if ((isset($_GET['message'])) && (trim($_GET['message'])!='ok')){?>
				 <div class="alert alert-error alert-block"> <a class="close" data-dismiss="alert" href="#">x</a>
              <h4 class="alert-heading">Error!</h4>
               <?php echo $_GET['message']; ?> </div>
              <?php } ?> 			
		<form class="form-horizontal" method="post" action="actionFournisseur.php" name="basic_validate" id="basic_validate" novalidate="novalidate">
                <label class="w3-text-blue"><b>Type</label>
                  <select name="type" id ="type" class="w3-select" onclick="disableText()">
                 <?php if ($type == "particulier") { echo '<option value="particulier" selected>Particulier</option>';} else {echo '<option value="particulier">Particulier</option>';}?>
                 <?php if ($type == "entreprise") { echo '<option value="entreprise" selected>Entreprise</option>';} else {echo '<option value="entreprise">Entreprise</option>';}?>
                  </select>
                <label class="w3-text-blue"><b>Numero</b></label>
                <input type="text" name="numero" class="w3-input w3-border" placeholder="Numero" value = "<?php echo $numero; ?>" disabled/>
                <label class="w3-text-blue"><b>Nom</b></label>
                <input type="text" name="nom" class="w3-input w3-border" placeholder="Nom" value = "<?php echo $nom; ?>"/>
                <label class="w3-text-blue"><b>Prenom</b></label>
                 <?php if ($type == "particulier") { echo ' <input type="text" name="prenom" id="prenom" class="w3-input w3-border" placeholder="Prenom"  value = "'.$prenom.'"/>';} else {echo ' <input type="text" name="prenom" id="prenom" class="w3-input w3-border" placeholder="Prenom" disabled/>';}?>
                <label class="w3-text-blue"><b>Email</b></label>
                <input type="text" name="email" class="w3-input w3-border" placeholder="Email"  value = "<?php echo $email; ?>"/>
                <label class="w3-text-blue"><b>Telephone</b></label>
                <input type="text" name="telephone" class="w3-input w3-border" placeholder="Telephone"  value = "<?php echo $telephone; ?>"/>
                <label class="w3-text-blue"><b>Adresse</b></label>
                <input type="text" name="adresse" class="w3-input w3-border" placeholder="Adresse"  value = "<?php echo $adresse; ?>"/>
                
                <input type="hidden" name="id" value = "<?php echo $id; ?>"/>
                <br/><br/>
                <input type="submit" class="w3-btn w3-blue" name="retour" value="Annuler" onclick="location.href='fournisseur.php'" >
                <input type="submit" class="w3-btn w3-blue" name="modifier" value="Valider">
                
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
            <script src="js/divers.js"></script>
	</body>

</html>

  
  
  <?php
}
else
{
	header('location: index.php');
   exit;	
}
	
?>
