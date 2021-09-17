<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
<?php

include('config/connexion.php');
if(isset($_GET['idSalarie']) )

{

 $idSalarie = trim($_GET['idSalarie']);
 //echo ($idSalarie);
 //$codedossier = trim($_GET['codedossier']);	 
 $req = $bdd->prepare('SELECT *  FROM salarie WHERE idSalarie = ?');
 $req->execute(array($idSalarie));
 var_dump($req);
 while ($donnees = $req->fetch())
{
  
    echo '<tr>';
    echo '<td>'.$donnees.'</td>';
  
    echo '</tr>';
    
    
}


?>
<div>
  <table>




    <TR>
    
    </TR>
  </table>
</div>
<?php }?>
  
</body>
</html>
