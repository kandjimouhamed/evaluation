<?php
function getPrenomNom($idUser,$bdd)

{
    $user = "";
    
    $req = $bdd->prepare('SELECT * FROM intervenant WHERE codeintervenant = ?');
    $req->execute(array($idUser));
   while ($donnees = $req->fetch())
   {
    $user = $donnees['prenom'].' '.$donnees['nom'];
   }
    
    return $user;
}

function getDirection($idDirection,$bdd)

{
    $req = $bdd->prepare('SELECT directionnom  FROM direction WHERE directioncode = ?');
    $req->execute(array($idDirection));
    
    return $req->fetchColumn();
}


function getFiliale($idDirection,$bdd)

{
    $req = $bdd->prepare('SELECT filialecode  FROM direction WHERE directioncode = ?');
    $req->execute(array($idDirection));
    $idFiliale = $req->fetchColumn();
    
    $req = $bdd->prepare('SELECT filialenom  FROM filiale WHERE filialecode = ?');
    $req->execute(array($idFiliale));
    
    return $req->fetchColumn();
}

function getIdFiliale($idDirection,$bdd)

{
    $req = $bdd->prepare('SELECT filialecode  FROM direction WHERE directioncode = ?');
    $req->execute(array($idDirection));
    $idFiliale = $req->fetchColumn();
   
    return $idFiliale;
}


function getClient($idClient,$bdd)

{
    $client = "";
    
    $req = $bdd->prepare('SELECT * FROM clients WHERE IDCLIENT = ?');
    $req->execute(array($idClient));
   while ($donnees = $req->fetch())
   {
    $client = $donnees['prenom'].' '.$donnees['nom'];
   }
    
    return $client;
}

function getFournisseur($idFournisseur,$bdd)

{
    $fournisseur = "";
    
    $req = $bdd->prepare('SELECT * FROM fournisseurs WHERE ID = ?');
    $req->execute(array($idFournisseur));
   while ($donnees = $req->fetch())
   {
    $fournisseur = $donnees['prenom'].' '.$donnees['nom'];
   }
    
    return $fournisseur;
}

function getVehicule($idVehicule,$bdd)

{
    $req = $bdd->prepare('SELECT immatriculation  FROM vehicules WHERE IDVEHICULE = ?');
    $req->execute(array($idVehicule));
    
    return $req->fetchColumn();
}


function getService($id,$bdd)
{
    $req = $bdd->prepare('SELECT NOM_SERVICE  FROM service WHERE ID = ?');
    $req->execute(array($id));
    
    return $req->fetchColumn();
}
function getIntervenant($id,$bdd)
{
    $req = $bdd->prepare('SELECT utilisateur  FROM intervenant WHERE codeintervenant = ?');
    $req->execute(array($id));
    
    return $req->fetchColumn();
}

function getEtape($id,$bdd)
{
    $req = $bdd->prepare('SELECT libelle FROM etape WHERE ID = ?');
    $req->execute(array($id));
    
    return $req->fetchColumn();
}

function getEtat($id,$bdd)
{
    $req = $bdd->prepare('SELECT libelle FROM etat WHERE ID = ?');
    $req->execute(array($id));
    
    return $req->fetchColumn();
}

function getLibelleAction($id,$bdd)
{
    $req = $bdd->prepare('SELECT libelle FROM libelleaction WHERE ID = ?');
    $req->execute(array($id));
    
    return $req->fetchColumn();
}

function getEtatCommande($id,$bdd)
{
    $req = $bdd->prepare('SELECT libelle FROM etatcommande WHERE ID = ?');
    $req->execute(array($id));
    
    return $req->fetchColumn();
}

function getExpeditionCommande($id,$bdd)
{
    $req = $bdd->prepare('SELECT libelle FROM expeditioncommande WHERE ID = ?');
    $req->execute(array($id));
    
    return $req->fetchColumn();
}

function TotalAction($id,$bdd)
{
    $req = $bdd->prepare('SELECT count(actioncode) FROM actions WHERE dossiercode = ?');
    $req->execute(array($id));
    
    return $req->fetchColumn();
}

function TotalRessource($id,$bdd)
{
    $req = $bdd->prepare('SELECT count(ressourcecode) FROM ressource WHERE dossiercode = ?');
    $req->execute(array($id));
    
    return $req->fetchColumn();
}

function getORCMD($idRessource,$bdd)
{
    $req = $bdd->prepare('SELECT * FROM dossier WHERE dossiercode IN (SELECT dossiercode FROM ressource WHERE ressourcecode = ?)');
    $req->execute(array($idRessource));
    //$req->debugDumpParams();
    $tab_or = array();
    while ($donnees = $req->fetch())
    {
	 $nom = $donnees['nom'];	
	 $tab_or[] = $nom;
	 }
     
    
    return $tab_or;
}



/* function getAdjascentKey( $key, $hash = array(), $increment ) {
    $keys = array_keys( $hash );
    $found_index = array_search( $key, $keys );
    if ( $found_index === false ) {
        return false;
    }
    $newindex = $found_index+$increment;
    // returns false if no result found
    return ($newindex >= 0 && $newindex < sizeof($hash)) ? $keys[$newindex] : false;
} */

function getCircuit($id,$bdd)
{
    $req = $bdd->prepare('SELECT NOM_CIRCUIT FROM circuit WHERE ID = ?');
    $req->execute(array($id));
    
    return $req->fetchColumn();
}

function getIdCircuit($idDossier,$bdd)
{
    $req = $bdd->prepare('SELECT IDCIRCUIT FROM dossier WHERE dossiercode = ?');
    $req->execute(array($idDossier));
    
    return $req->fetchColumn();
}

function getModele($id,$bdd)
{
    $req = $bdd->prepare('SELECT libelle FROM modeles WHERE IDMODELE = ?');
    $req->execute(array($id));
    
    return $req->fetchColumn();
}

function getMarque($idModele,$bdd)

{
    $req = $bdd->prepare('SELECT IDMARQUE  FROM modeles WHERE IDMODELE = ?');
    $req->execute(array($idModele));
    $idModele = $req->fetchColumn();
    
    $req = $bdd->prepare('SELECT nom  FROM marques WHERE IDMARQUE = ?');
    $req->execute(array($idModele));
    
    return $req->fetchColumn();
}

function getMarque2($idMarque,$bdd)

{
    $req = $bdd->prepare('SELECT nom  FROM marques WHERE IDMARQUE = ?');
    $req->execute(array($idMarque));
    
    return $req->fetchColumn();
}

function getIntervenantActuel($idDossier,$bdd)
{
   
    $req = $bdd->prepare('SELECT IDINTERVENANT  FROM dossier_etape WHERE  IDDOSSIER = ? AND DECISION = 0');
    $req->execute(array($idDossier));
    
    $idIntervenant =  $req->fetchColumn();
    
    $req = $bdd->prepare('SELECT utilisateur  FROM intervenant WHERE codeintervenant = ?');
    $req->execute(array($idIntervenant));
    
    return $req->fetchColumn();
}

function getIdIntervenantActuel($idDossier,$bdd)
{
   
    $req = $bdd->prepare('SELECT IDINTERVENANT  FROM dossier_etape WHERE  IDDOSSIER = ? AND DECISION = 0');
    $req->execute(array($idDossier));
   
    return $req->fetchColumn();
}

function getIdEtapeActuel($idDossier,$bdd)
{
   
    $req = $bdd->prepare('SELECT IDETAPE FROM dossier_etape WHERE  IDDOSSIER = ? AND DECISION = 0');
    $req->execute(array($idDossier));
    
    return $req->fetchColumn();
}

function getEtapeActuel($idDossier,$bdd)
{
   
    $req = $bdd->prepare('SELECT IDETAPE FROM dossier_etape WHERE  IDDOSSIER = ? AND DECISION = 0');
    $req->execute(array($idDossier));
    
    $idEtape =  $req->fetchColumn();
    
    $req = $bdd->prepare('SELECT libelle  FROM etape WHERE ID = ?');
    $req->execute(array($idEtape));
    
    return $req->fetchColumn();
}


function dateDiff($date1, $date2){
    $diff = abs($date1 - $date2); // abs pour avoir la valeur absolute, ainsi �viter d'avoir une diff�rence n�gative
    $retour = array();
    
    $tmp = $diff;
    $retour['second'] = $tmp % 60;
    
    $tmp = floor( ($tmp - $retour['second']) /60 );
    $retour['minute'] = $tmp % 60;
    
    $tmp = floor( ($tmp - $retour['minute'])/60 );
    $retour['hour'] = $tmp % 24;
    
    $tmp = floor( ($tmp - $retour['hour'])  /24 );
    $retour['day'] = $tmp;
    
    return $retour;
}

function getFiliale2($idFiliale,$bdd)

{
    $req = $bdd->prepare('SELECT filialenom  FROM filiale WHERE filialecode = ?');
    $req->execute(array($idFiliale));
    
    return $req->fetchColumn();
}


function getCMDAchat($IDCMDMPR,$bdd)

{
    $req = $bdd->prepare('SELECT count(*) FROM CMD_PIECE_MPR WHERE IDCMDMPR = ?');
    $req->execute(array($IDCMDMPR));
    
    $count = $req->fetchColumn();
    if ($count == 0) {$numero_cmd = "";}
    else
    {
	 $req = $bdd->prepare('SELECT NUMERO_CMD FROM CMD_PIECE_MPR, commandeachat WHERE commandeachat.ID = CMD_PIECE_MPR.IDCMD AND IDCMDMPR = ?');
     $req->execute(array($IDCMDMPR));	
     $numero_cmd =  $req->fetchColumn();
	}
  return $numero_cmd;
}

function lister_fichiers($rep)
{
    if(is_dir($rep))
    {
        if($iteration = opendir($rep))
        {
            while(($fichier = readdir($iteration)) !== false)
            {
                if($fichier != "." && $fichier != ".." && $fichier != "Thumbs.db")
                {
                    echo '<a href="'.$rep.$fichier.'" target="_blank" >'.$fichier.'</a><br />'."\n";
                }
            }
            closedir($iteration);
        }
    }
} 

function getIdServiceFromEtape($idEtape,$bdd)

{
    $req = $bdd->prepare('SELECT IDSERVICE  FROM etape WHERE ID = ?');
    $req->execute(array($idEtape));
    
    return $req->fetchColumn();
}

function getIdEtapeFromService($idService,$idCircuit,$bdd)

{
    $req = $bdd->prepare('SELECT ID  FROM etape WHERE IDSERVICE = ? AND IDCIRCUIT = ?');
    $req->execute(array($idService,$idCircuit));
    
    return $req->fetchColumn();
}

function countAll($table,$bdd){
    $dbh = dbConnect();
    $sql = "select * from `$table`";
    
    $stmt = $bdd->prepare($sql);
    try { $stmt->execute();}
    catch(PDOException $e){echo $e->getMessage();}
    
    return $stmt->rowCount();
}


function getDernierEtape($idCircuit,$bdd)
{
        $req = $bdd->prepare('SELECT MAX(position)  FROM etape WHERE IDCIRCUIT = ?');
        $req->execute(array($idCircuit));
        return $req->fetchColumn();
}

function getPiece($idPiece,$bdd)
{
   
    $req = $bdd->prepare('SELECT designation FROM piece WHERE  IDPIECE = ?');
    $req->execute(array($idPiece));
    
    return $req->fetchColumn();
}

function getRefPiece($idPiece,$bdd)
{
   
    $req = $bdd->prepare('SELECT reference FROM piece WHERE  IDPIECE = ?');
    $req->execute(array($idPiece));
    
    return $req->fetchColumn();
}


function RepEfface($dir)
    {
    $handle = opendir($dir);
    while($elem = readdir($handle)) 
//ce while vide tous les repertoire et sous rep
    {
        if(is_dir($dir.'/'.$elem) && substr($elem, -2, 2) !== '..' && substr(
$elem, -1, 1) !== '.') //si c'est un repertoire
        {
            RepEfface($dir.'/'.$elem);
        }
        else
        {
            if(substr($elem, -2, 2) !== '..' && substr($elem, -1, 1) !== '.')
            {
                unlink($dir.'/'.$elem);
            }
        }
            
    }
    
    $handle = opendir($dir);
    while($elem = readdir($handle)) //ce while efface tous les dossiers
    {
        if(is_dir($dir.'/'.$elem) && substr($elem, -2, 2) !== '..' && substr(
$elem, -1, 1) !== '.') //si c'est un repertoire
        {
            RepEfface($dir.'/'.$elem);
            rmdir($dir.'/'.$elem);
        }    
    
    }
    rmdir($dir); //ce rmdir eface le repertoire principale
   }
?>
