<?php 
include('header.php');

/*if (isset($_GET['id']))
{
    $id = trim($_GET['id']);
    
    if (trim($_GET['action']) == 'suppr')
    {
        $req = $bdd->prepare('SELECT count(dossiercode) FROM dossier WHERE IDUTILISATEUR = ?');
        $req->execute(array($id));
        $count = $req->fetchColumn();
        
        if ($count > 0)
        {
            header('location: intervenant.php?message=Suppression impossible, des OR sont lies a cet utilisateur');
            exit;
        }
        else
        {
            
            $req = $bdd->prepare('DELETE FROM intervenant WHERE codeintervenant = ?');
            $req->execute(array($id));
            
            header('location: intervenant.php?message=ok&message1=Suppression reussie');
            exit; 
        }
    }

}*/


$reponse = $bdd->query('SELECT * FROM intervenant ORDER BY nom ASC');
$reponse1 = $bdd->query('SELECT * FROM filiale ORDER BY filialesigle ASC');

?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.php" title="Retour" class="tip-bottom"><i class="icon-home"></i> Accueil</a> <a href="#" class="current">Intervenant</a>  <a href="ajouter_intervenant.php"><i class="icon-edit"></i>Nouveau</a> </div>
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
  <div class="container-fluid w3-white" style="font-size:12px;">
  
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title">
             <span class="icon"><i class="icon-th"></i></span> 
              <h5>Liste des intervenants</h5>
          </div>
          <div class="widget-content nopadding"> 
          </a>
           
            <table id="example" class="table display" style="width:100%;">
              <thead>
                <tr>
                  <th style="width:10%;">#</th>
                  <th>Filliale</th>
                  <th>Nom</th>
                  <th>Prenom</th>
                  <th>Poste</th>
                  <th>Email</th>
                  <th>Utilisateur</th>
                  <th style="width:7%;">Actions</th>
                </tr>
              </thead>
              <tbody>
              
              <?php 
               $i = 1;
               while ($donnees = $reponse->fetch())
               {  
                   $req = $bdd->prepare('SELECT filialenom  FROM filiale WHERE filialecode = ?');
                   $req->execute(array($donnees['filialecode']));
                   
                   $nomFiliale =  $req->fetchColumn();
                   
                   echo '<tr class="gradeA">';
                   echo  '<td>'.$i.'</td>';
                   echo  '<td>'.$nomFiliale.'</td>';
                   echo  '<td>'.$donnees['nom'].'</td>';
                   echo  '<td>'.$donnees['prenom'].'</td>';
                   echo  '<td>'.$donnees['poste'].'</td>';
                   echo  '<td>'.$donnees['email'].'</td>';
                   echo  '<td>'.$donnees['utilisateur'].'</td>';
                   echo  '<td>';
                  // echo '<a href="#"><i class="icon icon-search"></i></a>';
                   echo '<a href="ajouter_intervenant.php?action=edit&id='.$donnees['codeintervenant'].'"><i class="glyphicon glyphicon-edit"></i></a>';
                   echo '<a href="supprIntervenant.php?action=suppr&id='.$donnees['codeintervenant'].'" onclick="return(confirm(\'Etes-vous sur de vouloir supprimer cette entree?\'));"><i class="glyphicon glyphicon-trash"></i></a>';
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

<script src="js/jquery.dataTables.min.js"></script> 
<script src="js/maruti.js"></script> 
<script src="js/maruti.tables.js"></script>
<script src="js/jquery.validate.js"></script>
<script src="js/maruti.form_validation.js"></script>
<script src="js/ajax_xhr.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/autofill/2.3.5/js/dataTables.autoFill.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/3.3.1/js/dataTables.fixedColumns.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/fixedheader/3.1.7/js/dataTables.fixedHeader.js"></script>
<!--script type="text/javascript" src="jquery.dataTables.js"></script-->

<script>

$(document).ready(function() {
    var table = $('#example').DataTable( {
        scrollY:        "300px",
        scrollX:        true,
        scrollCollapse: true,
        paging:         true,
		"lengthChange": false,

	
		
		"oLanguage": {
                   "sProcessing": "Traitement en cours...",
                   "sSearch": "Rechercher&nbsp;:",
                   "sLengthMenu": "Afficher _MENU_ &eacute;l&eacute;ments",
                   "sInfo": "Affichage de l'&eacute;lement _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
                   "sInfoEmpty": "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
                   "sInfoFiltered": "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
                   "sInfoPostFix": "",
                   "sLoadingRecords": "Chargement en cours...",
                   "sZeroRecords": "Aucun &eacute;l&eacute;ment &agrave; afficher",
                   "sEmptyTable": "Aucune donn&eacute;e disponible dans le tableau",
                   "oPaginate": {
                       "sFirst": "Premier&nbsp;&nbsp;",
                       "sPrevious": "Pr&eacute;c&eacute;dent&nbsp;&nbsp;",
                       "sNext": "Suivant",
                       "sLast": "&nbsp;&nbsp;Dernier"
		}, },
		
	
    } );
	
		
} );
</script>

</body>
</html>
