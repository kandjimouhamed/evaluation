<?php 
include('header.php');
$reponse = $bdd->query('SELECT * FROM marques, modeles WHERE modeles.IDMARQUE=marques.IDMARQUE ORDER BY modeles.libelle ASC');
?>

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.php" title="Retour" class="tip-bottom"><i class="icon-home"></i> Accueil</a> <a href="#">Modele</a><a href="ajouter_modele.php" class="current"><i class="icon-plus"></i>Nouveau</a> </div>
    <!--h1>Gestion des modeles de vehicules</h1-->
  </div>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title">
             <span class="icon"><i class="icon-th"></i></span> 
             
          </div>
          <div class="widget-content nopadding"> 
          <!--a href="ajouter_modele.php"> <button class="btn btn-primary">Ajouter</button></a-->
          <?php if ((isset($_GET['message'])) && (trim($_GET['message'])=='ok')){?>
							<div class="alert alert-success alert-block"> <a class="close" data-dismiss="alert" href="#">x</a>
              <h4 class="alert-heading">Succes!</h4>
              Mise a jour effectue avec succes !</div>
              <?php } ?>
              
              <?php if ((isset($_GET['message'])) && (trim($_GET['message'])=='erreur')){?>
				 <div class="alert alert-error alert-block"> <a class="close" data-dismiss="alert" href="#">x</a>
              <h4 class="alert-heading">Error!</h4>
              Des vehicules sont ratachés a ce modele, suppression echouee!</div>
              <?php } ?>
            <table id="tablemarque" class="data-table table table-striped">
              <thead>
                <tr>
                   <th style="width:10%;">#</th>
                  <th>Libelle</th>
                   <th>Marque</th>
                  <th style="width:7%;">Actions</th>
                </tr>
              </thead>
              <tbody>
              <?php 
               $i = 1;
               while ($donnees = $reponse->fetch())
               {  
                 echo '<tr class="gradeA">';
	             echo  '<td>'.$i.'</td>'; 
                 echo  '<td>'.$donnees['libelle'].'</td>'; 
                 echo  '<td>'.$donnees['nom'].'</td>'; 
                 echo  '<td>';
                 //echo '<a href="#"><i class="icon icon-search"></i></a>';
                 echo '<a href="gestion_modele.php?action=edit&id='.$donnees['IDMODELE'].'"><i class="glyphicon glyphicon-edit"></i></a>';
                 if ((isset($_SESSION['profil'])) && ($_SESSION['profil'] == 1))
               {  echo '<a href="gestion_modele.php?action=suppr&id='.$donnees['IDMODELE'].'"><i class="glyphicon glyphicon-trash"></i></a>'; }
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
