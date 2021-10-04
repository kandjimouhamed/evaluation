<?php

include('header.php');
if (isset($_GET['idSalarie']))
{
    $idSalarie = trim($_GET['idSalarie']);


    if (trim($_GET['action']) == 'detail')
    {

        $req = $bdd->prepare('SELECT *  FROM salarie WHERE idSalarie = ?');
        $req->execute(array($idSalarie));


        while ($donnees = $req->fetch())
        {
            $prenom = $donnees['prenom'];
            $nom = $donnees['nom'];
           $fonctionActuelle = $donnees['fonctionActuelle'];
           $telephone = $donnees['telephone'];
           $carburant = $donnees['carburant'];
           $situationFam = $donnees['situationFam'];
           $dateNaiss = $donnees['dateNaiss'];
           $commussion = $donnees['commussion'];
           $vehicule = $donnees['vehicule'];
            $autres = $donnees['autres'];
           $ancieneteFonc = $donnees['ancieneteFonc'];
           $idser = $bdd->prepare('SELECT service.NOM_SERVICE ,filiale.filialenom FROM salarie INNER JOIN service ON salarie.idService 
           INNER JOIN filiale ON service.idFiliale = filiale.filialecode 
           Where idSalarie = ?');
           $idser->execute(array($donnees['idSalarie']));
           $idservice=$idser->fetchColumn();

           $idfiliale = $bdd->prepare('SELECT filiale.filialenom FROM filiale  
           Where filialecode = ?');
           $idfiliale->execute(array($donnees['idSalarie']));
           $idfiliale=$idfiliale->fetchColumn();

           $idParentel = $donnees['idParentel'];
           $idPO = $donnees['idPO'];
           $idRecrutement = $donnees['idRecrutement'];
           $idLangue = $bdd->prepare('SELECT * FROM languesalarie INNER JOIN langue ON languesalarie.idLangue = langue.idLangue 
           Where idSalarie = ?');
           $idLangue->execute(array($donnees['idSalarie']));

           $idDiplomSalarie = $bdd->prepare('SELECT * FROM diplomsalarie INNER JOIN diplom ON diplomsalarie.idDiplom = diplom.idDiplom 
           Where idSalarie = ?');
           $idDiplomSalarie->execute(array($donnees['idSalarie'])); 
           $idObjective = $bdd->prepare('SELECT * FROM objectifs Where idSalarie = ? ');
           $idObjective->execute(array($donnees['idSalarie']));

           $idcritere = $bdd->prepare('SELECT * FROM evaluer INNER JOIN coefs ON evaluer.idCoef = coefs.id 
           Where idSalarie = ?');
           $idcritere->execute(array($donnees['idSalarie'])); 

          
     
         //$idLangue = $langueSalarie->fetchColumn();
           $contrat = $donnees['contrat'];
           $montant = $donnees['montant'];
           $profil = $donnees['profil'];

           

        }
    }
    else
    {
        $idSalarie = -1;
        $idservice = -1;
        $idParentel = -1;
        $idPO = -1;
        $idRecrutement = -1;
        $idLangue = -1;
        $idDiplomSalarie = -1;
        $idObjective = -1;
        $prenom = "";
        $nom = "";
        $fonctionActuelle = "";
        $ancieneteFonc = "";
        $situationFam = "";
        $dateNaiss = "";
        $telephone = "";
        $carburant  = "";
        $commussion  = "";
        $vehicule  = "";
        $autres = "";
        $contrat = "";
        $montant = "";
        $profil = "";
    }
}
else
{
    $idSalarie = -1;
    $idservice = -1;
    $idParentel = -1;
    $idPO = -1;
    $idRecrutement = -1;
    $idLangue = -1;
    $idDiplomSalarie = -1;
    $idObjective = -1;
    $prenom = "";
    $nom = "";
    $fonctionActuelle = "";
    $ancieneteFonc = "";
    $situationFam = "";
    $dateNaiss = "";
    $telephone = "";
    $carburant  = "";
    $commussion  = "";
    $vehicule  = "";
    $autres = "";
    $contrat = "";
    $montant = "";
    $profil = "";
}

$parentel = $bdd->query('SELECT * FROM parentel ');
$posteocupee = $bdd->query('SELECT * FROM posteocupee ');
$service = $bdd->query('SELECT * FROM service ');
$diplom = $bdd->query('SELECT * FROM diplom ');
$recrutement = $bdd->query('SELECT * FROM recrutement ');
$langue = $bdd->query('SELECT * FROM langue ');

?>
<header>
</header>
<br>
<div class="container">
<br><br>
<div class="widget-title">
<div class="row">
              <div class="col-md-5">
              <p  style="font-size: 17px;padding-left: 20px; ">
                        <?= $prenom.'  '.$nom ?> 
              </p>
              </div>
              
              <div class="col-md-7">
              <p  style="font-size: 17px;">
                <?=$idservice?> 
              </p>
</div>
</div>
</div>
   
    <div class="row">
      
  <div class="col-sm-12">
    <div class="card">
      <div class="card-body">
      <div class="row">
              <div class="col-md-5">  <h3 class="card-title">Montant Salarie</h3></div>
              <div class="col-md-6">
               <p class="card-text" style="font-size: 17px;">
                        <?= $montant?> </p>
              </div>
          </div> 
           <br> <div class="row">
              <div class="col-md-5">  <h3 class="card-title">Contrat</h3></div>
              <div class="col-md-6">
               <p class="card-text" style="font-size: 17px;">
                        <?= $contrat?> </p>
              </div>
          </div>  
          <br> <div class="row">
              <div class="col-md-5">  <h3 class="card-title">Profil</h3></div>
              <div class="col-md-6">
               <p class="card-text" style="font-size: 17px;">
               <?php
               if ( $profil == 1 ) {
                  echo 'Administrateur';
               }else if ( $profil == 2 ) {
                echo 'Chef de Service';
             }else if ( $profil == 3 ) {
                echo 'Employe';
             }else{
                echo 'Chef de Filiale';
             }
               ?>
                        </p>
              </div>
          </div>
          <br> <div class="row">
         
           <table class="table">
             <thead>
             <th>Criteres d'evaluation</th>
             <th>Notes obtenues</th>
                <th>Notes Demandes</th>
                <th>Pourcentage</th>
             </thead>
             <tbody>
              
               <?php
              $coefs=0;
              $point =0;
              $total =0;
              $cont =0;
              $porcentage =0;
              $req = $bdd->prepare('SELECT *  FROM evaluer WHERE idCoef= ?');
              $req->execute(array($idCoef));
                  while ($a = $idcritere->fetch()) {
                        $cont +=1;
                        $coefs += $a['coef'];
                        $point += $a['note'];
                       // $total +=  ($a['coef'] * $a['note']);
                        ?>
                       <tr>
                      <td ><?=$a['libelle'] ?></td>
                         
                         <td><?=$a['note'] ?></td>
                         <td>5</td>
                        
                         
                         </tr>
                    <?php }
                     $tatalNote =$point/($cont *5);

                      ?>  
              
             </tbody>
             <tfoot>
              <tr>
                <th>TOTAL</th>
                <th><?=$point ?></th>
                <th><?=$cont*5 ?></th>
            
                <th style="width: 4px;"><?= round($tatalNote *100) ?>%</th>
              </tr>
              <tr>
                        <?php
                        if( round($tatalNote *100) >= 90){
                            echo '<th>Appréciation: </th>';
                            echo '<th>Trés Bien</th>';
                        }else if( round($tatalNote *100) >= 70  ){
                            echo '<th>Appréciation: </th>';
                          
                            echo '<th>Bien</th>';
                        }else if( round($tatalNote *100) >= 60  ){
                            echo '<th>Appréciation: </th>';
                          
                            echo '<th>Assez Bien</th>';
                        }else if( round($tatalNote *100) >= 50  ){
                            echo '<th>Appréciation: </th>';
                          
                            echo '<th>Passable</th>';
                        }else if( round($tatalNote *100) < 0  ){
                            echo '<th>Appréciation: </th>';
                          
                            echo '<th>Médiocre</th>';
                        }
                        
                        ?>
              </tr>
             </tfoot>
           </table>
           
           </div> 
          
</div>
</div>
<br><br><br><br>
<div class="row-fluid">
    <div id="footer" class="span12"> 2019 &copy;  <a href="#">CCBM TECHNOLOGIES ET SOLUTIONS</a> </div>
</div>
<script src="js/jquery.min.js"></script>
<script src="js/scripte.js"></script>
<script src="js/jquery.ui.custom.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.uniform.js"></script>
<!--script src="js/select2.min.js"></script-->
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/maruti.js"></script>
<script src="js/maruti.tables.js"></script>
<script src="js/maruti.form_validation.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

</body>
</html>
