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
           $idLangue = $donnees['idlangue'];
           $contrat = $donnees['contrat'];

           

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
    <div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title">
                    <span class="icon"><i class="icon-th"></i>Ajouter Salarie</span>

                </div>
                <div class="w3-container w3-white">
                    <div class="w3-row-padding">

                        <form class="form-horizontal" method="post" action="action_AjoutSalarie.php" name="basic_validate" id="basic_validate">
                            <div class="page">
                            <div class="row">
                                <div class="col-md-6">
                                <label>Prenom</label>
                                <input type="text" class="w3-input w3-border" name="prenom" id="prenom" value = "<?php echo $prenom; ?> " required >
                                <input type="hidden" name="idSalarie" value = "<?php echo $idSalarie; ?>">
                              
                                <label>Nom</label>
                                <input type="text" class="w3-input w3-border" name="nom" id="nom" value = "<?php echo $nom; ?>" required>
                                <input type="hidden" name="idSalarie" value = "<?php echo $idSalarie; ?>">
                               
                                <label>Fonction Actuelle</label>
                                <input type="text" class="w3-input w3-border" name="fonctionActuelle" id="fonctionActuelle" value = "<?php echo $fonctionActuelle; ?>" required>
                                <input type="hidden" name="idSalarie" value = "<?php echo $idSalarie; ?>">

                          
                                <label>Ancienete dans la Fonction</label>
                                <input type="text" class="w3-input w3-border" name="ancieneteFonc" id="ancieneteFonc" value = "<?php echo $ancieneteFonc; ?>" required>
                                <input type="hidden" name="idSalarie" value = "<?php echo $idSalarie; ?>">
                               
                            <br>
                                <div >
                                <label>Situation Fammilialle</label>      
                                 <select name="situationFam" id="situationFam"  style="width:100%;" size="1" value = "<?php echo $situationFam; ?>"  class="mt-3 w3-input w3-border form-group" size="1" required>
                                           
                                            <option value="marie"> Marie(e) </option>
                                            <option value="calibataire"> Celibataire</option>
                                           
                                        </select>
                                        <input type="hidden" name="idSalarie" value = "<?php echo $idSalarie; ?>">
                               


                                </div>
                                </div>
                                
                                <div class="col-md-6">
                              <div>
                                <label>Telephone</label>
                                <br>      
                                 <select name="telephone" id="telephone"  style="width:100%;" size="1" value = "<?php echo $telephone; ?>"  class="w3-select w3-border" size="1" required>
                                          
                                            <option value="1"> OUI </option>
                                            <option value="0"> NON </option>
                                           
                                        </select>
                                        <input type="hidden" name="idSalarie" value = "<?php echo $idSalarie; ?>">
                                        </div>
                                        <br>
                         <div>
                                <label>carburant</label>      
                                 <select name="carburant" id="carburant"  style="width:100%; height:100px;" size="1" value = "<?php echo $carburant; ?>"  class="mt-3 w3-select w3-border" size="1" required>
                                          
                                            <option value="1"> OUI </option>
                                            <option value="0"> NON </option>
                                           
                                        </select>
                                        <input type="hidden" name="idSalarie" value = "<?php echo $idSalarie; ?>">
                                        </div>
                               <br>
                            
                                        
                                        <div>
                                <label>commussion</label>      
                                 <select name="commussion" id="commussion"  style="width:100%;" size="1" value = "<?php echo $commussion; ?>"  class="w3-select w3-border" size="1" required>
                                           
                                               <option value="1"> OUI </option>
                                            <option value="0"> NON </option>
                                           
                                        </select>
                                        <input type="hidden" name="idSalarie" value = "<?php echo $idSalarie; ?>">
                                     </div>
                                <br/>
                                
                                <label>vehicule</label>      
                                 <select name="vehicule" id="vehicule"  style="width:100%;" size="1" value = "<?php echo $vehicule; ?>"  class="w3-select w3-border" size="1" required>
                                       
                                            <option value="1"> OUI </option>
                                            <option value="0"> NON </option>
                                           
                                        </select>
                                        <input type="hidden" name="idSalarie" value = "<?php echo $idSalarie; ?>">
                                <br/>
                                <label>Autres</label>
                                <input type="text" class="w3-input w3-border" name="autres" id="autres" value = "<?php echo $autres; ?>" required>
                                <input type="hidden" name="idSalarie" value = "<?php echo $idSalarie; ?>">
                                <br/>
                                </div>
                            </div>

                            <div class="row">
                        
                                <div class="col-md-6">
                                    <label>Date de Naissance</label>
                                    <input type="date" class="w3-input w3-border" name="dateNaiss" id="dateNaiss" value = "<?php echo $dateNaiss; ?>" required>
                                    <input type="hidden" name="idSalarie" value = "<?php echo $idSalarie; ?>">
                                    <br/>

                                </div>
                                <div class="col-md-6">
                                        <label>type de Contrat</label>
                                        <select name="contrat" id="contrat"  style="width:100%;" size="1"  class="w3-select w3-border" size="1"  value = "<?php echo $contrat; ?>" required>
                                         
                                            <option value="cdd"> C D D </option>
                                            <option value="cdi"> C D I </option>
                                           
                                        </select>
                                         
                                </div>
                            </div>
                                <button class="w12-bar-item w3-button w3-light-grey suivant" style="width:100%;" type="button">Suivant</button>
                            </div>

                            <div class="page">
                                <div class="row">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-8">
                                        <label>Nom du diplom</label>
                                        <select name="idDiplom" id="idDiplom" style="width:100%;" size="1"  class="w3-select w3-border" size="1" required>
                                            <option>  </option>
                                            <?php
                                            while ($donnees = $diplom->fetch()) {
                                                {
                                                    echo '<option value="' . $donnees['idDiplom'] . '" selected>' . $donnees['libelle'] . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                        <br/>  <br/>

                                        <label>Nom du Service</label>
                                        <select name="idservice"  style="width:100%;" id="idservice" size="1" class="w3-select w3-border" size="1" required>
                                            <option>  </option>
                                            <?php
                                            while ($donnees = $service->fetch()) {
                                              if($donnees ['ID'] == $idservice) 
                                               {
                                                    echo '<option value="' . $donnees['ID'] . '" selected>' . $donnees['NOM_SERVICE'] . '</option>';
                                                }else{
                                                    echo '<option value="' . $donnees['ID'] . '">' . $donnees['NOM_SERVICE'] . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                        <br/> <br/>
                                        <label>le Parentelle</label>

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

                                        <br/> <br/>
                                        <label>Poste Ocupee</label>
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
                                        <br/> <br/>

                                        <label>Type de recrutment</label>
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
                                        <br/>  <br/>


                                        <div class="form-group">
                                        <label>Langue</label>
                                        <select name="idlangue" id="idlangue"  style="width:100%;" size="1"  class="w3-select w3-border" size="1" required>
                                            <option>  </option>
                                            <?php
                                            while ($donnees = $langue->fetch()) {
                                                if($donnees ['idLangue'] == $idLangue) 
                                                {
                                                    echo '<option value="' . $donnees['idLangue'] . '" selected>' . $donnees['libelle'] . '</option>';
                                                }
                                                else
                                                {
                                                    echo '<option value="' . $donnees['idLangue'] . '">' . $donnees['libelle'] . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                         </div>
                                    </div>
                                    <div class="col-md-2"></div>

                                </div>
                                <button name="valider" type="button"  class="w3-bar-item w3-button w3-light-grey precedent" style="width:48%;">Precedent</button>
                                <button name="valider" type="submit"  class="w3-bar-item w3-button w3-light-grey" style="width:48%;">Valider</button><br/><br/>
                                
                            </div>
                    </div>



                            <!--button name="" type="submit"  class="w3-bar-item w3-button w3-light-grey" style="width:49%;" name="retour" value="Retour" onclick="location.href='commandempr.php'" >Annuler</button-->

                        </form>
                    </div>
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
