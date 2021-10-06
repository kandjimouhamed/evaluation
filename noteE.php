<?php
include('config/connexion.php');
if (isset($_POST['valider']))
{
    
    $idSalarie = $_POST['idSalarie'];
    $noteE = $_POST['noteE']; 
    
      foreach ( $noteE  as $ite ) {
          $item = $ite;
       
   // echo $item;
    if(empty($item)){
        header("location: index.php?error=Veuillez saisir tout les champs");
        exit;
    }
   
   elseif($item >=1  && $item <= 5  ){

    $req = $bdd->prepare('SELECT idEvaluer  FROM evaluer WHERE idSalarie = ?');
                $req->execute(array($idSalarie));
                $id =  $req->fetchColumn();
      foreach ( $noteE  as $ite ) {
          $item = $ite;
          $req = $bdd->prepare('UPDATE evaluer SET  noteE = :noteE  where idEvaluer ='.$id.' AND idSalarie ='.$idSalarie);
          $req->execute(array(
           'noteE' => $item
          ));
          
         // header('location: index.php?succes=Mise a jour effectuee avec succes');
          header('location:notes.php?idSalarie='.$idSalarie);
        
        $id = $id +1; 
  }

    }else{
        header("location: notes.php?error=Les notes sont entre (1 à 5)");
        exit;
    }
      
  }
}

