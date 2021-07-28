<?php 
include('header.php');

if (isset($_POST['valider']))
{
    $libelle = $_POST['libelle'];
    $intervenant = $_POST['intervenant'];
    $service = $_POST['service'];
    $idcircuit = $_POST['circuit'];
    
    
    $req = $bdd->prepare('SELECT count(ID)  FROM etape WHERE libelle = ? AND IDCIRCUIT = ?');
    $req->execute(array($libelle,$idcircuit));
    $count = $req->fetchColumn();
    
    if ($count > 0)
    {
        header('location: singleEtape.php?message='.$libelle.' existe dans la circuit , veuillez choisir un autre nom&circuit='.$idcircuit);
        exit;
    }
 
    $dernierPosition = getDernierEtape($idcircuit,$bdd);
    $req = $bdd->prepare('INSERT INTO etape(libelle, position, IDSERVICE, IDCIRCUIT, IDINTERVENANT) VALUES(:libelle, :position, :service, :circuit, :intervenant)');
    $req->execute(array(
            'libelle' => $libelle,
            'position' => $dernierPosition +1,
            'service' => $service,
            'circuit' => $idcircuit,
            'intervenant' => $intervenant
        ));
    
    header('location: ajouter_etape_action.php?message=ok&message1=Mise a jour effectuee avec succes&circuit='.$idcircuit);
    exit;
}

if (isset($_GET['circuit']))
{
    $idcircuit = trim($_GET['circuit']);
    
    $req = $bdd->prepare('SELECT *  FROM circuit WHERE ID = ?');
    $req->execute(array($idcircuit));
    
    
    while ($donnees = $req->fetch())
    {
        $nomcircuit = $donnees['NOM_CIRCUIT'];
        $direction = $donnees['directioncode'];
    }
    
    $nomFiliale = getFiliale($direction,$bdd);
    $nomDirection = getDirection($direction,$bdd);
}
else 
{
    header('location: circuit.php');
    exit;
}


$req = $bdd->prepare('SELECT *  FROM intervenant');
$req->execute();

$req1 = $bdd->prepare('SELECT *  FROM service WHERE directioncode = ?');
$req1->execute(array($direction));

?>

		<div id="content">
			<div id="content-header">
				<div id="breadcrumb">
				<a href="index.php" title="Retour" class="tip-bottom"><i class="icon-home"></i> Accueil</a>
				<a href="circuit.php">Circuit</a>
				<a href="ajouter_etape_action.php?circuit=<?php echo $idcircuit; ?>"><?php echo $nomcircuit; ?></a>
				<a href="#" class="current"><i class="icon-edit"></i>Nouveau</a>
				</div>
			</div>
	        
			<div class="container-fluid">
				<div class="row-fluid">
											
			<div class="widget-box">
		<div class="span12">
		<div class="w3-container w3-white">
		<ul class="w3-ul w3-small">
                <li><b>Filiale: </b><?php echo $nomFiliale; ?></li>
                <li><b>Direction: </b><?php echo $nomDirection; ?></li>
                <li><b>Circuit: </b><?php echo $nomcircuit; ?></li>
                
                </ul>		
		<div class="w3-cell-row"><div class="w3-container w3-grey w3-cell">
	    <h6>Nouvelle Etape</h6>
        <div style="border-radius: 5px;background-color: #f2f2f2;padding: 20px;">	
			<?php if ((isset($_GET['message'])) && (trim($_GET['message'])=='ok')){?>
							<div class="alert alert-success alert-block"> <a class="close" data-dismiss="alert" href="#">X</a>
              <h4 class="alert-heading">Succes!</h4>
             <?php echo $_GET['message1']; ?> !</div>
              <?php } ?>
              <?php if ((isset($_GET['message'])) && (trim($_GET['message'])!='ok')){?>
				 <div class="alert alert-error alert-block"> <a class="close" data-dismiss="alert" href="#">x</a>
              <h4 class="alert-heading">Error!</h4>
              <?php echo $_GET['message']; ?></div> <?php } ?>
		<form action="" method="post" class="form-horizontal">
                <label class="w3-text-blue"><b>Libelle </b></label>
                  <input type="text" class="w3-input w3-border" name="libelle" placeholder="Lielle" value=""/ required>
                <label class="w3-text-blue"><b>Intervenant </b></label>
                  <select name="intervenant" class="w3-select" required>
					   <option></option>
                                    <?php 
                                    while ($donnees = $req->fetch())
                                    {
                                        echo '<option value="'.$donnees['codeintervenant'].'">'.$donnees['utilisateur'].'</option>';
                                    }
                                     ?>
                  </select>
                <label class="w3-text-blue"><b>Service </b></label>
               
                  <select name="service" class="w3-select" required>
					   <option></option>
                                    <?php 
                                    while ($donnees = $req1->fetch())
                                    {
                                        echo '<option value="'.$donnees['ID'].'">'.$donnees['NOM_SERVICE'].'</option>';
                                    }
                                     ?>
                                   </select>
              <input type="hidden" name="circuit" value = "<?php echo $idcircuit; ?>">
              <br/><br/>
                 <input type="submit" class="w3-btn w3-blue" name="Annuler" value="Annuler" onclick="location.href='ajouter_etape_action.php?circuit=<?php echo $idcircuit; ?>'" >
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
            <script type="text/javascript" src="js/ajax_xhr.js" charset="iso_8859-1"></script>	 
            
            
	</body>

</html>
