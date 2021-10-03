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
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
          <div class="row">
              <div class="col-md-5">  <h3 class="card-title">fonctionActuelle</h3></div>
              <div class="col-md-6">
               <p class="card-text" style="font-size: 17px;">
                        <?= $fonctionActuelle?> </p>
              </div>
          </div>
          <br> <div class="row">
              <div class="col-md-5">  <h3 class="card-title">ancieneteFonc</h3></div>
              <div class="col-md-6">
               <p class="card-text" style="font-size: 17px;">
                        <?= $ancieneteFonc?> </p>
              </div>
          </div> <br>
          <div class="row">
              <div class="col-md-5">  <h3 class="card-title">situation Fammiliale</h3></div>
              <div class="col-md-6">
               <p class="card-text" style="font-size: 17px;">
                        <?= $situationFam?> </p>
              </div>
          </div> <br>
           <div class="row">
              <div class="col-md-5">  <h3 class="card-title">Date de Naissance</h3></div>
              <div class="col-md-6">
               <p class="card-text" style="font-size: 17px;">
                        <?= $dateNaiss?> </p>
              </div>
          </div>  <br>
          <div class="row">
              <div class="col-md-5">  <h3 class="card-title">Tellephone</h3></div>
              <div class="col-md-6">
               <p class="card-text" style="font-size: 17px;">
                        <?= $telephone?> </p>
              </div>
          </div>  <br>
          <div class="row">
              <div class="col-md-5">  <h3 class="card-title">Carburant</h3></div>
              <div class="col-md-6">
               <p class="card-text" style="font-size: 17px;">
                        <?= $carburant?> </p>
              </div>
          </div> <br>
           <div class="row">
              <div class="col-md-5">  <h3 class="card-title">Commussion</h3></div>
              <div class="col-md-6">
               <p class="card-text" style="font-size: 17px;">
                        <?= $commussion?> </p>
              </div>
          </div>  <br>
          <div class="row">
              <div class="col-md-5">  <h3 class="card-title">Vehicule</h3></div>
              <div class="col-md-6">
               <p class="card-text" style="font-size: 17px;">
                        <?= $vehicule?> </p>
              </div>
          </div>  <br>
          <div class="row">
              <div class="col-md-5">  <h3 class="card-title">Autres</h3></div>
              <div class="col-md-6">
               <p class="card-text" style="font-size: 17px;">
                        <?= $autres?> </p>
              </div>
          </div>
       
      </div>
    </div>
  </div>
  <div class="col-sm-6">
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
              <div class="col-md-5">  <h3 class="card-title">Langue</h3></div>
              <div class="col-md-6">
               <p class="card-text" style="font-size: 17px;">
               <?php
                       while ($a = $idLangue->fetch()) {?>
                        <div class="row">
                          <div class="col-md-3"><?=$a['libelle']?></div>
                          <div class="col-md-6"><?=$a['description']?></div>
                         
                       </div>
                         
                     <?php  }
                        
                        ?>
              </div>
          </div> 
          <hr>
           <div class="row">
              <div class="col-md-5">  <h3 class="card-title">Dilpms</h3></div>
              <div class="col-md-6">
               <p class="card-text" style="font-size: 17px;">
               <?php
                        while ($a = $idDiplomSalarie->fetch()) {?>
                         <div class="row">
                           <div class="col-md-3"><?=$a['libelle']?></div>
                           <div class="col-md-6"><?=$a['libelleLigne']?></div>
                           <div class="col-md-3"><?=$a['ecole']?></div>
                        </div>
                          
                      <?php  }
                        
                        ?>
              </div>
          </div> 
          <hr>
           <div class="row">
              <div class="col-md-5">  <h3 class="card-title">Objectifs</h3></div>
              <div class="col-md-6">
               <p class="card-text" style="font-size: 17px;">
               <?php
                $annee_selectionne = date('Y');
                        while ($a = $idObjective->fetch()) {
                            $annee = date('Y',strtotime($a['date']));  ?>
                         <div class="row">
                                 <?php
                                 if ($annee == $annee_selectionne) {
                               echo  $a['libelle']; 
                                 }
                                 ?> 
                        </div>
                          
                      <?php  }
                        
                        ?>
              </div>
          </div> 
                
        
          </div> 
      </div>
    </div>
  </div>
  <hr>
          <h3>Criteres d'evaluation</h3>
           <div class="row table table-bordered">
             
               <p > 
               <?php
              $coefs=0;
              $point =0;
                      while ($a = $idcritere->fetch()) {
                        $coefs += $a['coef'];
                        $point += $a['note'];?>
                      
                      <div class="col-md-8 card-body"><?=$a['libelle'] ?></div>
                         
                         <div class="col-md-1"><?=$a['note'] ?></div>
                         <div class="col-md-1"><?=$a['coef'] ?></div>
                        
                     <hr style="height: 10px;color: black; ">
                      
                    <?php }
                   
                      ?>   
                       </div> 
                       <br>
                      <div class="row card-header">
                        <div class="col-md-8">totals</div>
                        <div class="col-md-1" style="font-size: 20px;"><?=$coefs ?></div>
                        <div class="col-md-1" style="font-size: 20px;"><?=$point ?></div>
                        <div class="col-md-2" style="font-size: 30px;"><?=$point * $coefs ?></div>
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
