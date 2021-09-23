<?php 
include('header.php');
$evaluer= $bdd->query('SELECT * FROM evaluer ORDER BY id ASC');

$reponse = $bdd->query('SELECT * FROM salarie ORDER BY idSalarie ASC');
$coef = $bdd->query('SELECT * FROM coefs ORDER BY id ASC');

	$req1 = $bdd->prepare('SELECT * FROM service ORDER BY ID ASC');
   $reponse2 = $bdd->prepare('SELECT * FROM evaluer  INNER JOIN salarie ON evaluer.idSalarie = salarie.idSalarie 
     INNER JOIN coefs ON evaluer.idCoef = coefs.id  GROUP BY evaluer.idSalarie');
    $reponse2->execute();
    

//$reponse3 = $bdd->query('SELECT * FROM clients ORDER BY nom ASC');

$tabEtat= array();
if ($_SESSION['profil'] == 1) {$initSalarie = -1;} 
else {$initSalarie = trim($_SESSION['profil'] );}
$idSalarie = -1;
$id = -1;


$sql = 'SELECT * FROM salarie WHERE 1';

if (($_SESSION['profil'] == 1) && (isset($_REQUEST['salarie'])))
{
 $filtreSalarie = trim($_REQUEST['salarie']);	
 if ($idSalarie != -1)
 {
 if ((isset($_REQUEST['service'])) && (trim($_REQUEST['service'])!=-1))
 {
  $idService = trim($_REQUEST['service']);	 
  $sql .= ' AND idservice = '.$id;	 
  $filtreService = $id;	 
 }
 else
 {
  $sql .= ' AND idservice IN (SELECT idservice FROM salarie WHERE idservice = '.$filtreService.') ';	 
 }
}
else
{$filtreSalarie = -1;}
 
}




if((isset($_REQUEST['salarie'])) && (trim($_REQUEST['salarie'])!=-1))
{
	$filtresalarie = trim($_REQUEST['salarie']);
	$sql .=' AND idSalarie = '.$filtresalarie;
}
else {$filtresalarie=-1;}


if((isset($_REQUEST['service'])) && (trim($_REQUEST['service'])!=-1))
{
	$filtreservice = trim($_REQUEST['service']);
	$sql .=' AND ID = '.$filtreservice;
}
else {$filtreservice=-1;}






if(isset($_GET['filtre']))
{
$sql = 'SELECT * FROM salarie WHERE 1';	
if (isset($_REQUEST['salarie1']))
{
 $filtresaarie = trim($_REQUEST['salarie1']);	
 if ($filtresaarie != -1)
 {
 if ((isset($_REQUEST['service1'])) && (trim($_REQUEST['service1'])!=-1))
 {
  $idservice = trim($_REQUEST['service1']);	 
  $sql .= ' AND ID = '.$idservice;	 
  $filtreservice = $idservice;	 
 }
 else
 {
  $sql .= ' AND ID IN (SELECT idservice FROM salarie WHERE ID = '.$filtresaarie.') ';	 
 }
}
else
{$filtresaarie = -1;}
}}


?>
	<div id="content">
			<div id="content-header">
			<div id="breadcrumb">
				 <a href="index.php" title="Retour" class="tip-bottom"><i class="glyphicon glyphicon-home"></i> Accueil</a>
				<a href="#" class="current"><i class="glyphicon glyphicon-dashboard"></i>Tableau de bord</a>
			</div>
             	
			</div>
		
			<div class="container-fluid w3-white" style="font-size:12px;">
		    
		    
<form action="tableaudebord.php" name="filtre" method="get">		    
<fieldset style="font-size=10px;"><legend><button name="valider" type="submit" style="width:100%;" class="" style="color:white;">Filtrer</button>

</legend>
<?php //echo $req->debugDumpParams();?>
<div class="w12-row" style="margin-top:-12px;font-size:10px;">
  <div class="w3-col m2 w3-center">
  <label>Filiale</label>
  
  
  </div>
<div class="w3-col m2 w3-center">
  <label>Direction</label>
  
<div id="blocDirections"> <select class="w3-select w3-border" name="direction" id="direction">
      <option value="-1">Tous</option>
    
      <?php 
                                     while ($donnees = $req1->fetch())
                                     {
                                         if ($donnees['ID'] == $filtreservice)
                                         {echo '<option value="'.$donnees['ID'].'" selected>'.$donnees['[NOM_SERVICE'].'</option>'; }
                                         else
                                         {echo '<option value="'.$donnees['ID'].'">'.$donnees['[NOM_SERVICE'].'</option>'; }
                                     }
                                     ?>                     
     </select></div>
  
</div> 




</fieldset>
 </form>		       
			 <div class="w3-row w3-border">
             <div class="w3-col s12" style='overflow-x:scroll;'>
			
			 <table id="" class="table table-bordered">
			
             <caption style="caption-side:top;text-align:center;">LOCALISATION DES VEHICULES</caption>
  <thead>
         <tr>
	    <th>Prenom et nom  
      </th>
	    
		<?php 

		  while ($donnees = $coef->fetch())
        { 
         
          
	     echo '<th style >'. $donnees['libelle'].'</th>';
	//	$tabcoef[] = $donnees['coef'];
            
	    }
		echo '<th>Total</th>';
    echo '</tr>';
        ?>
      
    </thead>
    <tbody >
        <?php
           
                      $evaluer = $bdd->prepare('SELECT * FROM evaluer  INNER JOIN salarie ON evaluer.idSalarie = salarie.idSalarie   GROUP BY evaluer.idSalarie');
                      $evaluer->execute();
                                   while ($d = $reponse2->fetch())
                                   {
                                    echo '<tr class="gradeA">';
                                    echo  '<td>'.$d['nom'].' '.$d['prenom'].'</td>';
                                    
                                    $salarie = $bdd->prepare('SELECT * FROM evaluer  WHERE idSalarie = ?');
                                    $salarie->execute(array($d['idSalarie']));

                                       while ($dd = $salarie->fetch())
                                       {
                                       
                                     // echo  '<td>'.$dd['nom'].' '.$dd['prenom'].'</td>';
                                      
                                         if ($dd['id'] = $dd['idCoef'] ) {
                                          echo  '<td>'.$dd['note'].' </td>';
                                         }  if ($dd['id'] == $dd['idCoef'] ) {
                                          echo  '<td></td>';
                                         }
                                        
                                   
                                      
                                       }
                                   }
                                

                echo '</tr>';
                            ?>
                   </tbody>
       
    </table>
	 
			 </div>
             </div> 
            
		 
			<div class="row-fluid">
				<div class="widget-box">
							<!--div class="widget-title">
								<span class="icon">
									<i class="icon-eye-open"></i>
								</span>
								<h5>Details</h5-->
			
							<!--/div-->
							<!--div class="widget-content nopadding">
						  <br/><br/><br/><br/-->
						 
 <!--div style="color: white;padding: 15px;width: 100%;overflow: scroll;border: 1px solid #ccc;"-->						  
 
<!--/div-->			<!--/div--></div></div>
            	</div></div>

               
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
        fixedColumns:   {
            leftColumns: 9
        },
	
		
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
