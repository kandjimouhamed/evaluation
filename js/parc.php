<?php 
include('header.php');
if (isset($_GET['id']))
{
    $id = trim($_GET['id']);
    
    if (trim($_GET['action']) == 'suppr')
    {
        $req = $bdd->prepare('SELECT count(*) FROM parcvehicule WHERE IDPARC = ? AND sortie is null');
        $req->execute(array($id));
        $count = $req->fetchColumn();
        
        if ($count > 0)
        {
            header('location: parc.php?message=Des vehicules sont ratachees au parc selectionnee, suppression immpossible');
            exit;
        }
        else
        {
            
            $req = $bdd->prepare('DELETE FROM parcautomobiles WHERE IDPARCS = ?');
            $req->execute(array($id));
            $req = $bdd->prepare('DELETE FROM parcvehicule WHERE IDPARC = ? AND sortie is not null');
            $req->execute(array($id));
            header('location: parc.php?message=ok&message1=Suppression reussie');
            exit;
        }
    }
    else if (trim($_GET['action']) == 'edit')
    {
     
        $req = $bdd->prepare('SELECT *  FROM parcautomobiles WHERE IDPARCS = ?');
        $req->execute(array($id));
        
        
        while ($donnees = $req->fetch())
        {
            $nom = $donnees['nom'];
            $adresse = $donnees['adresse'];
            $telephone =$donnees['telephone'];
            $superviseur =$donnees['superviseur'];
            $direction =$donnees['directioncode'];
            
            $req = $bdd->prepare('SELECT filialecode  FROM direction WHERE directioncode = ?');
            $req->execute(array($donnees['directioncode']));
            $filiale = $req->fetchColumn();
           
        }
    }
    else 
    {
        $id = -1;
        $direction = "";
        $nom = "";
        $adresse = "";
        $telephone = "";
        $superviseur = "";
        $filiale = -1;

    }
}
else 
{
    $id = -1;
    $direction = "";
    $nom = "";
    $adresse = "";
    $telephone = "";
    $superviseur = "";
    $filiale = -1;
    
}

$reponse = $bdd->query('SELECT * FROM parcautomobiles ORDER BY nom ASC');
$reponse1 = $bdd->query('SELECT * FROM filiale ORDER BY filialesigle ASC');
$reponse2 = $bdd->query('SELECT * FROM direction ORDER BY directionnom ASC');
?>

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Accueil</a> <a href="parc.php" class="current">Parc</a> <a href="ajouter_parc.php"><i class="icon-edit"></i>Nouveau</a> </div>
    <!--h1>Gestion des localisation</h1-->
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
             <span class="icon"><i class="icon-th"></i></span> 
             
          </div>
          <div class="widget-content nopadding"> 
          </a>
           
            <table id="tablemarque" class="data-table table table-striped">
              <thead>
                <tr>
                  <th style="width:10%;">#</th>
                  <th>Filiale</th>
                  <th>Direction</th>
                  <th>Nom</th>
                  <th>Adresse</th>
                  <th>Telephone</th>
                  <th>Superviseur</th>
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
                 echo  '<td>'.$donnees['nom'].'</td>'; 
                 echo  '<td>'.$donnees['adresse'].'</td>';
                 echo  '<td>'.$donnees['telephone'].'</td>';
                 echo  '<td>'.$donnees['superviseur'].'</td>';       
                 echo  '<td>';
                 //echo '<a href="#"><i class="icon icon-search"></i></a>';
                 echo '<a href="parc.php?action=edit&id='.$donnees['IDPARCS'].'"><i class="glyphicon glyphicon-edit"></i></a>';
                 echo '<a href="parc.php?action=suppr&id='.$donnees['IDPARCS'].'" onclick="return(confirm(\'Etes-vous sur de vouloir supprimer cette entree?\'));"><i class="glyphicon glyphicon-trash"></i></a>';
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
</body>
</html>
