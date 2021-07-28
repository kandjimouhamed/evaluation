<?php 
include('header.php');	
$reponse = $bdd->query('SELECT * FROM fournisseurs ORDER BY nom ASC');
?>

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.php" title="Retour" class="tip-bottom"><i class="icon-home"></i> Accueil</a> <a href="#" class="current"><i class="icon-user"></i>Fournisseur</a> <a href="ajouter_fournisseur.php" class="current"><i class="icon-plus"></i>Nouveau</a></div>
    <!--h1>Gestion clients</h1-->
  </div>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title">
             <span class="icon"><i class="icon-th"></i>Liste des fournisseurs</span> 
             
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
                  <th>Type</th>
                  <th style="width:15%;">Numero</th>
                   <th style="width:30%;">Nom</th>
                   <th style="width:15%;">Email</th>
                   <th style="width:20%;">Adresse</th>
                   <!--th style="width:15%;">Contact</th>
                   <th style="width:15%;">Tel contact</th-->
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
                 echo  '<td>'.$donnees['type'].'</td>';
                 echo  '<td>'.$donnees['numero'].'</td>'; 
                 echo  '<td>'.$donnees['nom'].' '.$donnees['prenom'].'</td>'; 
                 echo  '<td>'.$donnees['email'].'</td>'; 
                 echo  '<td>'.$donnees['adresse'].'</td>'; 
                /* echo  '<td>'.$donnees['personneacontacter'].'</td>'; 
                 echo  '<td>'.$donnees['telephonepersacontacter'].'</td>'; */
                 echo  '<td>';
                 //echo '<a href="#"><i class="glyphicon glyphicon-search"></i></a>';
                 echo '<a href="gestion_fournisseur.php?action=edit&id='.$donnees['ID'].'"><i class="glyphicon glyphicon-edit"></i></a>';
                 echo '<a href="supprFournisseur.php?action=suppr&id='.$donnees['ID'].'" onclick="return(confirm(\'Etes-vous sur de vouloir supprimer cette entree?\'));"><i class="glyphicon glyphicon-trash"></i></a>';
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
