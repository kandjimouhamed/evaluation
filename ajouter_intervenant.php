<?php 
include('header.php');




if (isset($_GET['id']))
{
    $id = trim($_GET['id']);
    
    if (trim($_GET['action']) == 'suppr')
    {
      /*  $req = $bdd->prepare('SELECT count(ID) FROM etape WHERE IDSERVICE = ?');
        $req->execute(array($id));
        $count = $req->fetchColumn();
        
        if ($count > 0)
        {
            header('location: service.php?message=le service selectionnee intervient dans des circuits, suppression immpossible');
            exit;
        }
        else
        {*/
            
            $req = $bdd->prepare('DELETE FROM intervenant WHERE codeintervenant = ?');
            $req->execute(array($id));
            
            header('location: intervenant.php?message=ok&message1=Suppression reussie');
            exit;
      //  }
    }
    else if (trim($_GET['action']) == 'edit')
    {
     
        $req = $bdd->prepare('SELECT *  FROM intervenant WHERE codeintervenant = ?');
        $req->execute(array($id));
        
        
        while ($donnees = $req->fetch())
        {
            $nom = $donnees['nom'];
            $prenom = $donnees['prenom'];
            $poste = $donnees['poste'];
            $email = $donnees['email'];
            $utilisateur = $donnees['utilisateur'];
            $filiale = $donnees['filialecode'];
            
        }
    }
    else 
    {
        $id = -1;
        $filiale = -1;
        $nom = "";
        $prenom = "";
        $poste = "";
        $email = "";
        $utilisateur = "";
        $pwd = "";
    }
}
else 
{
    $id = -1;
    $filiale = -1;
    $nom = "";
    $prenom = "";
    $poste = "";
    $email = "";
    $utilisateur = "";
    $pwd = "";
    
    
}

$reponse = $bdd->query('SELECT * FROM intervenant ORDER BY nom ASC');
$reponse1 = $bdd->query('SELECT * FROM filiale ORDER BY filialesigle ASC');

?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.php" title="Retour" class="tip-bottom"><i class="icon-home"></i> Accueil</a> <a href="intervenant.php">Intervenant</a>  <a href="ajouter_intervenant.php"><i class="icon-edit" class="current"></i>Saisie intervenant</a> </div>
    <!--h1>Gestion des intervenants</h1-->
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
            <span class="icon"><i class="icon-th"></i>Ajouter intervenant</span>   
             
          </div>		
						<div class="w3-container w3-white">
						<div class="w3-row-padding">
						<div class="w3-half">
						<form class="form-horizontal" method="post" action="actionAjouterIntervenant.php" name="password_validate" id="password_validate" novalidate="novalidate">
                                    <label>Filiale</label>
                                     <select name="filiale" id="filiale" class="w3-select" required>
										 <option>  </option>
                                    <?php 
                                     while ($donnees = $reponse1->fetch())
                                     {
                                         if ($donnees['filialecode'] == $filiale)
                                         {echo '<option value="'.$donnees['filialecode'].'" selected>'.$donnees['filialenom'].' </option>'; }
                                         else
                                         { echo '<option value="'.$donnees['filialecode'].'">'.$donnees['filialenom'].'</option>'; }
                                     }
                                     ?>
                                   </select>
                                        <label>Nom</label>
                                            <input type="text" class="w3-input w3-border" name="nom" id="nom" value = "<?php echo $nom; ?>" style="width:100%;height:28px;">
                                        <label>Prenom</label>
                                            <input type="text" class="w3-input w3-border" name="prenom" id="prenom" value = "<?php echo $prenom; ?>" style="width:100%;height:28px;">
                                        <label>Poste</label>
                                            <input type="text" class="w3-input w3-border" name="poste" id="poste" value = "<?php echo $poste; ?>" style="width:100%;height:28px;">
								</div>
								<div class="w3-half">
                                        <label>Email</label>
                                            <input type="text" class="w3-input w3-border" name="email" id="email" value = "<?php echo $email; ?>" style="width:100%;height:28px;">
                                        <label>Utilisateur</label>																																		
                                            <input type="text" class="w3-input w3-border" name="utilisateur" id="utilisateur" value = "<?php echo $utilisateur; ?>" style="width:100%;height:28px;">
											<label>Password</label>
												<input type="password" class="w3-input w3-border" name="pwd" id="pwd" style="width:100%;height:28px;"/>
											<label>Confirmer password</label>
												<input type="password" class="w3-input w3-border" name="pwd2" id="pwd2" style="width:100%;height:28px;"/>
									</div>
											<input type="hidden" name="id" value = "<?php echo $id; ?>" style="width:100%;height:28px;">
											<label>Profil</label>
                                     <select name="profil" id="profil" class="w3-select w3-border" required style="width:100%;height:28px;">
										 <option value="2">Utilisateur</option>
										 <option value="1">Administrateur</option>
										 <option value="3">Mamageur</option>
                                   </select>
											<br/><br/> 
											
											
											<a href="#" class="w3-bar-item w3-button w3-light-grey" style="width:49%;" onclick="location.href='intervenant.php'" >Retour</a>
                                       <button name="valider" type="submit"  class="w3-bar-item w3-button w3-light-grey" style="width:50%;">Valider</button><br/><br/>
									</form>	  
						</div>
						</div></div>	
			  </div></div></div>	</div>
			  
						
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
<script src="js/jquery.validate.js"></script>
<script src="js/maruti.form_validation.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>  

</body>
</html>
