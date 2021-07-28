<?php 
include('header.php');

$reponse = $bdd->query('SELECT * FROM marques');
?>

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"><a href="index.php" title="Retour" class="tip-bottom"><i class="icon-home"></i> Accueil</a> <a href="#" class="current">Marque</a> <a href="ajouter_marque.php" class="current"><i class="icon-plus"></i>Nouveau</a></div>
    <!--h1>Gestion des marques de vehicules</h1-->
  </div>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title">
             <span class="icon"><i class="icon-th"></i></span> 
             
          </div>
          <div class="widget-content nopadding"> 
          <!--a href="ajouter_marque.php"> <button class="btn btn-primary">Ajouter</button></a-->
           <?php if ((isset($_GET['message'])) && (trim($_GET['message'])=='ok')){?>
							<div class="alert alert-success alert-block"> <a class="close" data-dismiss="alert" href="#">x</a>
              <h4 class="alert-heading">Succes!</h4>
              Mise a jour effectue avec succes !</div>
              <?php } ?>
              
              <?php if ((isset($_GET['message'])) && (trim($_GET['message'])=='erreur')){?>
				 <div class="alert alert-error alert-block"> <a class="close" data-dismiss="alert" href="#">x</a>
              <h4 class="alert-heading">Error!</h4>
              Des modeles sont rataches a ce marque, suppression echouee!</div>
              <?php } ?>
            <table id="tablemarque" class="data-table table table-striped">
              <thead>
                <tr>
                   <th style="width:10%;">#</th>
                  <th>Libelle</th>
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
                 echo  '<td>'.$donnees['nom'].'</td>'; 
                 echo  '<td>';
                // echo '<a href="#"><i class="glyphicon glyphicon-search"></i></a>';
                 echo '<a href="gestion_marque.php?action=edit&id='.$donnees['IDMARQUE'].'"><i class="glyphicon glyphicon-edit"></i></a>';
                 if ((isset($_SESSION['profil'])) && ($_SESSION['profil'] == 1))
                { echo '<a href="gestion_marque.php?action=suppr&id='.$donnees['IDMARQUE'].'"><i class="glyphicon glyphicon-trash"></i></a>'; }
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
