<?php 
session_start();
ini_set('display_errors', '1');
ini_set('error_reporting', E_ALL);
include('config/connexion.php');
include('config/functions.php');

$req = $bdd->prepare('SELECT filiale.filialenom FROM salarie INNER JOIN service  ON salarie.idservice = service.ID 
INNER JOIN filiale  ON service.idFiliale = filiale.filialecode  WHERE idSalarie = ?');
    $req->execute(array($_SESSION['codeintervenant']));
    $nomFiliale =  $req->fetchColumn();
    $reqs = $bdd->prepare('SELECT service.NOM_SERVICE FROM salarie INNER JOIN service  ON salarie.idservice = service.ID 
WHERE idSalarie = ?');
    $reqs->execute(array($_SESSION['codeintervenant']));
    $nomService =  $reqs->fetchColumn();
if(!isset($_SESSION['codeintervenant']))
{
    header('location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<title>CCBM INDUSTRIES|GESTION DES EVALUATIONS</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<!--link rel="stylesheet" href="css/bootstrap.min.css" /-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<link rel="stylesheet" href="css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="css/uniform.css" />
<link rel="stylesheet" href="css/script.css" />
<link rel="stylesheet" href="css/onglet.css">
    <!--link rel="stylesheet" href="css/select2.css" /-->
<link rel="stylesheet" href="css/maruti-style.css" />
<link rel="stylesheet" href="css/maruti-media.css" class="skin-color" />
<link rel="stylesheet" href="css/style.css" />
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
<link rel="stylesheet" href="css/jquery.gritter.css" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/autofill/2.3.5/css/autoFill.dataTables.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedcolumns/3.3.1/css/fixedColumns.dataTables.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedheader/3.1.7/css/fixedHeader.dataTables.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css
">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.2/css/dataTables.bootstrap4.min.css
">

<style>
fieldset {
  background-color: #eeeeee;
}

legend {
  background-color: gray;
  color: white; 
  font-size:10px;
  
}


</style>		

<!--link rel="stylesheet" href="css/table.css"-->

<script>    
        function popupBasique(page) 
       {
       window.open(page);
       }
   </script>

</head>
<body>


<!--Header-part-->
<div id="header">
  <h1><a href="#">GESTION DES ORDRES DE REPARATION</a></h1>
</div>
<!--close-Header-part--> 

<!--top-Header-messaages-->
<!--div class="btn-group rightzero"> <a class="top_message tip-left" title="Manage Files"><i class="icon-file"></i></a> <a class="top_message tip-bottom" title="Manage Users"><i class="icon-user"></i></a> <a class="top_message tip-bottom" title="Manage Comments"><i class="icon-comment"></i><span class="label label-important">5</span></a> <a class="top_message tip-bottom" title="Manage Orders"><i class="icon-shopping-cart"></i></a> </div>
<!--close-top-Header-messaages--> 

<!--top-Header-menu-->
<div id="user-nav" class="navbar navbar-inverse">
  <ul class="nav">
    <li class="" ><a title="" href="#"><i class="glyphicon glyphicon-user"></i> <span class="text"><?php echo $_SESSION['prenom'].'  '.$_SESSION['nom']. ' ( '.$nomService .' / '.$nomFiliale.' )'; ?></span></a></li>
    
    <li class=""><a title="" href="logout.php"><i class=" glyphicon glyphicon-log-out "></i> <span class="text">Deconnexion</span></a></li>
  </ul>
</div>

<!--close-top-Header-menu-->     
<div id="sidebar"><a href="#" class="visible-phone"><i class="icon-home"></i> Menu</a><ul>


     <?php  if ((isset($_SESSION['profil'])) && ($_SESSION['profil'] == 1)) {?>
      <li class="active"><a href="synthese.php"><i class="glyphicon glyphicon-dashboard"></i> <span>Tableau de bord</span></a> </li>

    <li class="submenu"> <a href="#"><i class="glyphicon glyphicon-cog"></i> <span>Administration</span> </a>
      <ul>
        <li><a href="filiale.php">Filiale</a></li>
        <li><a href="direction.php">Direction</a></li>
        <li><a href="service.php">Service</a></li>
        <li><a href="intervenant.php">Compte</a></li>
      </ul>
     
    </li>
    <li class="submenu"> <a href="#"><i class="glyphicon glyphicon-wrench"></i> <span>Gestion</span> </a>

    <ul>
                <li><a href="langue.php">langue</a></li>
                <li><a href="Diploms.php">Diploms</a></li>
                <li><a href="PosteOcupee.php">Postes Ocupees</a></li>
                <li><a href="recrutement.php">Recrutement</a></li>
                <li><a href="intervenant.php">Compte</a></li>
                <li><a href="salarie.php">Salarie</a></li>
               
                <li><a href="coefs.php">Critére d'evaluation</a></li>
              
               


            </ul>
    </li>
    
    <? echo  $_SESSION['filialenom'];?>
   <?php } ?>


        <?php  if ((isset($_SESSION['profil'])) && ($_SESSION['profil'] == 2)) {?>

        <li class="submenu"> <a href="#"><i class="glyphicon glyphicon-cog"></i> <span>Administration</span> </a>
       
        <?php } ?>
  </ul>
</div>
