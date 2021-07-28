<?php 
include('header.php');
/*if ($_SESSION['profil'] == 1)
{$reponse = $bdd->query('SELECT * FROM vehicules, clientvehicule WHERE clientvehicule.IDVEHICULE = vehicules.IDVEHICULE ORDER BY immatriculation ASC');}
else
{$reponse = $bdd->query('SELECT * FROM vehicules, clientvehicule WHERE clientvehicule.IDVEHICULE = vehicules.IDVEHICULE AND vehicules.filialecode = '.$_SESSION['filialecode'].' ORDER BY immatriculation ASC');}*/

/*if ($_SESSION['profil'] == 1)
{$reponse = $bdd->query('SELECT * FROM vehicules ORDER BY immatriculation ASC');}
else
{$reponse = $bdd->query('SELECT * FROM vehicules WHERE filialecode = '.$_SESSION['filialecode'].' ORDER BY immatriculation ASC');}*/

$reponse = $bdd->query('SELECT * FROM vehicules ORDER BY immatriculation ASC');


//$reponse->debugDumpParams();
?>

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.php" title="Retour" class="tip-bottom"><i class="icon-home"></i> Accueil</a> <a href="#" class="current">Vehicule</a> <a href="ajouter_vehicule.php" class="current"><i class="icon-plus"></i>Nouveau</a></div>
    <!--h1>Gestion clients</h1-->
  </div>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title">
             <span class="icon"><i class="icon-th"></i></span> 
             
          </div>
          <div class="widget-content nopadding"> 
          <!--a href="ajouter_client.php"> <button class="btn btn-primary">Ajouter</button></a-->
          <?php if ((isset($_GET['message'])) && (trim($_GET['message'])=='ok')){?>
							<div class="alert alert-success alert-block"> <a class="close" data-dismiss="alert" href="#">x</a>
              <h4 class="alert-heading">Succes!</h4>
              Mise a jour effectue avec succes !</div>
              <?php } ?>
              
              <?php if ((isset($_GET['message'])) && (trim($_GET['message'])=='erreur')){?>
				 <div class="alert alert-error alert-block"> <a class="close" data-dismiss="alert" href="#">x</a>
              <h4 class="alert-heading">Error!</h4>
              Des vehicules sont rataches a ce client, suppression echouee!</div>
              <?php } ?>
            <table id="tablemarque" class="table table-bordered data-table table-striped">
              <thead>
                <tr>
                   <th style="width:5%;">#</th>
                  <th style="">Marque/Modele</th>
                   <th style="">Immatriculation</th>
                   <th style="">Chassis</th>
                   <th style="">Numero Moteur</th>
                   <th style="">Numero BC</th>
                   <th style="">DMC</th>
                   <th style="">Client</th>
                  <th style="width:5%;">Actions</th>
                </tr>
              </thead>
              <tbody>
               <?php 
               $i = 1;
               while ($donnees = $reponse->fetch())
             {  
                echo '<tr class="gradeA">';
	             echo  '<td>'.$i.'</td>'; 
                 echo  '<td>'.getMarque($donnees['IDMODELE'],$bdd).'/'.getModele($donnees['IDMODELE'],$bdd).'</td>';
                 echo  '<td>'.$donnees['immatriculation'].'</td>'; 
                 echo  '<td>'.$donnees['numchassis'].'</td>'; 
                 echo  '<td>'.$donnees['nummoteur'].'</td>'; 
                 echo  '<td>'.$donnees['numbc'].'</td>'; 
                 echo  '<td>'.$donnees['dmc'].'</td>'; 
                 echo  '<td>'.getClient($donnees['IDCLIENT'],$bdd).'</td>'; 
                 echo  '<td>';
                 //echo '<a href="#"><i class="glyphicon glyphicon-search"></i></a>';
                 echo '<a href="gestion_vehicule.php?action=edit&id='.$donnees['IDVEHICULE'].'"><i class="glyphicon glyphicon-edit"></i></a>';
                 if ((isset($_SESSION['profil'])) && ($_SESSION['profil'] == 1))
                 { echo '<a href="gestion_vehicule.php?action=suppr&id='.$donnees['IDVEHICULE'].'" onclick="return(confirm(\'Etes-vous sur de vouloir supprimer cette entree?\'));"><i class="glyphicon glyphicon-trash"></i></a>'; }
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
</body>
</html>
