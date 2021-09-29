<?php
include('config/connexion.php');
if (isset($_POST['valider']))
{
   
    $idSalarie = $_POST['idSalarie'];
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $fonctionActuelle = $_POST['fonctionActuelle'];
    $ancieneteFonc = $_POST['ancieneteFonc'];
    $situationFam = $_POST['situationFam'];
    $dateNaiss = $_POST['dateNaiss'];
    $telephone= $_POST['telephone'];
    $carburant= $_POST['carburant'];
    $commussion= $_POST['commussion'];
    $autres= $_POST['autres'];
    //$idDiplom= $_POST['idDiplom'];
    $idservice= $_POST['idservice'];
    $idParentel= $_POST['idParentel'];
    $idPO= $_POST['idPO'];
    $idRecrutement= $_POST['idRecrutement'];
    //$idlangue= $_POST['idlangue'];
    $contrat= $_POST['contrat'];
    $password= $_POST['password'];
    $profil= $_POST['profil'];
    $montant= $_POST['montant'];
    
    if ($idSalarie == -1)
    {
        $req = $bdd->prepare('SELECT count(idSalarie)  FROM salarie WHERE prenom = ?');
        $req->execute(array($prenom));
        $count = $req->fetchColumn();



        $req = $bdd->prepare('INSERT INTO salarie (prenom,nom,fonctionActuelle,situationFam,ancieneteFonc,dateNaiss,telephone,carburant,commussion,autres,
                idservice,idParentel, idRecrutement,contrat,pwd,profil,montant ) VALUES(:prenom,:nom,:fonctionActuelle ,:situationFam,:ancieneteFonc,  :dateNaiss,:telephone, :carburant,
                        :commussion, :autres, :idservice, :idParentel, :idRecrutement, :contrat, :password, :profil, :montant )');
        $req->execute(array(

            'prenom' => $prenom,
            'nom' => $nom,
           'fonctionActuelle' => $fonctionActuelle,
            'situationFam' => $situationFam,
            'ancieneteFonc' => $ancieneteFonc,
            'dateNaiss' => $dateNaiss,
            'telephone' => $telephone,
            'carburant' => $carburant,
            'commussion' => $commussion,
            'autres' => $autres,
           // 'idDiplom' => $idDiplom,
            'idservice' => $idservice,
            'idParentel' => $idParentel,
           // 'idPO' => $idPO,
            'idRecrutement' => $idRecrutement,
           // 'idlangue' => $idlangue,
            'contrat' => $contrat,
            'password' => md5($password),
            'profil' => $profil,
            'montant' => $montant
        ));
        $message =  'ok';
        header('location: ajoutSalarie.php?message='.$message.'&message1=Enregistrement effectuee avec succes');
        exit;
    }

    else
    {
        $req = $bdd->prepare('SELECT count(idSalarie)  FROM salarie WHERE nom = ?  AND idservice = ? AND idSalarie != ?');
        $req->execute(array($idSalarie,$nom,$idservice));
        $count = $req->fetchColumn();

        if ($count > 0)
        {
            header('location: salarie.php');
            exit;
        }



        $req = $bdd->prepare('UPDATE salarie SET prenom =:prenom, nom= :nom, fonctionActuelle = :fonctionActuelle 
                   ,situationFam = :situationFam,ancieneteFonc = :ancieneteFonc, dateNaiss = :dateNaiss,telephone= :telephone,  
                   carburant = :carburant, commussion = :commussion,autres = :autres, idDiplom =:idDiplom, idservice = :idservice, 
                   idParentel = :idParentel, idPO = :idPO,idRecrutement = :idRecrutement, idlangue = :idlangue, contrat = :contrat, password = :password, profil = :profil, montant = :montant WHERE idSalarie = :idSalarie');
        $req->execute(array(
            'prenom' => $prenom,
            'nom' => $nom,
            'fonctionActuelle' => $fonctionActuelle,
            'situationFam' => $situationFam,
            'ancieneteFonc' => $ancieneteFonc,
            'dateNaiss' => $dateNaiss,
            'telephone' => $telephone,
            'carburant' => $carburant,
            'commussion' => $commussion,
            'autres' => $autres,
            'idDiplom' => $idDiplom,
            'idservice' => $idservice,
            'idParentel' => $idParentel,
            'idPO' => $idPO,
            'idRecrutement' => $idRecrutement,
            'idlangue' => $idlangue,
            'idSalarie' => $idSalarie,
            'contrat' => $contrat,
            'password' => $password,
            'profil' => $profil,
            'montant' => $promontantfil
        ));


        header('location: ajoutSalarie.php?message=ok&message1=Mise a jour effectuee avec succes');
        exit;
    }

}
else
{
    header('location: salarie.php');
    exit;
}
?>