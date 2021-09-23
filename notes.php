
<?php
include('header.php');

    $idSalarie = trim($_GET['idSalarie']);  
      $req = $bdd->prepare('SELECT * FROM evaluer INNER JOIN coefs ON evaluer.idCoef = coefs.id WHERE   idSalarie = ?');
        $req->execute(array($idSalarie));
        $salarie = $bdd->prepare('SELECT * FROM salarie WHERE idSalarie = ?');
        $salarie->execute(array($idSalarie));
?>

<div id="content">
  
  <div class="container-fluid w3-white" style="font-size:12px;">

    <div class="row-fluid">
      <div class="span12">
      <div class="container ">
        
       
               
                <div class="container-fluid" style="margin-top: 0;">
                <div class="row-fluid">
                    <div class="span12">
                        <div class="widget-box">
                            <div class="widget-title">
                              <?php
                              while ($reqs = $salarie->fetch()){ ?>
                             <span class="icon"><i class="icon-th"></i><?=$reqs['prenom'].'  ' .$reqs['nom']?></span>
                             <?php
                              }
                              ?>

                            </div>
                            <div class="w3-container w3-white">
                                <div class="w3-row-padding">
                <br>
                      <div>
                      <form action="noteE.php" method="post">
                      <?php if (isset($_GET['error'])){?>
                        <div class="alert alert-danger" role="alert">
                        <?php echo $_GET['error'];?>
                      </div>
                     <?php }?>  
                     <?php if (isset($_GET['succes'])){?>
                        <div class="alert alert-success" role="alert">
                        <?php echo $_GET['succes'];?>
                      </div>
                     <?php }?> 
                      
      <?php
      while ($donnees = $req->fetch())
      {  
        
           ?>
            
           <div class="row">
            
             <div class="col-md-11">
                <div class="row">
                  <div class="col-md-7"> <?=$donnees['libelle']?> <br><br></div>
                  <div class="col-md-5">
                    <div class="row">
                      
                       Note d'Evalué&nbsp;&nbsp; <input type="number" disabled name="note[]" maxlength="5" style="width: 15%;"  value = "<?php echo $donnees['note']; ?>"   class="w1-input w3-border">
                       &nbsp;&nbsp; &nbsp;  Note Evaluateur&nbsp;&nbsp; <input type="number" name="noteE[]" maxlength="5" style="width: 15%;"  value = "<?php echo $donnees['noteE']; ?>"   class="w1-input w3-border">
                  </div>
                </div>
                  </div>
                </div>
             </div>
           
           </div>
         
          
       <?php }
     ?>
      <input type="hidden" name="idSalarie" value = "<?php echo $idSalarie; ?>">

      <div class="row">
           <div class="col-md-3"></div>
           <div class="col-md-6">
           <button name="valider" type="submit"  id="submit" value="submit " class="btn btn-success" style="width:100%;">Valider</button><br/><br/>

           </div>
           </div>
           </form>
                      </div></div></div></div></div></div></div></div></div></div></div></div>
     
      </div>
    </div>
  </div>
</div>
<div class="row-fluid">
  <div id="footer" class="span12"> 2019 &copy;  <a href="#" style="color: #fff;">CCBM TECHNOLOGIES ET SOLUTIONS</a> </div>
</div>
	<script src="js/jquery.min.js"></script> 
<script src="js/jquery.ui.custom.js"></script> 
<script src="js/bootstrap.min.js"></script> 
<script src="js/jquery.uniform.js"></script> 

<!--script src="js/jquery.dataTables.min.js"></script--> 
<script src="js/maruti.js"></script> 
<script src="js/maruti.tables.js"></script>
<script src="js/jquery.validate.js"></script>
<script src="js/maruti.form_validation.js"></script>
<script src="js/ajax_xhr.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/autofill/2.3.5/js/dataTables.autoFill.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/3.3.1/js/dataTables.fixedColumns.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/fixedheader/3.1.7/js/dataTables.fixedHeader.js"></script>
<!--script type="text/javascript" src="jquery.dataTables.js"></script-->



<script>
  var controls = document.querySelectorAll('.form-control');

for (var i = 0; i < controls.length; i++) {
	controls[i].onchange = function() {
		document.querySelector('[type="submit"]').disabled = false;
	};
}
</script>




</body>
</html>
