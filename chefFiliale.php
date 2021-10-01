<?php 
include('header.php');
$codeintervenant = $_SESSION['codeintervenant'];
$req = $bdd->prepare('SELECT * FROM salarie WHERE   idSalarie = ?');
$req->execute(array($codeintervenant));
$reponse = $bdd->query('SELECT * FROM salarie ORDER BY nom ASC');

$reqs = $bdd->prepare('SELECT filiale.filialenom FROM salarie INNER JOIN service  ON salarie.idservice = service.ID 
INNER JOIN filiale  ON service.idFiliale = filiale.filialecode  WHERE idSalarie = ?');
    $reqs->execute(array($codeintervenant));
    $nomFiliale =  $reqs->fetchColumn();

    $reqs = $bdd->prepare('SELECT * FROM salarie INNER JOIN service  ON salarie.idservice = service.ID 
         INNER JOIN filiale  ON service.idFiliale = filiale.filialecode LIKE "%'.$nomFiliale.'%"');
         $reqs->execute();
   

//$nomServices =  $req->fetchColumn();
     
?>

<div id="content">
  <div id="content-header">
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
  <div class="container-fluid w3-white" style="font-size:12px;">
  <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title">
             <span class="icon"><i class="icon-th"></i></span> 
            <h5>Liste des </h5>  
          </div>
          <div class="widget-content nopadding"> 
          </a>
           
            <table id="example" class="table display" style="width:100%;">
              <thead>
                <tr>
                   <th style="width:10%;">#</th>
                
                  <th>NOM</th>
                  <th>PRENOM</th>
                  <th>FONCTION</th>
                  <th>SERVICE</th>
                  <th>FILIALE</th>
            
                 
                  <th style="width:7%;">Actions</th>
                </tr>
              </thead>
              <tbody>
              <?php 
              echo $nomFiliale;
              $rep = $bdd->prepare('SELECT * FROM salarie INNER JOIN service  ON salarie.idservice = service.ID 
              INNER JOIN filiale  ON service.idFiliale = filiale.filialecode WHERE filialenom =?');
              $rep->execute(array($nomFiliale));
               $i = 1;
                        while ($reps = $rep->fetch())
                        { 

                                    echo '<tr class="gradeA">';
                                    echo  '<td>'.$i.'</td>'; 
                                    echo  '<td>'.$reps['prenom'].'</td>'; 
                                    echo  '<td>'.$reps['nom'].'</td>'; 
                                    echo  '<td>'.$reps['fonctionActuelle'].'</td>'; 
                                    echo  '<td>'.$reps['NOM_SERVICE'].'</td>'; 
                                    echo  '<td>'.$reps['filialenom'].'</td>'; 
                                
                                    echo  '<td>';
                                    //echo '<a href="#"><i class="icon icon-search"></i></a>';
                                    echo '<a href="notes.php?idSalarie='.$reps['idSalarie'].'"<i class="glyphicon glyphicon-edit"></i></a>';
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

