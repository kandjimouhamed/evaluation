<?php 
include('header.php');


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

}


$reponse = $bdd->query('SELECT * FROM service ORDER BY NOM_SERVICE ASC');
$reponse1 = $bdd->query('SELECT * FROM filiale ORDER BY filialesigle ASC');
$reponse2 = $bdd->query('SELECT * FROM direction ORDER BY directionnom ASC');
?>

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.php" title="Retour" class="tip-bottom"><i class="icon-home"></i> Accueil</a> <a href="service.php" class="current">Service</a>  <a href="ajouter_service.php"><i class="icon-edit"></i>Nouveau</a> </div>
    <!--h1>Gestion des services</h1-->
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
                 //echo '<a href="#"><i class="icon icon-search"></i></a>';
                 echo '<a href="ajouter_service.php?action=edit&id='.$donnees['ID'].'"><i class="glyphicon glyphicon-edit"></i></a>';
                 echo '<a href="service.php?action=suppr&id='.$donnees['ID'].'" onclick="return(confirm(\'Etes-vous sur de vouloir supprimer cette entree?\'));"><i class="glyphicon glyphicon-trash"></i></a>';
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
