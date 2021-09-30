<?php 
include('header.php');


if (isset($_GET['idLangue']))
{
    $idLangue = trim($_GET['idLangue']);
    
if (trim($_GET['action']) == 'edit')
    {
     
        $req = $bdd->prepare('SELECT *  FROM langue WHERE idLangue = ?');
        $req->execute(array($idLangue));
        
        
        while ($donnees = $req->fetch())
        {
            
            $libelle = $donnees['libelle'];
          
           
            
        }
    }
    else 
    {
        $idLangue = -1;
        $libelle = "";
       
    }
}
else 
{
    $idLangue = -1;
        $libelle = "";
    
}

$reponse = $bdd->query('SELECT * FROM langue ORDER BY libelle ASC');
?>

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.php" title="Retour" class="tip-bottom"><i class="icon-home"></i> Accueil</a> <a href="langue.php">langues</a> <a href="#" class="current"><i class="icon-edit"></i>Saisie langue</a> </div>
    <!--h1>Gestion des filiales</h1-->
  </div>
  <?php if ((isset($_GET['message'])) && (trim($_GET['message'])=='ok')){?>
							<div class="alert alert-success alert-block"> <a class="close" data-dismiss="alert" href="#">X</a>
              <h4 class="alert-heading">Succes!</h4>
             <?php echo $_GET['message1']; ?> !</div>
              <?php } ?>
              <?php if ((isset($_GET['message'])) && (trim($_GET['message'])!='ok')){?>
				 <div class="alert alert-error alert-block"> <a class="close" data-dismiss="alert" href="#">x</a>
              <h4 class="alert-heading">Error!</h4>
              <?php echo $_GET['message']; ?></div> <?php } ?>
  <div class="container-fluid">
  
  <div class="row-fluid">
					<div class="span12">
					 <div class="widget-box">
          <div class="widget-title">
            <span class="icon"><i class="icon-th"></i>Ajouter langue</span>   
             
          </div>	
			<div class="w3-container w3-white">
              <div class="w3-row-padding">
			  <form class="form-horizontal" method="post" action="actionAjoutLangue.php" name="basic_validate" id="basic_validate">
                                        <label>Libelle</label>
                                            <input type="text" class="w3-input w3-border" name="libelle" id="libelle" value = "<?php echo $libelle; ?>" required>
                                              <input type="hidden" name="idLangue" value = "<?php echo $idLangue; ?>">
                                        <br/><br/>
										<a href="#" class="w3-bar-item w3-button w3-light-grey" style="width:49%;" onclick="location.href='filiale.php'" >Retour</a>
    <!--button name="" type="submit"  class="w3-bar-item w3-button w3-light-grey" style="width:49%;" name="retour" value="Retour" onclick="location.href='commandempr.php'" >Annuler</button-->
  <button name="valider" type="submit"  class="w3-bar-item w3-button w3-light-grey" style="width:50%;">Valider</button><br/><br/>
										
                                </form>
			  </div>
			</div>	
			  </div></div></div></div></div></div>			

  
    
<div class="row-fluid">
  <div id="footer" class="span12"> 2019 &copy;  <a href="#">CCBM TECHNOLOGIES ET SOLUTIONS</a> </div>
</div>
<script src="js/jquery.min.js"></script> 
<script src="js/jquery.ui.custom.js"></script> 
<script src="js/bootstrap.min.js"></script> 
<script src="js/jquery.uniform.js"></script> 
<!--script src="js/select2.min.js"></script--> 
<script src="js/jquery.dataTables.min.js"></script> 
<script src="js/maruti.js"></script> 
<script src="js/maruti.tables.js"></script>
<script src="js/maruti.form_validation.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
</body>
</html>
