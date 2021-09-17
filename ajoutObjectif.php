<?php 
include('header.php');

if (isset($_GET['id']))
{
    $idDiplom = trim($_GET['id']);
    
if (trim($_GET['action']) == 'edit')
    {
     
        $req = $bdd->prepare('SELECT *  FROM objectifs WHERE id = ?');
        $req->execute(array($id));
        
        
        while ($donnees = $req->fetch())
        {
            $idSalarie = $donnees['idSalarie'];
            $libelle = $donnees['libelle'];
            $date = $donnees['date'];
            
          
           
            
        }
    }
    else 
    {
        $id = -1;
        $idSalarie = "";
        $libelle = "";
        $date = "";
       
    }
}
else 
{
         $id = -1;
        $idSalarie = "";
        $libelle = "";
        $date = "";
       
}

$reponse = $bdd->query('SELECT * FROM objectifs ORDER BY libelle ASC');
$salarie = $bdd->query('SELECT * FROM salarie ORDER BY nom ASC');
?>

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.php" title="Retour" class="tip-bottom"><i class="icon-home"></i> Accueil</a> <a href="objectif.php">Objectifs</a> <a href="#" class="current"><i class="icon-edit"></i>Saisie Objectif</a> </div>
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
            <span class="icon"><i class="icon-th"></i>Ajouter Objectif</span>   
             
          </div>	
			<div class="w3-container w3-white">
        
              <div class="w3-row-padding">
                
			  <form class="form-horizontal" method="post" action="actionAjoutObjectif.php" name="basic_validate" id="basic_validate">
        <div class="row">
          <div class="col-md-3"></div>
          <div class="col-md-6">
          <label>Salarie</label>
                         <select name="idSalarie"  style="width:100%;" id="idSalarie" size="1" class="w3-select w3-border" size="1" required>										              <option>  </option>
                                    <?php 
                                     while ($donnees = $salarie->fetch())
                                     {
                                         if ($donnees['idSalarie'] == $idSalarie)
                                         {echo '<option value="'.$donnees['idSalarie'].'" selected>'.$donnees['prenom'].' '.$donnees['nom'].'</option>'; }
                                         else
                                         { echo '<option value="'.$donnees['idSalarie'].'">'.$donnees['prenom'].' '.$donnees['nom'].'</option>'; }
                                     }
                                     ?>
                                   </select>

                                    <label>Lebelle</label>
                                            <input type="text" class="w3-input w3-border" name="libelle" id="libelle" value = "<?php echo $libelle; ?>" required>
                                              <input type="hidden" name="id" value = "<?php echo $id; ?>">
                                        <br/><br/>
                                        <label>date</label>
                                            <input type="date" class="w3-input w3-border" name="date" id="date" value = "<?php echo $date; ?>" required>
                                              <input type="hidden" name="id" value = "<?php echo $id; ?>">
                                        <br/><br/>
										<a href="#" class="w3-bar-item w3-button w3-light-grey" style="width:49%;" onclick="location.href='filiale.php'" >Retour</a>
    <!--button name="" type="submit"  class="w3-bar-item w3-button w3-light-grey" style="width:49%;" name="retour" value="Retour" onclick="location.href='commandempr.php'" >Annuler</button-->
  <button name="valider" type="submit"  class="w3-bar-item w3-button w3-light-grey" style="width:50%;">Valider</button><br/><br/>
          </div>
        </div>                
       
										
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
