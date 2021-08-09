<?php

include('header.php');
if (isset($_GET['id']))
{
    $id = trim($_GET['id']);

    if (trim($_GET['action']) == 'edit')
    {

        $req = $bdd->prepare('SELECT *  FROM salarie WHERE id = ?');
        $req->execute(array($id));


        while ($donnees = $req->fetch())
        {
            $idSalarie = $donnees['idSalarie'];
            $idCoef = $donnees['idCoef'];
           $libelle = $donnees['libelle'];
        }
    }
    else
    {
        $idSalarie = -1;
        $idCoef = -1;
       
        $libelle = "";
    }
}
else
{
    $idSalarie = -1;
        $idCoef = -1;
       
        $libelle = "";
}

$coef = $bdd->query('SELECT * FROM coefs ');
$salarie = $bdd->query('SELECT * FROM salarie ');


?>
<header>
</header>
<br>
<div class="container">
    <br><br>
    <div id="content-header">
        <div id="breadcrumb"> <a href="index.php" title="Retour" class="tip-bottom"><i class="icon-home"></i> Accueil</a> <a href="evalue.php" class="current">Entretient</a> <a href="#"><i class="icon-edit"></i>Saisie un nouveau entretient</a> </div>
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
                    <span class="icon"><i class="icon-th"></i>Ajouter entretient</span>

                </div>
                <div class="w3-container w3-white">
                    <div class="w3-row-padding">

          <form class="form-horizontal" method="post" action="actionAjoutEvalue.php" name="basic_validate" id="basic_validate">
                        
                                        <br/>  <br/>
                                        <label>Le salarie</label>
                                        <select name="idSalarie"  style="width:100%;" id="idSalarie" size="1" class="w3-select w3-border" size="1" required>
                                            <option>  </option>
                                            <?php
                                            while ($donnees = $salarie->fetch()) {
                                              if($donnees ['idSalarie'] == $idSalarie) 
                                               {
                                                    echo '<option value="' . $donnees['idSalarie'] . '" selected>' . $donnees['nom'] . '</option>';
                                                }else{
                                                    echo '<option value="' . $donnees['idSalarie'] . '">' . $donnees['nom'] . '</option>';
                                                }
                                            }
                                            ?>
                                             <input type="hidden" name="id" value = "<?php echo $id; ?>">
                                        </select>
                                        <br/> <br/>
                                            <table class="table table-boorded">
                                            <thead>
                                                <th>Critere d'Evalution</th>
                                                <th>Coefficients</th>
                                                <th>Notes Obtenues (de 1 a 5)</th>
                                                <th>Total</th>
                                            </thead>
                                           

                                            <tbody>
                                            <?php
                                            foreach($coef as  $vars){
                                                ?>
                                                <?php 
                                                echo '<tr>
                                                <input type="hidden" name="idCoef" value = "'.$vars['id'].'">

                                                <td  value="'.$vars['id'].'" >'.$vars['libelle'].'</td>
                                                <td name="idCoef" value="'.$vars['id'].'"">'.$vars['coef'].'</td>
                                                <input type="hidden" name="id" value = "<?php echo $id; ?>">
                                               <td> <input class="w3-input w3-border " style="width:100px; height:20px" type="number" name="libelle"></td>
                                                <input type="hidden" name="id" value = "<?php echo $id; ?>">
                                                  </tr>';
                                                  
                                                  
                                            }
                                            ?>
                                   
                                   
                        </tbody>
                        </table>      
                        <br>
                        <br>
                                       
                                <button name="valider" type="button"  class="w3-bar-item w3-button w3-light-grey precedent" style="width:48%;">Precedent</button>
                                <button name="valider" type="submit"  class="w3-bar-item w3-button w3-light-grey" style="width:48%;">Valider</button><br/><br/>
                                
          </form>                  
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
