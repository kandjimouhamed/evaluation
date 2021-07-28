<?php 
include('header.php');

/*if (isset($_POST['valider']))
{
    $id = $_POST['id'];
    $siglefiliale = $_POST['siglefiliale'];
    $nomfiliale = $_POST['nomfiliale'];
    $responsablefiliale = $_POST['responsblefiliale'];
    $adressefiliale = $_POST['adressefiliale'];
    $telephonefiliale = $_POST['telephonefiliale'];
    
    if ($id == -1)
    {
        $req = $bdd->prepare('SELECT count(filialecode)  FROM filiale WHERE filialesigle = ?');
        $req->execute(array($siglefiliale));
        $count = $req->fetchColumn();
        
        if ($count > 0)
        {
            header('location: ajouter_filiale.php?message='.$siglefiliale.' existe dans la base, veuillez choisiir un autre sigle.');
            exit;
        }
        
        $req = $bdd->prepare('SELECT count(filialecode)  FROM filiale WHERE filialenom = ?');
        $req->execute(array($nomfiliale));
        $count = $req->fetchColumn();
        
        if ($count > 0)
        {
            header('location: ajouter_filiale.php?message='.$nomfiliale.' existe dans la base, veuillez choisiir un autre nom.');
            exit;
        }
        
        $req = $bdd->prepare('INSERT INTO filiale(filialesigle, filialenom, filialeresponsable, filialeadresse, filialetel) VALUES(:sigle, :nom, :responsable, :adresse, :filialetel)');
        $req->execute(array(
            'sigle' => $siglefiliale,
            'nom' => $nomfiliale,
            'responsable' => $responsablefiliale,
            'adresse' => $adressefiliale,
            'filialetel' => $telephonefiliale
        ));
        
        $message =  'ok';
        
        
         header('location: ajouter_filiale.php?message='.$message.'&message1=Enregistrement effectuee avec succes');
        exit;
    }
    
    else 
    {
        $req = $bdd->prepare('SELECT count(filialecode)  FROM filiale WHERE filialesigle = ? AND filialecode!= ?');
        $req->execute(array($siglefiliale,$id));
        $count = $req->fetchColumn();
        
        if ($count > 0)
        {
            header('location: ajouter_filiale.php?message='.$siglefiliale.' existe dans la base, veuillez choisiir un autre sigle&action=edit&id='.$id);
            exit;
        }
        
        $req = $bdd->prepare('SELECT count(filialecode)  FROM filiale WHERE filialenom = ? AND filialecode!= ?');
        $req->execute(array($nomfiliale,$id));
        $count = $req->fetchColumn();
        
        if ($count > 0)
        {
            header('location: ajouter_filiale.php?message='.$nomfiliale.' existe dans la base, veuillez choisiir un autre nom&action=edit&id='.$id);
            exit;
        }
        
        $req = $bdd->prepare('UPDATE filiale SET filialesigle = :sigle, filialenom = :nom ,filialeresponsable = :responsable, filialeadresse = :adresse, filialetel = :telephone WHERE filialecode = :id');
        $req->execute(array(
            'sigle' => $siglefiliale,
            'nom' => $nomfiliale,
            'responsable' => $responsablefiliale,
            'adresse' => $adressefiliale,
            'telephone' => $telephonefiliale,
            'id' => $id
        ));
        
        header('location: filiale.php?message=ok&message1=Mise a jour effectuee avec succes');
        exit;
    }
    
}*/

if (isset($_GET['id']))
{
    $id = trim($_GET['id']);
    
if (trim($_GET['action']) == 'edit')
    {
     
        $req = $bdd->prepare('SELECT *  FROM filiale WHERE filialecode = ?');
        $req->execute(array($id));
        
        
        while ($donnees = $req->fetch())
        {
            $sigle = $donnees['filialesigle'];
            $nom = $donnees['filialenom'];
            $responsable =$donnees['filialeresponsable'];
            $adresse = $donnees['filialeadresse'];
            $telephone = $donnees['filialetel'];
           
            
        }
    }
    else 
    {
        $id = -1;
        $nom = "";
        $sigle="";
        $responsable="";
        $adresse="";
        $telephone="";
    }
}
else 
{
    $id = -1;
    $nom = "";
    $sigle="";
    $responsable="";
    $adresse="";
    $telephone="";
    
}

$reponse = $bdd->query('SELECT * FROM filiale ORDER BY filialesigle ASC');
?>

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.php" title="Retour" class="tip-bottom"><i class="icon-home"></i> Accueil</a> <a href="filiale.php">Filiale</a> <a href="#" class="current"><i class="icon-edit"></i>Saisie Filiale</a> </div>
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
            <span class="icon"><i class="icon-th"></i>Ajouter filiale</span>   
             
          </div>	
			<div class="w3-container w3-white">
              <div class="w3-row-padding">
			  <form class="form-horizontal" method="post" action="action_AjoutFiliale.php" name="basic_validate" id="basic_validate">
                                        <label>Sigle</label>
                                            <input type="text" class="w3-input w3-border" name="siglefiliale" id="siglefiliale" value = "<?php echo $sigle; ?>" required>
                                        <label>Nom</label>
                                            <input type="text" class="w3-input w3-border" name="nomfiliale" id="nomfiliale" value = "<?php echo $nom; ?>" required>
                                        <label>Responsable</label>
                                            <input type="text" class="w3-input w3-border" name="responsblefiliale" value = "<?php echo $responsable; ?>">
                                        <label>Adresse</label>
                                            <input type="text" class="w3-input w3-border" name="adressefiliale" value = "<?php echo $adresse; ?>">
                                        <label>Telephone</label>
                                            <input type="text" class="w3-input w3-border" name="telephonefiliale" value = "<?php echo $telephone; ?>">
                                            <input type="hidden" name="id" value = "<?php echo $id; ?>">
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
