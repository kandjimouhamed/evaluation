<?php
include('header.php');

if (isset($_GET['id']))
{
    $id = trim($_GET['id']);

    if (trim($_GET['action']) == 'edit')
    {

        $req = $bdd->prepare('SELECT *  FROM coefs WHERE id = ?');
        $req->execute(array($id));


        while ($donnees = $req->fetch())
        {
            $libelle = $donnees['libelle'];
          



        }
    }
    else
    {
        $id= -1;
        $libelle = "";
        
    }
}
else
{
    $id= -1;
    $libelle = "";
}

$salarie = $bdd->query('SELECT * FROM salarie ORDER BY nom ASC');
$libelle = $bdd->query('SELECT * FROM coefs ');

?>

<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="index.php" title="Retour" class="tip-bottom"><i class="icon-home"></i> Accueil</a> <a href="critere.php">Critere d'Evaluation</a> <a href="#" class="current"><i class="icon-edit"></i>Saisie Critere d'Evaluation </a> </div>
        <!--h1>Gestion des langues</h1-->
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
            //
    <div class="container-fluid">

        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title">
                        <span class="icon"><i class="icon-th"></i>Ajouter Critere d'Evaluation</span>

                    </div>
                    <div class="w3-container w3-white"style="width:100%; max-width: 600px; margin:0 auto;" >
                        <div class="w3-row-padding" >   
                        <form method="post" id="repeater_form" class="form-horizontal" name="basic_validate" id="basic_validate">

                        <div class="items" data-group="programming_languages">
                                <div class="item-content">
                                    <div class="form-group">
                                        <div class="row">
                                        <div class="col-md-9">
                                           <label>Selectionner une Critere d'Evaluation</label>
                                                <select class="form-control" data-skip-name="true" name="idSalarie"style="width:100%;" id="idSalarie" size="1" class="w3-select w3-border" size="1" required>
                                            <option>  </option>
                                            <?php
                                            while ($salaries = $salarie->fetch()) {
                                              if($salaries ['idSalarie'] == $idSalarie) 
                                               { 
                                                    echo '<option value="' . $salaries['idSalarie'] . '" selected>' . $salaries['prenom'] . '' . $salaries['nom'] . '</option>';
                                                }else{
                                                    echo '<option value="' . $salaries['idSalarie'] . '">' . $salaries['prenom'] . ' ' . $salaries['nom'] . '</option>';
                                                }
                                            }
                                            ?>
                                           
                                           </select>
                                              
                                            </div>
                                            
                                          </div>
                                    </div>
                                </div>
                            </div>
                        <div id="repeater">
                           
                            <div class="repeater-heading" align="right" style="margin-top: -39px;">
                                <button type="button" class="btn btn-primary repeater-add-btn">Add</button>
                            </div>
                            <div class="clearfix"></div>
                            <div class="items" data-group="programming_languages">
                                <div class="item-content">
                                    <div class="form-group">
                                        <div class="row">
                                        <div class="col-md-9">
                                           <label>Selectionner une Critere d'Evaluation</label>
                                                <select class="form-control" data-skip-name="true" data-name="libelle[]"style="width:100%;" id="idSalarie" size="1" class="w3-select w3-border" size="1" required>
                                            <option>  </option>
                                            <?php
                                            while ($libelles = $libelle->fetch()) {
                                              if($libelles ['id'] == $id) 
                                               { 
                                                    echo '<option value="' . $libelles['id'] . '" selected>' . $libelles['libelle'] . '</option>';
                                                }else{
                                                    echo '<option value="' . $libelles['id'] . '">' . $libelles['libelle'] . ' </option>';
                                                }
                                            }
                                            ?>
                                           
                                           </select>
                                                </select>
                                            </div>
                                            <div class="col-md-3" style="margin-top:24px;" align="center">
                                                <button id="remove-btn" class="btn btn-danger" onclick="$(this).parents('.items').remove()">Remove</button>
                                            </div>
                                          </div>
                                    </div>
                                </div>
                            </div>
                        </div>
      
                            <div class="clearfix"></div>
                        <div class="form-group" align="center">
                       <br /><br />
                            <input type="submit" name="insert" class="btn btn-success" value="insert" />
                        </div>
                </form>
                        </div>
                    </div>
                </div>
            </div></div>
        </div></div></div>

 
    
   

<div class="row-fluid">
    <div id="footer" class="span12"> 2019 &copy;  <a href="#">CCBM TECHNOLOGIES ET SOLUTIONS</a> </div>
</div>
<script src="js/jquery.min.js"></script>
<script src="js/jquery.ui.custom.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.uniform.js"></script>
<!--script src="js/select2.min.js"></script-->
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/maruti.js"></script>
<script src="js/maruti.tables.js"></script>
<script src="js/maruti.form_validation.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
<script src="repeater.js" type="text/javascript"></script>
<script>
    $(document).ready(function(){

        $("#repeater").createRepeater();

        $('#repeater_form').on('submit', function(event){
            event.preventDefault();
            $.ajax({
                url:"actionAjoutLangue.php",
                method:"POST",
                data:$(this).serialize(),
                success:function(data)
                {
                    $('#repeater_form')[0].reset();
                    $("#repeater").createRepeater();
                    $('#success_result').html(data);
                    /*setInterval(function(){
                        location.reload();
                    }, 3000);*/
                }
            });
        });

    });
        
    </script>
    
   
</body>
</html>

