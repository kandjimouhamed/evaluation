<?php
include('header.php');


if (isset($_GET['action']))
{
	$id = $_GET['id'];	
	    
	    $req = $bdd->prepare('SELECT * FROM piece WHERE IDPIECE = ?');
	    $req->execute(array($id));
	    
	    
	    while ($donnees = $req->fetch())
	    {
	        $idmarque = $donnees['IDMARQUE'];
	        $reference = $donnees['reference'];
	        $designation =$donnees['designation'];
	        
	    }
	    
	    
	    $reponse = $bdd->query('SELECT * FROM marques ORDER BY nom ASC');	   
	
	 ?>

		<div id="content">
			<div id="content-header">
				<div id="breadcrumb">
				<a href="index.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Accueil</a>
				<a href="piece.php">Piece</a>
				<a href="#" class="current"><i class="icon-edit"></i>Modifier piece</a>
				</div>
                <!--h1>Modifier vehicule</h1-->
			</div>
			
			<div class="container-fluid">
				<div class="row-fluid">
					<div class="span12">
						
				<div class="w3-container w3-white"><div class="w3-cell-row"><div class="w3-container w3-grey w3-cell">
			     <h6>Modification Piece</h6>
              <div style="border-radius: 5px;background-color: #f2f2f2;padding: 20px;">
			  <form class="form-horizontal" method="post" action="actionPiece.php">
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
                   
               
                <label class="w3-text-blue"><b>Reference</b></label>
                <input type="text" name="reference" id="reference" class="w3-input w3-border" placeholder="Reference" value = "<?php echo $reference; ?>"/ required>
               <label class="w3-text-blue"><b>Designation</b></label>
               <input type="text" name="designation" id="designation" class="w3-input w3-border" placeholder="Designation" value = "<?php echo $designation; ?>"/ required>
               <input type="hidden" name="idPiece" value = "<?php echo $id; ?>"/>
               
               <br/><br/>
               <input type="submit" class="w3-btn w3-blue" name="retour" value="Annuler" onclick="location.href='piece.php'" >
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
             <script type="text/javascript" src="js/modele_xhr.js" charset="iso_8859-1"></script>
           <script src="js/divers.js"></script>
	</body>

</html>

  
  
  <?php
}
else
{
	header('location: piece.php');
   exit;	
}
	
?>
