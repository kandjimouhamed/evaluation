<?php 
ini_set('display_errors', '1');
ini_set('error_reporting', E_ALL);
include('config/connexion.php');
include('config/functions.php');
if (isset($_POST['connexion']))
{
$utilisateur = trim($_POST['utilisateur']); 
$pwd = trim($_POST['pwd']);
$req = $bdd->prepare('SELECT count(*)  FROM intervenant WHERE utilisateur = ? AND pwd = ?');
$req->execute(array($utilisateur, md5($pwd)));
$count = $req->fetchColumn();

if ($count > 0)
{
 session_start();
 $req = $bdd->prepare('SELECT *  FROM intervenant WHERE utilisateur = ? AND pwd = ?');
 $req->execute(array($utilisateur, md5($pwd)));
 while ($donnees = $req->fetch())
 {
  $_SESSION['codeintervenant'] = $donnees['codeintervenant'];
  $_SESSION['nom'] = $donnees['nom'];
  $_SESSION['profil'] = $donnees['profil'];
  $_SESSION['prenom'] = $donnees['prenom'];
  $_SESSION['utilisateur'] = $donnees['utilisateur'];
  $_SESSION['filialecode'] = $donnees['filialecode'];
  $_SESSION['filialenom'] = getFiliale2($donnees['filialecode'],$bdd);
 }

 header('location: index.php'); echo $count;
}
else
{
 header('location: login.php?message=erreur');
 exit;
}
}

?>
<!DOCTYPE html>
<html lang="en">
    
<head>
       <title>GESTION DES ORDRES DE REPARATION | EDITION MARQUES</title><meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="css/bootstrap.min.css" />
		<link rel="stylesheet" href="css/bootstrap-responsive.min.css" />
        <link rel="stylesheet" href="css/maruti-login.css" />
    </head>
    <body>
        <div id="loginbox">            
            <form id="loginform" method="post" class="form-vertical" action="login.php">
				 <div class="control-group normal_text"> <h3><!--img src="img/logo.png" alt="Logo" /-->Connexion</h3></div>
				 <?php
                 if (isset($_GET['message']))
				{ echo '<p class="alert alert-error">Utilisateur ou mot de passe incorrect!</p>';}
                 ?>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on"><i class="icon-user"></i></span><input type="text" name="utilisateur" placeholder="Username" required="required"/>
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on"><i class="icon-lock"></i></span><input type="password" name="pwd" placeholder="Password" required="required"/>
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <!--span class="pull-left"><a href="#" class="flip-link btn btn-inverse" id="to-recover">Mot de passe oubli&eacute;?</a></span-->
                    <span class="pull-right"><input type="submit" name="connexion" class="btn btn-info" value="Connexion" /></span>
                </div>
            </form>
            <!--form id="recoverform" action="#" class="form-vertical">
				<p class="normal_text">Enter your e-mail address below and we will send you instructions how to recover a password.</p>
				
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on"><i class="icon-envelope"></i></span><input type="text" placeholder="E-mail address" />
                        </div>
                    </div>
               
                <div class="form-actions">
                    <span class="pull-left"><a href="#" class="flip-link btn btn-inverse" id="to-login">&laquo; Back to login</a></span>
                    <span class="pull-right"><input type="submit" class="btn btn-info" value="Recover" /></span>
                </div>
            </form-->
        </div>
        
        <script src="js/jquery.min.js"></script>  
        <script src="js/maruti.login.js"></script> 
    </body>

</html>
