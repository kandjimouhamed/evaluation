<?php 
ini_set('display_errors', '1');
ini_set('error_reporting', E_ALL);
include('config/connexion.php');


if (isset($_POST['valider']))
{
    $id = $_POST['id'];
    $direction = $_POST['directionservice'];
    $nom = $_POST['nomservice'];
    $filiale = $_POST['filialeservice'];
    
    if ($id == -1)
    {
        $req = $bdd->prepare('SELECT count(ID)  FROM service WHERE NOM_SERVICE = ? AND directioncode = ?');
        $req->execute(array($nom, $direction));
        $count = $req->fetchColumn();
        
        if ($count > 0)
        {
            header('location: service.php?message=Le '.$nom.' est deja cree.');
            exit;
        }
        
        $req = $bdd->prepare('INSERT INTO service(NOM_SERVICE, directioncode) VALUES(:nom, :direction)');
        $req->execute(array(
            'nom' => $nom,
            'direction' => $direction
        ));
        
        $message =  'ok';
        
        
         header('location: service.php?message='.$message.'&message1=Enregistrement effectuee avec succes');
        exit;
    }
    
    else 
    {
        $req = $bdd->prepare('SELECT count(ID)  FROM service WHERE NOM_SERVICE = ? AND directioncode = ? AND ID != ?');
        $req->execute(array($nom,$direction,$id));
        $count = $req->fetchColumn();
        
        if ($count > 0)
        {
            header('location: service.php?message='.$nom.' est deja cree, veuillez choisiir un autre nom&action=edit&id='.$id);
            exit;
        }
        
       
        
        $req = $bdd->prepare('UPDATE service SET NOM_SERVICE = :nom, directioncode = :direction WHERE ID = :id');
        $req->execute(array(
            'nom' => $nom,
            'direction' => $direction,
            'id' => $id
        ));
        
        header('location: service.php?message=ok&message1=Mise a jour effectuee avec succes');
        exit;
    }
    
}

if (isset($_GET['id']))
{
    $id = trim($_GET['id']);
    
    if (trim($_GET['action']) == 'suppr')
    {
        $req = $bdd->prepare('SELECT count(ID) FROM etape WHERE IDSERVICE = ?');
        $req->execute(array($id));
        $count = $req->fetchColumn();
        
        if ($count > 0)
        {
            header('location: service.php?message=le service selectionnee intervient dans des circuits, suppression immpossible');
            exit;
        }
        else
        {
            
            $req = $bdd->prepare('DELETE FROM service WHERE ID = ?');
            $req->execute(array($id));
            
            header('location: service.php?message=ok&message1=Suppression reussie');
            exit;
        }
    }
    else if (trim($_GET['action']) == 'edit')
    {
     
        $req = $bdd->prepare('SELECT *  FROM service WHERE ID = ?');
        $req->execute(array($id));
        
        
        while ($donnees = $req->fetch())
        {
            $nom = $donnees['NOM_SERVICE'];
            $direction = $donnees['directioncode'];
            $req = $bdd->prepare('SELECT filialecode  FROM direction WHERE directioncode = ?');
            $req->execute(array($direction));
            $filiale = $req->fetchColumn();
           
        }
    }
    else 
    {
        $id = -1;
        $filiale = -1;
        $direction = -1;
        $nom = "";
    }
}
else 
{
    $id = -1;
    $filiale = -1;
    $direction = -1;
    $nom = "";
    
}

$reponse = $bdd->query('SELECT * FROM service ORDER BY NOM_SERVICE ASC');
$reponse1 = $bdd->query('SELECT * FROM filiale ORDER BY filialesigle ASC');
$reponse2 = $bdd->query('SELECT * FROM direction ORDER BY directionnom ASC');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<title>CCBM INDUSTRIES|GESTION DES ORDRES DE REPARATION</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="css/bootstrap.min.css" />
<link rel="stylesheet" href="css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="css/uniform.css" />
<link rel="stylesheet" href="css/select2.css" />
<link rel="stylesheet" href="css/maruti-style.css" />
<link rel="stylesheet" href="css/maruti-media.css" class="skin-color" />



</head>
<body>

<!--Header-part-->
<div id="header">
  <h1><a href="#">GESTION DES SERVICES</a></h1>
</div>
<!--close-Header-part--> 

<!--top-Header-messaages-->
<div class="btn-group rightzero"> <a class="top_message tip-left" title="Manage Files"><i class="icon-file"></i></a> <a class="top_message tip-bottom" title="Manage Users"><i class="icon-user"></i></a> <a class="top_message tip-bottom" title="Manage Comments"><i class="icon-comment"></i><span class="label label-important">5</span></a> <a class="top_message tip-bottom" title="Manage Orders"><i class="icon-shopping-cart"></i></a> </div>
<!--close-top-Header-messaages--> 

<!--top-Header-menu-->
<div id="user-nav" class="navbar navbar-inverse">
  <ul class="nav">
    <li class="" ><a title="" href="#"><i class="icon icon-user"></i> <span class="text">Profil</span></a></li>
    
    <li class=""><a title="" href="login.html"><i class="icon icon-share-alt"></i> <span class="text">Deconnexion</span></a></li>
  </ul>
</div>
<!-- >div id="search">
  <input type="text" placeholder="Search here..."/>
  <button type="submit" class="tip-left" title="Search"><i class="icon-search icon-white"></i></button>
</div-->
<!--close-top-Header-menu-->

<div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> Menu</a><ul>
    <li class="active"><a href="#"><i class="icon icon-home"></i> <span>Tableau de bord</span></a> </li>
    <li> <a href="dossier.php"><i class="icon icon-signal"></i> <span>Gestion OR</span></a> </li>
    <li> <a href="intervenants.php"><i class="icon icon-inbox"></i> <span>Intervenants</span></a> </li>
    <li><a href="commande_mpr.php"><i class="icon icon-th"></i> <span>Commandes MPR</span></a></li>
    <li class="submenu"> <a href="#"><i class="icon icon-cog"></i> <span>Gestion</span> </a>
      <ul>
        <li><a href="client.php">Clients</a></li>
        <li><a href="marque.php">Marques</a></li>
        <li><a href="modele.php">Modele de vehicule</a></li>
         <li><a href="vehicule.php">Vehicules</a></li>
        <li><a href="form-wizard.html">Gestion des circuits</a></li>
        
      </ul>
    </li>
    
    <li class="submenu"> <a href="#"><i class="icon icon-cog"></i> <span>Administration</span> </a>
      <ul>
        <li><a href="filiale.php">Filiale</a></li>
        <li><a href="direction.php">Direction</a></li>
        <li><a href="parc.php">Parc</a></li>
        <li><a href="service.php">Service</a></li>
         <li><a href="intervenant.php">Intervenants/Compte</a></li>
        
      </ul>
    </li>
   
  </ul>
</div>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Accueil</a> <a href="service.php" class="current">Service</a> </div>
    <h1>Gestion des services</h1>
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
					<div class="span6">
						<div class="widget-box">
							<div class="widget-title">
								<span class="icon">
									<i class="icon-info-sign"></i>									
								</span>
								<h5>Edition</h5>
							</div>
							<div class="widget-content nopadding">
								<form class="form-horizontal" method="post" action="service.php" name="basic_validate" id="basic_validate">
								<div class="control-group">
                                    <label class="control-label">Selectionner filiale</label>
                                    <div class="controls">
                                     <select name="filialeservice" id="filialeservice" onchange="getDirections(this.value);">
                                    <?php 
                                     while ($donnees = $reponse1->fetch())
                                     {
                                         if ($donnees['filialecode'] == $filiale)
                                         {echo '<option value="'.$donnees['filialecode'].'" selected>'.$donnees['filialesigle'].' ('.$donnees['filialenom'].') </option>'; }
                                         else
                                         { echo '<option value="'.$donnees['filialecode'].'">'.$donnees['filialesigle'].' ('.$donnees['filialenom'].') </option>'; }
                                     }
                                     ?>
                                   </select>
                                </div>
                            </div>
                            
                            <div class="control-group"  id="blocDirections">
                                    <label class="control-label">Selectionner direction</label>
                                    <div class="controls">
                                     <select name="directionservice">
                                    <?php 
                                     while ($donnees = $reponse2->fetch())
                                     {
                                         if ($donnees['directioncode'] == $direction)
                                         {echo '<option value="'.$donnees['directioncode'].'" selected>'.$donnees['directionnom'].'</option>'; }
                                         else
                                         {echo '<option value="'.$donnees['directioncode'].'">'.$donnees['directionnom'].'</option>'; }
                                     }
                                     ?>
                                   </select>
                                </div>
                            </div>
                                    
                                    <div class="control-group">
                                        <label class="control-label">Nom</label>
                                        <div class="controls">
                                            <input type="text" name="nomservice" id="nomservice" value = "<?php echo $nom; ?>" required style="width:86%">
                                            <input type="hidden" name="id" value = "<?php echo $id; ?>">
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="form-actions">
                                        <input type="submit" class="btn btn-success" name="valider" value="Valider">
                                        
                                     
                                    </div>
                                </form>
							</div>
						</div>			
					</div>
				</div>
				
				
			</div>
  
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title">
             <span class="icon"><i class="icon-th"></i></span> 
             
          </div>
          <div class="widget-content nopadding"> 
          </a>
           
            <table id="tablemarque" class="table table-bordered data-table">
              <thead>
                <tr>
                   <th style="width:10%;">#</th>
                  <th>Filliale</th>
                  <th>Direction</th>
                  <th>Nom</th>
                  <th style="width:7%;">Actions</th>
                </tr>
              </thead>
              <tbody>
              
              <?php 
               $i = 1;
               while ($donnees = $reponse->fetch())
               {  
                   $req = $bdd->prepare('SELECT directionnom  FROM direction WHERE directioncode = ?');
                   $req->execute(array($donnees['directioncode']));
                   $nomDirection =  $req->fetchColumn();
                   
                   $req = $bdd->prepare('SELECT filialecode  FROM direction WHERE directioncode = ?');
                   $req->execute(array($donnees['directioncode']));
                   $idFiliale = $req->fetchColumn();
                   
                   $req = $bdd->prepare('SELECT filialenom  FROM filiale WHERE filialecode = ?');
                   $req->execute(array($idFiliale));
                   
                   $nomFiliale =  $req->fetchColumn();
                   
                 echo '<tr class="gradeA">';
	             echo  '<td>'.$i.'</td>'; 
	             echo  '<td>'.$nomFiliale.'</td>'; 
	             echo  '<td>'.$nomDirection.'</td>';
                 echo  '<td>'.$donnees['NOM_SERVICE'].'</td>';
                 echo  '<td>';
                 echo '<a href="#"><img src="images/act_view.gif" border="0" height="16" width="16" style="margin-right: 4px;"></a>';
                 echo '<a href="service.php?action=edit&id='.$donnees['ID'].'"><img src="images/edit.png" border="0" height="16" width="16" style="margin-right: 4px;"></a>';
                 echo '<a href="service.php?action=suppr&id='.$donnees['ID'].'"><img src="images/edit_remove.gif" border="0" height="16" width="16" style="margin-right: 4px;"></a>';
                 echo '</td>'; 
                 echo '</tr>';
                $i++;
               }
               $reponse->closeCursor();
              ?>
                
              </tbody>
            </table>
          </div>
        </div>


      </div>
    </div>
  </div>
</div>
<div class="row-fluid">
  <div id="footer" class="span12"> 2019 &copy;  <a href="#">CCBM TECHNOLOGIES ET SOLUTIONS</a> </div>
</div>
<script src="js/jquery.min.js"></script> 
<script src="js/jquery.ui.custom.js"></script> 
<script src="js/bootstrap.min.js"></script> 
<script src="js/jquery.uniform.js"></script> 
<script src="js/select2.min.js"></script> 
<script src="js/jquery.dataTables.min.js"></script> 
<script src="js/maruti.js"></script> 
<script src="js/maruti.tables.js"></script>
<script src="js/maruti.form_validation.js"></script>
<script type="text/javascript" src="js/ajax_xhr.js" charset="iso_8859-1"></script>
</body>
</html>
