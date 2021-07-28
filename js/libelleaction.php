<?php 
include('header.php');

if (isset($_POST['valider']))
{
    $id = $_POST['id'];
    $libelle = $_POST['libelle'];
    
    if ($id == -1)
    {
        $req = $bdd->prepare('SELECT count(ID)  FROM etat WHERE libelle = ?');
        $req->execute(array($libelle));
        $count = $req->fetchColumn();
        
        if ($count > 0)
        {
            header('location: etat.php?message='.$siglefiliale.' deja cree.');
            exit;
        }
        
        
        $req = $bdd->prepare('INSERT INTO etat(libelle) VALUES(:libelle)');
        $req->execute(array(
            'libelle' => $libelle
        ));
        
        $message =  'ok';
        
        
         header('location: etat.php?message='.$message.'&message1=Enregistrement effectuee avec succes');
        exit;
    }
    
    else 
    {
        $req = $bdd->prepare('SELECT count(ID)  FROM etat WHERE libelle = ? AND ID!= ?');
        $req->execute(array($libelle,$id));
        $count = $req->fetchColumn();
        
        if ($count > 0)
        {
            header('location: filiale.php?message='.$libelle.' existe dans la base, veuillez choisir un autre libelle&action=edit&id='.$id);
            exit;
        }
        
        $req = $bdd->prepare('UPDATE etat SET libelle = :libelle WHERE ID = :id');
        $req->execute(array(
            'libelle' => $libelle,
            'id' => $id
        ));
        
        header('location: etat.php?message=ok&message1=Mise a jour effectuee avec succes');
        exit;
    }
    
}

if (isset($_GET['id']))
{
    $id = trim($_GET['id']);
    
    if (trim($_GET['action']) == 'suppr')
    {
        $req = $bdd->prepare('SELECT count(*) FROM dossier WHERE idetat = ?');
        $req->execute(array($id));
        $count = $req->fetchColumn();
        
        if ($count > 0)
        {
            header('location: etat.php?message=Des objets sont ratachees a l\'etat selectionne, suppression immpossible');
            exit;
        }
        
        $req = $bdd->prepare('SELECT count(*) FROM actions WHERE idetat = ?');
        $req->execute(array($id));
        $count = $req->fetchColumn();
        
        if ($count > 0)
        {
            header('location: etat.php?message=Des objets sont ratachees a l\'etat selectionne, suppression immpossible');
            exit;
        }
        
            
            $req = $bdd->prepare('DELETE FROM etat WHERE ID = ?');
            $req->execute(array($id));
            header('location: etat.php?message=ok&message1=Suppression reussie');
            exit;
     
    }
    else if (trim($_GET['action']) == 'edit')
    {
     
        $req = $bdd->prepare('SELECT * FROM etat WHERE ID = ?');
        $req->execute(array($id));
        
        
        while ($donnees = $req->fetch())
        {
            $libelle = $donnees['libelle'];     
        }
    }
    else 
    {
        $id = -1;
        $libelle = "";
       
    }
}
else 
{
    $id = -1;
    $libelle = "";
    
    
}

$reponse = $bdd->query('SELECT * FROM libelleaction ORDER BY ID ASC');
?>

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.php" title="Retour" class="tip-bottom"><i class="icon-home"></i> Accueil</a> <a href="#" class="current">Libelle Action</a> <a href="ajouter_libelle.php"><i class="icon-edit"></i>Nouveau</a> </div>
    <!--h1>Gestion des etats dossiers/actions</h1-->
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
                  <th>Libelle</th>
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
                   echo  '<td>';
                   //echo '<a href="#"><i class="icon icon-search"></i></a>';
                  if ($donnees['ID'] != 1)
                  { echo '<a href="ajouter_etat.php?action=edit&id='.$donnees['ID'].'"><i class="glyphicon glyphicon-edit"></i></a>';
                   echo '<a href="etat.php?action=suppr&id='.$donnees['ID'].'" onclick="return(confirm(\'Etes-vous sur de vouloir supprimer cette entree?\'));"><i class="glyphicon glyphicon-trash"></i></a>';}
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
