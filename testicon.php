<?php

include('header.php');

//$id=$res(['idSalarie']) +1;

$reponse = $bdd->query('SELECT idSalarie FROM salarie ORDER BY idSalarie DESC LIMIT 1');
 
$donnees = $reponse->fetch();

   $res= ( $donnees['idSalarie'])+1;
    echo '<br>';
    echo '<br>';
echo 'Dernier id: '. $res.'!';

 
$reponse->closeCursor();
?>
?>
<br><br><br><br>
<div class="container">

</div>