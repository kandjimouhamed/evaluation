<?php
include('header.php');
$reponse = $bdd->query('SELECT * FROM salarie ORDER BY idSalarie ASC');
if (isset($_GET['inpute'])   AND !empty($_GET['inpute'])) {
  $search= htmlspecialchars(($_GET['inpute']));
  $searche = $bdd->query('SELECT * FROM salarie WHERE nom LIKE "%'.$search.'%" ');
  $rowcount = $searche->rowCount();

}
?>


<div id="content">
  
  <div id="content-header">
    
    <div id="breadcrumb"> <a href="index.php" title="Retour" class="tip-bottom"><i class="icon-home"></i> Accueil</a> <a href="#" class="current">Salaries</a> <a href="ajoutSalarie.php"><i class="icon-edit"></i>Nouveau</a> </div>
    <!--h1>Gestion des filiales</h1-->
  </div>
  <div>
    
        <form class="form-group" method="get">
         <div class="row">
         <div class="col-3 col-sm-3 col-md-2"></div>
         <div class="col-6 col-sm-6 col-md-4"> <Input Class="form-control" name="inpute" id="search" Placeholder="Recherche"></div>
         <div class="col-3 col-sm-3 col-md-2"> <button class="btn btn-primary form-control" type="submit" name="search" autocomplete="off">Search</button></div>
         </div>
        </form>
  <?php if ((isset($_GET['message'])) && (trim($_GET['message'])=='ok')){?>
							<div class="alert alert-success alert-block"> <a class="close" data-dismiss="alert" href="#">X</a>
              <h4 class="alert-heading">Succes!</h4>
             <?php echo $_GET['message1']; ?> !</div>
              <?php } ?>
              <?php if ((isset($_GET['message'])) && (trim($_GET['message'])!='ok')){?>
				 <div class="alert alert-error alert-block"> <a class="close" data-dismiss="alert" href="#">x</a>
              <h4 class="alert-heading">Error!</h4>
              <?php echo $_GET['message']; ?></div> <?php } ?>
              <div class="w3-row w3-border">
             <div class="w3-col s12" style='overflow-x:scroll;'>
			
			 <table id="" class="table table-bordered">
			  <caption style="caption-side:top;text-align:center;">synthese</caption>
    <tr>
	    <th>Prenom et Nom</th>
	    
		<?php 
		 
          $req = $bdd->prepare('SELECT * FROM coefs');
          $req->execute(array());
          while ($reqs = $req->fetch())
          {
           echo  '<th>'.$reqs['libelle'].' </th>';
         }
		echo '<th>Total</th>';
		
		while ($donnees = $reponse->fetch())
        {
         echo '<tr>';
       echo '<td>'.$donnees['nom'].'</td>';
		 $req1 = $bdd->prepare('SELECT * FROM evaluer WHERE idSalarie =? ');
          $req1->execute(array($donnees['idSalarie']));
          while ($req1s = $req1->fetch())
          {
           echo  '<td>'.$req1s['note'].' </td>';        
	    }
		 //echo '<td style="text-align:right;font-weight: bold;">'.$total.'</td>';
         echo '</tr>';
         //$total2 = $total2 +$total;		 
        }
		?>              
    </table>
	 <?php
   	while ($donnees = $reponse->fetch())
     {
    $req1 = $bdd->prepare('SELECT * FROM evaluer WHERE idSalarie =? ');
    $req1->execute(array($donnees['idSalarie']));
    while ($req1s = $req1->fetch())
    {
      
 
     echo $req1s['note'];        
}
}
   ?>
			 </div>
             </div> 
  <div class="container-fluid w3-white" style="font-size:12px;">
 <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title">
             <span class="icon"><i class="icon-th"></i></span> 
            <h5>Liste des Diploms</h5>  
          </div>
          <div class="widget-content nopadding"> 
          </a> 
            <table id="example" class="table display" style="width:100%;">
                         <?php
                               while ($donnees = $reponse->fetch())
                               {
                               
                                   
                                echo '<tr>';
                                         echo  '<th>'.$donnees['prenom'].' '.$donnees['nom'].'</th>';
                                  
                                  
                                 
                                   $req = $bdd->prepare('SELECT * FROM evaluer WHERE idSalarie = ?');
                                     $req->execute(array($donnees['idSalarie']));
                                     while ($reqs = $req->fetch())
                                     {
                                  
                                      echo  '<td>'.$reqs['note'].' </td>';
                                     
                                      echo '</tr>';
                                     
                                     }
                                    
                               }
                           
                               ?>
                            
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
  $(document).ready(function(){
    $('#search').keyup(function(){
      var salarie = $(this).val()
    })
  }

  )
</script>
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



<div>
                        </a>

                      
                   
                        </table>
                    </div>
              