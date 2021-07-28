<?php
include('header.php');
if (isset($_GET['action']))
{
	$id = $_GET['id'];	
	
	$req = $bdd->prepare('SELECT nom  FROM marques WHERE IDMARQUE = ?');
	$req->execute(array($id));
	$libelle = $req->fetchColumn();
	
	if (trim($_GET['action'])=='suppr')
	{
    $req = $bdd->prepare('SELECT count(*)  FROM modeles WHERE IDMARQUE = ?');
    $req->execute(array($id));
    $count = $req->fetchColumn();
    
   if ($count > 0)
   {
	header('location: marque.php?message=erreur');
   exit; 
  }
  else
  { 
   $req = $bdd->prepare('DELETE FROM marques WHERE IDMARQUE = ?');
   $req->execute(array($id));
	header('location: marque.php?message=ok');
   exit;
  }
}
else
{
  ?>

		<div id="content">
			<div id="content-header">
				<div id="breadcrumb">
				<a href="index.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Accueil</a>
				<a href="marque.php">Marque</a>
				<a href="#" class="current"><i class="icon-edit"></i>Saisie Marque</a>
				</div>
                <h1>Edition</h1>
			</div>
			
			<div class="container-fluid">
				<div class="row-fluid">
					<div class="span12">
						
						<div class="w3-container w3-white"><div class="w3-cell-row"><div class="w3-container w3-grey w3-cell">
			     <h3>Saisie Marque</h3>
              <div style="border-radius: 5px;background-color: #f2f2f2;padding: 20px;">
				  <?php if ((isset($_GET['message'])) && (trim($_GET['message'])=='ok')){?>
							<div class="alert alert-success alert-block"> <a class="close" data-dismiss="alert" href="#">x</a>
              <h4 class="alert-heading">Succes!</h4>
              Enregistrement effectue avec succes !</div>
              <?php } ?>
              <?php if ((isset($_GET['message'])) && (trim($_GET['message'])=='erreur')){?>
				 <div class="alert alert-error alert-block"> <a class="close" data-dismiss="alert" href="#">x</a>
              <h4 class="alert-heading">Error!</h4>
              La marque de vehicule <?php echo $_GET['libelle']; ?> est deja creee</div>
              <?php } ?>
			 <form class="form-horizontal" method="post" action="actionMarque.php" name="basic_validate" id="basic_validate" novalidate="novalidate">
                                        <label class="w3-text-blue"><b>Libelle</b></label>
                                            <input type="text" class="w3-input w3-border"  name="libelle" id="required" value="<?php echo $libelle; ?>">
                                            <input type="hidden" name="id"  value=<?php echo $id; ?>>
                                            <br/><br/><input type="submit" class="w3-btn w3-blue" name="valider" value="Valider">
                                            <input type="submit" class="w3-btn w3-blue" name="Annuler" value="Annuler" onclick="location.href='marque.php'" >
                                        
                                     
                                    </div>
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
