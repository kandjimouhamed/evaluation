<?php

include('header.php');
if (isset($_GET['idSalarie']))
{
    $idSalarie = trim($_GET['idSalarie']);

    if (trim($_GET['action']) == 'edit')
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
           $idservice = $donnees['idservice'];
           $idParentel = $donnees['idParentel'];
           $idPO = $donnees['idPO'];
           $idRecrutement = $donnees['idRecrutement'];
           $req = $bdd->prepare('SELECT libelle FROM langue WHERE idLangue = ?');
          // $req->execute(array($donnees,['idLangue']));
          // $libelle =  $req->fetchColumn();
           $evaluer = $bdd->prepare('SELECT langue.libelle FROM languesalarie  INNER JOIN salarie ON languesalarie.idSalarie = salarie.idSalarie 
           INNER JOIN langue ON languesalarie.idLangue = langue.idLangue ');
            $evaluer->execute(array());
             $libelle =  $evaluer->fetchColumn();
           $idLangue = $libelle ;
           $contrat = $donnees['contrat'];
           $password = $donnees['pwd'];
           $profil = $donnees['profil'];
         
          // $note = $donnees['note'];
           $montant = $donnees['montant'];


           

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
        $password = "";
        $profil = "";
        $idCoef = -1;
       // $note = "";
        $montant = "";
        
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
    $password = "";
     $profil = "";
     $idCoef = -1;
     //$note = "";
     $montant = "";
}

$parentel = $bdd->query('SELECT * FROM parentel ');
$posteocupee = $bdd->query('SELECT * FROM posteocupee ');
$service = $bdd->query('SELECT * FROM service ');
$diplom = $bdd->query('SELECT * FROM diplom ');
$recrutement = $bdd->query('SELECT * FROM recrutement ');
$langue = $bdd->query('SELECT * FROM langue ');
$salarie = $bdd->query('SELECT * FROM salarie ');
$critere = $bdd->query('SELECT * FROM coefs ');
$description = $bdd->query('SELECT * FROM descriptionlangue ORDER BY libelle ASC');

$reponse = $bdd->query('SELECT idSalarie FROM salarie ORDER BY idSalarie DESC LIMIT 1');
            
        $donnees = $reponse->fetch();

        // $ids= ( $donnees['idSalarie'])+1;
        if ($donnees['idSalarie'] == 0) {
            $ids = 1;
        }else{
            $ids= ( $donnees['idSalarie']);
        }
        
        $langue = $bdd->query('SELECT * FROM langue ORDER BY idLangue DESC ');
?>
  
<br>
<div class="container ">
        <br><br><br>
        <div id="content-header">
            <div id="breadcrumb"> <a href="index.php" title="Retour" class="tip-bottom"><i class="icon-home"></i> Accueil</a> <a href="salarie.php" class="current">Salaries</a> <a href="#"><i class="icon-edit"></i>Saisie Salarie</a> </div>
            <!--h1>Gestion des services</h1-->
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
<div class="container-fluid" style="margin-top: 0;">
    <div class="row-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title">
                    <span class="icon"><i class="icon-th"></i>Ajouter Salarie</span>

                </div>
                <div class="w3-container w3-white">
                    <div class="w3-row-padding">
<br>
          <div>
            
            <ul class="tabs">
                <li class="active"><a href="#homme">Salarie</a></li>
                <li><a href="#mentions">Langues</a></li>
                <li><a href="#about">Diploms</a></li>
                <li><a href="#objective">Objectif</a></li>
                <li><a href="#critere">Critere d'evaluation</a></li>
            </ul>
            <form action="action_AjoutSalarie.php"  method="post">
                <!-- le corp -->

             <div class="tabs-containt">
                    <!-- div1 -->
                  <br>
                <div id="homme" class="tab-containt active"> 
                  <!-- page 1 -->
                  <div class="page city" id="London">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                       
                                             <div class="col-md-4">
                                       Prenom
                                        </div>
                                        <div class="col-md-8">
                                        <input type="text" class="w3-input w3-border" name="prenom" id="prenom" value = "<?php echo $prenom; ?> " required >
                                        <input type="hidden" name="idSalarie" value = "<?php echo $idSalarie; ?>">
                                        </div>
                                    </div>
                               <br>
                                    <div class="row">
                                   <div class="col-md-4">Nom</div>
                                   <div class="col-md-8">
                                   <input type="text" class="w3-input w3-border" name="nom" id="nom" value = "<?php echo $nom; ?>" required>
                                <input type="hidden" name="idSalarie" value = "<?php echo $idSalarie; ?>">
                                   </div>
                               </div> 
                               <br> 
                               <div class="row">
                                   <div class="col-md-4" style="margin-top: 10px;">Fonction Actuelle</div>
                                   <div class="col-md-8">
                                   <input type="text" class="w3-input w3-border" name="fonctionActuelle" id="fonctionActuelle" value = "<?php echo $fonctionActuelle; ?>" required>
                                         <input type="hidden" name="idSalarie" value = "<?php echo $idSalarie; ?>">
                                   </div>
                               </div> 
                               <br>
                               <div class="row">
                                   <div class="col-md-4">Ancienete dans la Fonction</div>
                                   <div class="col-md-8">
                                   <input type="text" class="w3-input w3-border" name="ancieneteFonc" id="ancieneteFonc" value = "<?php echo $ancieneteFonc; ?>" required>
                                <input type="hidden" name="idSalarie" value = "<?php echo $idSalarie; ?>">
                                   </div>
                               </div> 
                               <br>
                               <div class="row">
                                   <div class="col-md-4" style="margin-top: 10px;">Situation Fammilialle</div>
                                   <div class="col-md-8">
                                   <select name="situationFam" id="situationFam"  style="width:100%;" size="1" value = "<?php echo $situationFam; ?>"  class="mt-3 w3-input w3-border form-group" size="1" required>
                                           
                                           <option value="marie"> Marie(e) </option>
                                           <option value="calibataire"> Celibataire</option>
                                          
                                       </select>
                                       <input type="hidden" name="idSalarie" value = "<?php echo $idSalarie; ?>">
                                   </div>
                               </div> 
                             </div>
                       
                                
                                <div class="col-md-6">
                                <div class="row">
                                   <div class="col-md-4">Telephone</div>
                                   <div class="col-md-8">
                                   <input type="text" class="w3-input w3-border" name="telephone" id="telephone" value = "<?php echo $telephone; ?>" required>
                                <input type="hidden" name="idSalarie" value = "<?php echo $idSalarie; ?>">
                                   </div>
                                  
                               </div>
                               <br>
                                <div class="row">
                                    <br>
                                   <div class="col-md-4" style="margin-top: 10px;">Carburant</div>
                                   <div class="col-md-8">
                                   <input type="text" class="w3-input w3-border" name="carburant" id="carburant" value = "<?php echo $carburant; ?>" required>
                                <input type="hidden" name="idSalarie" value = "<?php echo $idSalarie; ?>">
                                   </div>
                               </div>
                       
                               <br>         
                                 <div class="row">
                                 <div class="col-md-4">Commussion</div>
                                 <div class="col-md-8">
                                  
                                           
                                 <input type="text" class="w3-input w3-border" name="commussion" id="commussion" value = "<?php echo $commussion; ?>" required>
                                <input type="hidden" name="idSalarie" value = "<?php echo $idSalarie; ?>">
                                   </div>
                                 </div>
                                <br>
                                <div class="row">
                                 <div class="col-md-4">Vehicule</div>
                                 <div class="col-md-8">
                            
                                 <input type="text" class="w3-input w3-border" name="vehicule" id="vehicule" value = "<?php echo $vehicule; ?>" required>
                                <input type="hidden" name="idSalarie" value = "<?php echo $idSalarie; ?>">
                                 </div>
                                </div>
                                
                                <br/>
                                <div class="row">
                                 <div class="col-md-4">Autres</div>
                                 <div class="col-md-8">
                               
                                <input type="text" class="w3-input w3-border" name="autres" id="autres" value = "<?php echo $autres; ?>">
                                <input type="hidden" name="idSalarie" value = "<?php echo $idSalarie; ?>">
                               
                                 </div>
                                </div>
                                </div>
                            </div>
                        
                                <button class="w12-bar-item w3-button w3-light-grey suivant" style="width:100%;" type="button">Suivant</button>
                            </div>

                            <!-- fin de la page 1 --> 
                            <!-- debut page 2 -->
                            <div class="page">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-4">
                                            type de Contrat  
                                            </div>
                                            <div class="col-md-8">
                                            <select name="contrat" id="contrat"  style="width:100%;" size="1"  class="w3-select w3-border" size="1"  value = "<?php echo $contrat; ?>" required>
                                         
                                         <option value="cdd"> C D D </option>
                                         <option value="cdi"> C D I </option>
                                        
                                     </select>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-4">
                                            Date de Naissance
                                            </div>
                                            <div class="col-md-8">
                                           
                                                <input type="date" class="w3-input w3-border" name="dateNaiss" id="dateNaiss" value = "<?php echo $dateNaiss; ?>" required>
                                                <input type="hidden" name="idSalarie" value = "<?php echo $idSalarie; ?>">
                                               
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-4">
                                            Poste Ocupee
                                            </div>
                                            <div class="col-md-8">
                                       
                                        <select name="idPO" id="idPO"  style="width:100%;" size="1" class="w3-select w3-border" size="1" required>
                                            <option>  </option>
                                            <?php
                                            while ($donnees = $posteocupee->fetch()) {
                                                if($donnees ['idPO'] == $idPO) 
                                                {
                                                    echo '<option value="' . $donnees['idPO'] . '" selected>' . $donnees['libelle'] . '</option>';
                                                }
                                                else
                                                {
                                                    echo '<option value="' . $donnees['idPO'] . '">' . $donnees['libelle'] . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-4">Password</div>
                                            <div class="col-md-8">
                                            <input type="password" class="w3-input w3-border" name="password" id="password" style="width:100%;height:28px;"/>
                                            </div>
                                        </div> <br>
                                        <div class="row">
                                            <div class="col-md-4">Confirmer password</div>
                                            <div class="col-md-8">
                                            <input type="password" class="w3-input w3-border" name="pwd2" id="pwd2" style="width:100%;height:28px;"/>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-4">Le Parente</div>
                                            <div class="col-md-8">
                                            <select name="idParentel"  style="width:100%;" id="idParentel" size="1"  class="w3-select w3-border" size="1" required>
                                                <option>  </option>
                                                <?php
                                                while ($donnees = $parentel->fetch()) {
                                                    if($donnees ['idParentel'] == $idParentel) 
                                                    
                                                    {
                                                        echo '<option value="' . $donnees['idParentel'] . '" selected>' . $donnees['libelle'] . '</option>';
                                                    }
                                                    else
                                                    {
                                                        echo '<option value="' . $donnees['idParentel'] . '">' . $donnees['libelle'] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-4">Service</div>
                                            <div class="col-md-8">
                                          
                                                 <select name="idservice"  style="width:100%;" id="idservice" size="1" class="w3-select w3-border" size="1" required>
                                            <option>  </option>
                                             <?php
                                              while ($donnees = $service->fetch()) {
                                                $req = $bdd->prepare('SELECT filialenom FROM filiale WHERE   filialecode = ?');
                                                $req->execute(array($donnees['idFiliale']));
                                                $nomFiliale =  $req->fetchColumn();
                                              if($donnees ['ID'] == $idservice) 
                                               {
                                                    echo '<option value="' . $donnees['ID'] . '" selected>' . $donnees['NOM_SERVICE'] . ' / ' . $nomFiliale . '</option>';
                                                }else{
                                                    echo '<option value="' . $donnees['ID'] . '">' . $donnees['NOM_SERVICE'] . '  / ' . $nomFiliale . '</option>';
                                                }
                                            }
                                            ?>
                                            </select>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-4">Type de recrutment</div>
                                            <div class="col-md-8">
                                           
                                        <select name="idRecrutement"  style="width:100%;" id="idRecrutement" size="1"  class="w3-select w3-border" size="1" required>
                                            <option>  </option>
                                            <?php
                                            while ($donnees = $recrutement->fetch()) {
                                                if($donnees ['idRecrutement'] == $idRecrutement) 
                                                {
                                                    echo '<option value="' . $donnees['idRecrutement'] . '" selected>' . $donnees['libelle'] . '</option>';
                                                }
                                                {
                                                    echo '<option value="' . $donnees['idRecrutement'] . '" >' . $donnees['libelle'] . '</option>';
                                                }
                                
                                            }
                                            ?>
                                        </select>
                                            </div>
                                        </div> 
                                       <br>
                                        <div class="row">
                                            <div class="col-md-4">Profil</div>
                                            <div class="col-md-8">
                                            <select name="profil" id="profil" style="width:100%;" id="idRecrutement" size="1"  class="w3-select w3-border" size="1" required>
										 
										 <option value="1">Administrateur</option>
                                         <option value="2">Chef de Service</option>
										 <option value="3">Employe</option>
										 <option value="4">Chef de Filiale</option>
                                   </select> 
                                  </div>
                                        </div>
                                        <br/>
                                <div class="row">
                                 <div class="col-md-4">Montant Salaire</div>
                                 <div class="col-md-8">
                               
                                <input type="number" class="w3-input w3-border" name="montant" id="montant" value = "<?php echo $montant; ?>">
                                <input type="hidden" name="idSalarie" value = "<?php echo $idSalarie; ?>">
                               
                                 </div>
                                </div>
                                    </div>
                                </div>
                                <br>
                                <button  type="button"  class="w3-bar-item w3-button w3-light-grey precedent" style="width:48%;">Precedent</button>
                                <button name="valider" type="submit"  class="w3-bar-item w3-button w3-light-grey" style="width:48%;">Valider</button><br/><br/>
                                
                            </div>
                       </div>
               
        </form> 
                 <!-- fin div1 -->
                  <!-- div2 -->
                <form method="post" id="repeater_form" action="actionLigneLangueSalarie.php" class="form-horizontal" name="basic_validate" id="basic_validate">
                         <div id="mentions"  class="tab-containt"> 
                           <div class="item-content">
                                    <div class="form-group">
                                        <div class="row">
                                        <div class="col-md-6">
                                           <label>Select un langage</label>
                                           <select class="form-control"  name="idLangue"style="width:100%; font-size: 13px; " id="idLangue" size="1" class="w3-select w3-border" size="1" required>
                                            <option>  </option>
                                            <?php
                                            while ($donnees = $langue->fetch()) {
                                              if($donnees ['idLangue'] == $idLangue) 
                                               {
                                                    echo '<option value="' . $donnees['idLangue'] . '" selected>' . $donnees['libelle'] . '</option>';
                                                }else{
                                                    echo '<option value="' . $donnees['idLangue'] . '">' . $donnees['libelle'] . '</option>';
                                                }
                                            }
                                            ?>
                            
                                           </select>
                                               
                                                </div> 
                                                <div class="col-md-6">
                             <table class="table">
                                            <thead>
                                                <tr>
                                                <th scope="col">LANGUE</th>
                                                <th scope="col">DESCRIPTIONS</th>
                                                <th scope="col">ACTION</th>
                                                
                                                </tr>
                                            </thead>
                              <?php
            
                                    $reqs = $bdd->prepare('SELECT * FROM languesalarie 
                                     INNER JOIN langue ON languesalarie.idLangue = langue.idLangue WHERE idSalarie =?');
                                    $reqs->execute(array($ids));
                                  
                                    while ($a = $reqs->fetch()) {
                                    ?>
                                    <tbody>
                                    <tr>
                                    <td><?=$a['libelle']?></td>
                                    <td> <?=$a['description']?></td>
                                    <td>  <a href="supprimer.php?action=suppridLS&idLS=<?=$a['idLS']?>" onclick="return(confirm('Etes-vous sur de vouloir supprimer cette entree?'));"><i class="glyphicon glyphicon-trash"></i></a>
                                    </td>
                                   
                                    </tr>
                                    </tbody>
                                  
                             <?php   }
                                                      
                                                ?>
                         </table>
                                                </div>
                                            </div> </div> </div>

                                                <div id="repeater">
                           
                          
                           <div class="clearfix"></div>
                           <div class="items" data-group="programming_languages">
                               <div class="item-content">
                                   <div class="form-group">
                                       <div class="row">
                                       <div class="col-md-9 form-check" >
                                       <input type="hidden" name="idSalarie" value = "<?php echo $ids; ?>">

                                          <label>Selectionner la description</label>
                                        
                                          <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="description[]" value="lire" id="flexCheckDefault">
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                       LIRE
                                                    </label>
                                                    </div>
                                                    <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="description[]" value="parler" id="flexCheckChecked" checked>
                                                    <label class="form-check-label" for="flexCheckChecked">
                                                      PARLER
                                                    </label>
                                                    </div>
                                                    <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="description[]" value="ecrire" id="flexCheckChecked" checked>
                                                    <label class="form-check-label" for="flexCheckChecked">
                                                       ECRIRE
                                                    </label>
                                                    </div>
                                                                                                    
                                        </div>
                                          
                                         </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                       <div class="form-group" align="center">
                      <br /><br />
                           <input type="submit" name="valider" class="btn btn-success" value="insert" />
                       </div>
                           <div class="clearfix"></div>          
                </div>
                </form> 
               
                   <!-- fin div2 -->
                  <!-- div3 -->
                <div id="about" class="tab-containt"> 
                    <form method="post" id="repeater_form" action="actionDiplomSalarie.php" class="form-horizontal" name="basic_validate" id="basic_validate">

                  
                    <div class="item-content">
                       <div class="row"> 
                            <div class="col-md-6">

                           
                        <div class="row " >
                        <div class="col-md-1"></div>
                        <div class="col-md-3"> <label>Selectionner  un Diplom</label></div> 
                        <div class="col-md-6">
                        <div class="form-group">
                                <select class="form-control"  name="idDiplom"style="width:100%; font-size: 13px; " id="idDiplom" size="1" class="w3-select w3-border" size="1" required>
                                <option>  </option>
                                            <?php
                                            while ($donnees = $diplom->fetch()) {
                                              if($donnees ['idDiplom'] == $idSalarie) 
                                               {
                                                    echo '<option value="' . $donnees['idDiplom'] . '" selected>' . $donnees['libelle'] . '</option>';
                                                }else{
                                                    echo '<option value="' . $donnees['idDiplom'] . '">' . $donnees['libelle'] . '</option>';
                                                }
                                            }
                                            ?>
                            
                            </select>
                                
                           </div> </div> </div> 
                           <input type="hidden" name="idSalarie" value = "<?php echo $ids; ?>">
                           <div class="row">
                             <div class="col-md-1"></div>
                                <div class="col-md-3"> <label>Detail </label></div> 
                                <div class="col-md-6">
                                <input type="text" class="w3-input w3-border" name="libelle" id="libelle" value = ""  required >
                                
                                 </div>
                           </div> 
                           <br>
                           <div class="row">
                             <div class="col-md-1"></div>
                                <div class="col-md-3"> <label>L'ecole</label></div> 
                                <div class="col-md-6">
                                <input type="text" class="w3-input w3-border" name="ecole" id="ecole" value = " " required >
                                
                                 </div>
                           </div>
                       
                        <div class="clearfix"></div>
                       <div class="form-group" align="center">
                      <br /><br />
                           <input type="submit" name="valider" class="btn btn-success redrecrtion" value="insert" />
                       </div>
                       </div>
                            <div class="col-md-6">
                            <table class="table">
                                            <thead>
                                                <tr>
                                                <th scope="col">DIPLOM</th>
                                                <th scope="col">DETAILE DIPLOM</th>
                                                <th scope="col">L'ECOLE</th>
                                                <th scope="col">ACTION</th>

                                                </tr>
                                            </thead> 
                              <?php
            
                                    $reqs = $bdd->prepare('SELECT * FROM diplomsalarie 
                                     INNER JOIN diplom ON diplomsalarie.idDiplom = diplom.idDiplom WHERE idSalarie =?');
                                    $reqs->execute(array($ids));

                                    while ($a = $reqs->fetch()) {
                                    ?>
                                    <tbody>
                                    <tr>
                                    <td><?=$a['libelle']?></td>
                                    <td><?=$a['libelleLigne']?></td>
                                    <td> <?=$a['ecole']?></td>
                                    <td>  <a href="supprimer.php?action=suppr&idDipSala=<?=$a['id']?>" onclick="return(confirm('Etes-vous sur de vouloir supprimer cette entree?'));"><i class="glyphicon glyphicon-trash"></i></a>
                                    </td>
                                    </tr>
                                    </tbody>
                                  
                             <?php   }
                                                      
                                                ?>
                         </table>
                            </div>
                            
                     </div>
                       </div>
                    </form>
                 </div>   <!-- fin div3 -->
                  <!-- div4 -->
                   <!-- fin div4 -->
                
          
                <!-- fin de corp -->
                <div id="critere" class="tab-containt"> 
                    <form action="actionAjoutCritere.php" method="post">
                        
                                        <input type="hidden" name="idSalarie" value = "<?php echo $ids; ?>">
                
                                 <div class="row">
                                    <div class="col-md-6"> 
                                    <div class="form-check">                                        
                                       
                                         <input   type="hidden" name="note" value="0">
                                      <div class="form-group">
                                        <label for="">Selectionner les Criteres d'Evaluation</label>
                                        <select class="form-control"  name="idCoef"style="width:100%; font-size: 13px; " id="idCoef" size="1" class="w3-select w3-border" size="1" required>
                                        <option>  </option>
                                                    <?php
                                                    while ($donnees = $critere->fetch()) {
                                                    if($donnees ['id'] == $idCoef) 
                                                    {
                                                            echo '<option value="' . $donnees['id'] . '" selected>' . $donnees['libelle'] . '</option>';
                                                        }else{
                                                            echo '<option value="' . $donnees['id'] . '">' . $donnees['libelle'] . '</option>';
                                                        }
                                                    }
                                                    ?>
                                    
                                       </select>
                                
                                  </div>
                                </div>
                                <input type="submit" name="valider" class="btn btn-success" value="insert" />
                              </div>
                              <div class="col-md-6"> 
                              <table class="table">
                                            <thead>
                                                <tr>
                                                <th scope="col"></th>
                                                <th scope="col">List des critére d'evaluation </th>
                                                <th scope="col">ACTION</th>
                                                
                                                
                                                </tr>
                                            </thead> 
                              <?php
            
                                    $reqs = $bdd->prepare('SELECT * FROM evaluer INNER JOIN coefs ON evaluer.idCoef=coefs.id WHERE  idSalarie =?');
                                    $reqs->execute(array($ids));
                                    $i =1;
                                    while ($a = $reqs->fetch()) {
                                    ?>
                                    <tbody>
                                    <tr>
                                    <td><?=$i?></td>
                                    <td><?=$a['libelle']?></td>
                                    <td>  <a href="supprimer.php?action=supprC&idC=<?=$a['idEvaluer']?>" onclick="return(confirm('Etes-vous sur de vouloir supprimer cette entree?'));"><i class="glyphicon glyphicon-trash"></i></a>
                                    </td>
                                    </tr>
                                    </tbody>
                                  
                             <?php $i ++;  }
                                                      
                                                ?>
                         </table>
                              </div>
                         </div>
                      
                   
        
                    </form>
                    
                </div>
                <div id="objective" class="tab-containt">
                <form class="form-horizontal" method="post" action="actionAjoutObjectif.php" name="basic_validate" id="basic_validate">
        <div class="row">
         
          <div class="col-md-6">
               <input type="hidden" name="idSalarie" value = "<?php echo $ids; ?>">

                        <?php
                        $annee_selectionne = date('Y');
                        
                        ?>


                                    <label>Saisir un Objectif</label>
                                            <input type="text" class="w3-input w3-border" name="libelle" id="libelle"  required>
                                              <input type="hidden" name="id" value = "<?php echo $id; ?>">
                                        <br/><br/>
                                       
                                            <input type="hidden" class="w3-input w3-border" name="date" id="date" value = "<?php echo $annee_selectionne = date('Y/m/d'); ?>" required>
                                              <input type="hidden" name="id" value = "<?php echo $id; ?>">
                                        <br/><br/>
										<a href="#" class="w3-bar-item w3-button w3-light-grey" style="width:49%;" onclick="location.href='filiale.php'" >Retour</a>
    <!--button name="" type="submit"  class="w3-bar-item w3-button w3-light-grey" style="width:49%;" name="retour" value="Retour" onclick="location.href='commandempr.php'" >Annuler</button-->
                       <button name="valider" type="submit"  class="w3-bar-item w3-button w3-light-grey" style="width:50%;">Valider</button><br/><br/>
          </div>
          <div class="col-md-6">
          <table class="table">
                                            <thead>
                                                <tr>
                                                <th scope="col"></th>
                                                <th scope="col">DIPLOM</th>
                                                <th scope="col">ACTION</th>
                                                
                                                
                                                </tr>
                                            </thead> 
                              <?php
            
                                    $reqs = $bdd->prepare('SELECT * FROM objectifs WHERE idSalarie =?');
                                    $reqs->execute(array($ids));
                                    $i =1;
                                    while ($a = $reqs->fetch()) {
                                    ?>
                                    <tbody>
                                    <tr>
                                    <td><?=$i?></td>
                                    <td><?=$a['libelle']?></td>
                                    <td>  <a href="supprimer.php?action=supprO&idO=<?=$a['id']?>" onclick="return(confirm('Etes-vous sur de vouloir supprimer cette entree?'));"><i class="glyphicon glyphicon-trash"></i></a>
                                    </td>
                                    </tr>
                                    </tbody>
                                  
                             <?php $i ++;  }
                                                      
                                                ?>
                         </table>
          </div>
        </div>                
       
										
             </form>
                </div>
           
        </div> </div> </div> </div> </div> </div>
    </div>
    
<?php
if(isset($_GET['actionsalarie'])){
    echo '<script type="text/javascript">openCity(event,\'Paris\');</script>';
}

?>
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
<script src="js/onglet.js"></script>

<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>

<script>
	
        const onglets = document.querySelectorAll('.onglets');
const contenu = document.querySelectorAll('.contenu')
let index = 0;

onglets.forEach(onglet => {

    onglet.addEventListener('click', () => {

        if(onglet.classList.contains('active')){
            return;
        } else {
            onglet.classList.add('active');
        }

        index = onglet.getAttribute('data-anim');
        console.log(index);
        
        for(i = 0; i < onglets.length; i++) {

            if(onglets[i].getAttribute('data-anim') != index) {
                onglets[i].classList.remove('active');
            }

        }

        for(j = 0; j < contenu.length; j++){

            if(contenu[j].getAttribute('data-anim') == index) {
                contenu[j].classList.add('activeContenu');
            } else {
                contenu[j].classList.remove('activeContenu');
            }
            

        }


    })

})
   
		</script>


</body>
</html>
