/**
 * Lister les départements d'une région avec un objet
 * XMLHTTPRequest.
 */
/* Création de la variable globale qui contiendra l'objet XHR */
var requete = null;
/**
 * Fonction privée qui va créer un objet XHR.
 * Cette fonction initialisera la valeur dans la variable globale définie
 * ci-dessus.
 */
function creerRequete()
{
    try
    {
        /* On tente de créer un objet XmlHTTPRequest */
        requete = new XMLHttpRequest();
    }
    catch (microsoft)
    {
        /* Microsoft utilisant une autre technique, on essays de créer un objet ActiveX */
        try
        {
            requete = new ActiveXObject('Msxml2.XMLHTTP');
        }
        catch(autremicrosoft)
        {
            /* La première méthode a échoué, on en teste une seconde */
            try
            {
                requete = new ActiveXObject('Microsoft.XMLHTTP');
            }
            catch(echec)
            {
                /* À ce stade, aucune méthode ne fonctionne... mettez donc votre navigateur à jour ;) */
                requete = null;
            }
        }
    }
    if(requete == null)
    {
        alert('Impossible de créer l\'objet requête,\nVotre navigateur ne semble pas supporter les object XMLHttpRequest.');
    }
}
/**
 * Fonction privée qui va mettre à jour l'affichage de la page.
 */
function actualiserModeles()
{
    var listeModele = requete.responseText;
    var blocListe = document.getElementById('blocModeles');
    blocListe.innerHTML = listeModele;
}

/**
 * Fonction publique appelée par la page affichée.
 * Cette fonction va initialiser la création de l'objet XHR puis appeler
 * le code serveur afin de récupérer les données à modifier dans la page.
 */
function getModeles(idr)
{
    /* Si il n'y a pas d'identifiant de région, on fait disparaître la seconde liste au cas où elle serait affichée */
    if(idr == 'vide')
    {
        document.getElementById('blocModeles').innerHTML = '';
    }
    else
    {
        /* À cet endroit précis, on peut faire apparaître un message d'attente */
        var blocListe = document.getElementById('blocModeles');
        blocListe.innerHTML = "Traitement en cours, veuillez patienter...";
        /* On crée l'objet XHR */
        creerRequete();
        /* Définition du fichier de traitement */
        var url = './listeModeles.php?idr='+ idr;
        /* Envoi de la requête à la page de traitement */
        requete.open('GET', url, true);
        /* On surveille le changement d'état de la requête qui va passer successivement de 1 à 4 */
        requete.onreadystatechange = function()
        {
            /* Lorsque l'état est à 4 */
            if(requete.readyState == 4)
            {
                /* Si on a un statut à 200 */
                if(requete.status == 200)
                {
                    /* Mise à jour de l'affichage, on appelle la fonction apropriée */
                    actualiserModeles();
                }
            }
        };
        requete.send(null);
    }
}


function actualiserDirections()
{
    var listeDirections = requete.responseText;
    var blocListe = document.getElementById('blocDirections');
    blocListe.innerHTML = listeDirections;
}

/**
 * Fonction publique appelée par la page affichée.
 * Cette fonction va initialiser la création de l'objet XHR puis appeler
 * le code serveur afin de récupérer les données à modifier dans la page.
 */
function getDirections(idr)
{
	//alert(idr);
    /* Si il n'y a pas d'identifiant de région, on fait disparaître la seconde liste au cas où elle serait affichée */
    if(idr == 'vide')
    {
        document.getElementById('blocDirections').innerHTML = '';
    }
    else
    {
        /* À cet endroit précis, on peut faire apparaître un message d'attente */
        var blocListe = document.getElementById('blocDirections');
        blocListe.innerHTML = "Traitement en cours, veuillez patienter...";
        /* On crée l'objet XHR */
        creerRequete();
        /* Définition du fichier de traitement */
        var url = './listeDirections.php?idr='+ idr;
        /* Envoi de la requête à la page de traitement */
        requete.open('GET', url, true);
        /* On surveille le changement d'état de la requête qui va passer successivement de 1 à 4 */
        requete.onreadystatechange = function()
        {
            /* Lorsque l'état est à 4 */
            if(requete.readyState == 4)
            {
                /* Si on a un statut à 200 */
                if(requete.status == 200)
                {
                    /* Mise à jour de l'affichage, on appelle la fonction apropriée */
                	actualiserDirections();
                }
            }
        };
        requete.send(null);
    }
}

//Debut getCircuit
function actualiserCircuits()
{
    var listeCircuits = requete.responseText;
    var blocListe = document.getElementById('blocCircuits');
    blocListe.innerHTML = listeCircuits;
}

/**
 * Fonction publique appelée par la page affichée.
 * Cette fonction va initialiser la création de l'objet XHR puis appeler
 * le code serveur afin de récupérer les données à modifier dans la page.
 */
function getCircuits(idr)
{
	//alert(idr);
    /* Si il n'y a pas d'identifiant de région, on fait disparaître la seconde liste au cas où elle serait affichée */
    if(idr == 'vide')
    {
        document.getElementById('blocCircuits').innerHTML = '';
    }
    else
    {
        /* À cet endroit précis, on peut faire apparaître un message d'attente */
        var blocListe = document.getElementById('blocCircuits');
        blocListe.innerHTML = "Traitement en cours, veuillez patienter...";
        /* On crée l'objet XHR */
        creerRequete();
        /* Définition du fichier de traitement */
        var url = './listeCircuits.php?idr='+ idr;
        /* Envoi de la requête à la page de traitement */
        requete.open('GET', url, true);
        /* On surveille le changement d'état de la requête qui va passer successivement de 1 à 4 */
        requete.onreadystatechange = function()
        {
            /* Lorsque l'état est à 4 */
            if(requete.readyState == 4)
            {
                /* Si on a un statut à 200 */
                if(requete.status == 200)
                {
                    /* Mise à jour de l'affichage, on appelle la fonction apropriée */
                	actualiserCircuits();
                }
            }
        };
        requete.send(null);
    }
}
//Fin getCircuit


function actualiserClient()
{
    var client = requete.responseText;
    var blocListe = document.getElementById('blocClient');
    blocListe.innerHTML = client;
}

/**
 * Fonction publique appelée par la page affichée.
 * Cette fonction va initialiser la création de l'objet XHR puis appeler
 * le code serveur afin de récupérer les données à modifier dans la page.
 */
function getClient(idr)
{
	//alert(idr);
    /* Si il n'y a pas d'identifiant de région, on fait disparaître la seconde liste au cas où elle serait affichée */
    if(idr == 'vide')
    {
        document.getElementById('blocClient').innerHTML = '';
    }
    else
    {
        /* À cet endroit précis, on peut faire apparaître un message d'attente */
        var blocListe = document.getElementById('blocClient');
        blocListe.innerHTML = "Traitement en cours, veuillez patienter...";
        /* On crée l'objet XHR */
        creerRequete();
        /* Définition du fichier de traitement */
        var url = './ChargerClient.php?idr='+ idr;
        /* Envoi de la requête à la page de traitement */
        requete.open('GET', url, true);
        /* On surveille le changement d'état de la requête qui va passer successivement de 1 à 4 */
        requete.onreadystatechange = function()
        {
            /* Lorsque l'état est à 4 */
            if(requete.readyState == 4)
            {
                /* Si on a un statut à 200 */
                if(requete.status == 200)
                {
                    /* Mise à jour de l'affichage, on appelle la fonction apropriée */
                	actualiserClient();
                }
            }
        };
        requete.send(null);
    }
}


function actualiserVehicule()
{
    var vehicule = requete.responseText;
    var blocListe = document.getElementById('blocVehicule');
    blocListe.innerHTML = vehicule;
}

/**
 * Fonction publique appelée par la page affichée.
 * Cette fonction va initialiser la création de l'objet XHR puis appeler
 * le code serveur afin de récupérer les données à modifier dans la page.
 */
function getVehicule(idr)
{
	//alert(idr);
    /* Si il n'y a pas d'identifiant de région, on fait disparaître la seconde liste au cas où elle serait affichée */
    if(idr == 'vide')
    {
        document.getElementById('blocVehicule').innerHTML = '';
    }
    else
    {
        /* À cet endroit précis, on peut faire apparaître un message d'attente */
        var blocListe = document.getElementById('blocVehicule');
        blocListe.innerHTML = "Traitement en cours, veuillez patienter...";
        /* On crée l'objet XHR */
        creerRequete();
        /* Définition du fichier de traitement */
        var url = './ChargerVehicule.php?idr='+ idr;
        /* Envoi de la requête à la page de traitement */
        requete.open('GET', url, true);
        /* On surveille le changement d'état de la requête qui va passer successivement de 1 à 4 */
        requete.onreadystatechange = function()
        {
            /* Lorsque l'état est à 4 */
            if(requete.readyState == 4)
            {
                /* Si on a un statut à 200 */
                if(requete.status == 200)
                {
                    /* Mise à jour de l'affichage, on appelle la fonction apropriée */
                	actualiserVehicule();
                }
            }
        };
        requete.send(null);
    }
}

function actualiserNomCircuit()
{
    var nomCircuit = requete.responseText;
    var blocListe = document.getElementById('nomCircuit');
    blocListe.innerHTML = nomCircuit;
}

/**
 * Fonction publique appelée par la page affichée.
 * Cette fonction va initialiser la création de l'objet XHR puis appeler
 * le code serveur afin de récupérer les données à modifier dans la page.
 */
function getNomCircuit(idr)
{
	//alert(idr);
    /* Si il n'y a pas d'identifiant de région, on fait disparaître la seconde liste au cas où elle serait affichée */
    if(idr == 'vide')
    {
        document.getElementById('nomCircuit').innerHTML = '';
    }
    else
    {
        /* À cet endroit précis, on peut faire apparaître un message d'attente */
        var blocListe = document.getElementById('nomCircuit');
        blocListe.innerHTML = "Traitement en cours, veuillez patienter...";
        /* On crée l'objet XHR */
        creerRequete();
        /* Définition du fichier de traitement */
        var url = './nomCircuit.php?idr='+ idr;
        /* Envoi de la requête à la page de traitement */
        requete.open('GET', url, true);
        /* On surveille le changement d'état de la requête qui va passer successivement de 1 à 4 */
        requete.onreadystatechange = function()
        {
            /* Lorsque l'état est à 4 */
            if(requete.readyState == 4)
            {
                /* Si on a un statut à 200 */
                if(requete.status == 200)
                {
                    /* Mise à jour de l'affichage, on appelle la fonction apropriée */
                	actualiserNomCircuit();
                }
            }
        };
        requete.send(null);
    }
}


function actualiserOR()
{
    var or = requete.responseText;
    var blocListe = document.getElementById('blocOR');
    blocListe.innerHTML = or;
}


highlight_row();
function highlight_row() {
    var table = document.getElementById('display-table');
    var cells = table.getElementsByTagName('td');

    for (var i = 0; i < cells.length; i++) {
        // Take each cell
        var cell = cells[i];
        // do something on onclick event for cell
        cell.onclick = function () {
            // Get the row id where the cell exists
            var rowId = this.parentNode.rowIndex;

            var rowsNotSelected = table.getElementsByTagName('tr');
            for (var row = 0; row < rowsNotSelected.length; row++) {
                rowsNotSelected[row].style.backgroundColor = "";
                rowsNotSelected[row].classList.remove('selected');
            }
            var rowSelected = table.getElementsByTagName('tr')[rowId];
            rowSelected.style.backgroundColor = "#49cced";
            rowSelected.className += " selected";

            msg = 'The ID of the company is: ' + rowSelected.cells[0].innerHTML;
            Dossier = rowSelected.cells[0].innerHTML;
            msg += '\nThe cell value is: ' + this.innerHTML;
            //alert(Dossier);
            
            
            
            if(Dossier == 'vide')
    {
        document.getElementById('blocOR').innerHTML = '';
    }
    else
    {
        /* À cet endroit précis, on peut faire apparaître un message d'attente */
        var blocListe = document.getElementById('blocOR');
        blocListe.innerHTML = "Traitement en cours, veuillez patienter...";
        /* On crée l'objet XHR */
        creerRequete();
        /* Définition du fichier de traitement */
        var url = './afficherOR.php?idr='+ Dossier;
        /* Envoi de la requête à la page de traitement */
        requete.open('GET', url, true);
        /* On surveille le changement d'état de la requête qui va passer successivement de 1 à 4 */
        requete.onreadystatechange = function()
        {
            /* Lorsque l'état est à 4 */
            if(requete.readyState == 4)
            {
                /* Si on a un statut à 200 */
                if(requete.status == 200)
                {
                    /* Mise à jour de l'affichage, on appelle la fonction apropriée */
                	actualiserOR();
                }
            }
        };
        requete.send(null);
    }
        }
        
    }

}


function actualiserFiltreDirections()
{
    var listeDirections = requete.responseText;
    var blocListe = document.getElementById('blocDirection');
    blocListe.innerHTML = listeDirections;
}

/**
 * Fonction publique appelée par la page affichée.
 * Cette fonction va initialiser la création de l'objet XHR puis appeler
 * le code serveur afin de récupérer les données à modifier dans la page.
 */
function getFiltreDirections(idr)
{
	//alert(idr);
    /* Si il n'y a pas d'identifiant de région, on fait disparaître la seconde liste au cas où elle serait affichée */
    if(idr == 'vide')
    {
        document.getElementById('blocDirection').innerHTML = '';
    }
    else
    {
        /* À cet endroit précis, on peut faire apparaître un message d'attente */
        var blocListe = document.getElementById('blocDirection');
        blocListe.innerHTML = "Traitement en cours, veuillez patienter...";
        /* On crée l'objet XHR */
        creerRequete();
        /* Définition du fichier de traitement */
        var url = './filtreDirections.php?idr='+ idr;
        /* Envoi de la requête à la page de traitement */
        requete.open('GET', url, true);
        /* On surveille le changement d'état de la requête qui va passer successivement de 1 à 4 */
        requete.onreadystatechange = function()
        {
            /* Lorsque l'état est à 4 */
            if(requete.readyState == 4)
            {
                /* Si on a un statut à 200 */
                if(requete.status == 200)
                {
                    /* Mise à jour de l'affichage, on appelle la fonction apropriée */
                	actualiserFiltreDirections();
                }
            }
        };
        requete.send(null);
    }
}


function actualiserAfficherClient()
{
    var listeClient = requete.responseText;
    var blocListe = document.getElementById('blocClient1');
    blocListe.innerHTML = listeClient;
}

/**
 * Fonction publique appelée par la page affichée.
 * Cette fonction va initialiser la création de l'objet XHR puis appeler
 * le code serveur afin de récupérer les données à modifier dans la page.
 */
function getafficherClient(idr)
{
	//alert(idr);
    /* Si il n'y a pas d'identifiant de région, on fait disparaître la seconde liste au cas où elle serait affichée */
    if(idr == 'vide')
    {
        document.getElementById('blocClient1').innerHTML = '';
    }
    else
    {
        /* À cet endroit précis, on peut faire apparaître un message d'attente */
        var blocListe = document.getElementById('blocClient1');
        blocListe.innerHTML = "Traitement en cours, veuillez patienter...";
        /* On crée l'objet XHR */
        creerRequete();
        /* Définition du fichier de traitement */
        var url = './afficherClient.php?idr='+ idr;
        /* Envoi de la requête à la page de traitement */
        requete.open('GET', url, true);
        /* On surveille le changement d'état de la requête qui va passer successivement de 1 à 4 */
        requete.onreadystatechange = function()
        {
            /* Lorsque l'état est à 4 */
            if(requete.readyState == 4)
            {
                /* Si on a un statut à 200 */
                if(requete.status == 200)
                {
                    /* Mise à jour de l'affichage, on appelle la fonction apropriée */
                	actualiserAfficherClient();
                }
            }
        };
        requete.send(null);
    }
}

function actualiserClientVehicule()
{
    var listeClient = requete.responseText;
    var blocListe = document.getElementById('blocClientVehicule');
    blocListe.innerHTML = listeClient;
}

/**
 * Fonction publique appelée par la page affichée.
 * Cette fonction va initialiser la création de l'objet XHR puis appeler
 * le code serveur afin de récupérer les données à modifier dans la page.
 */
function getClientVehicule(idr)
{
	//alert(idr);
    /* Si il n'y a pas d'identifiant de région, on fait disparaître la seconde liste au cas où elle serait affichée */
    if(idr == 'vide')
    {
        document.getElementById('blocClientVehicule').innerHTML = '';
    }
    else
    {
        /* À cet endroit précis, on peut faire apparaître un message d'attente */
        var blocListe = document.getElementById('blocClientVehicule');
        blocListe.innerHTML = "Traitement en cours, veuillez patienter...";
        /* On crée l'objet XHR */
        creerRequete();
        /* Définition du fichier de traitement */
        var url = './ChargerVehiculeClient2.php?idr='+ idr;
        /* Envoi de la requête à la page de traitement */
        requete.open('GET', url, true);
        /* On surveille le changement d'état de la requête qui va passer successivement de 1 à 4 */
        requete.onreadystatechange = function()
        {
            /* Lorsque l'état est à 4 */
            if(requete.readyState == 4)
            {
                /* Si on a un statut à 200 */
                if(requete.status == 200)
                {
                    /* Mise à jour de l'affichage, on appelle la fonction apropriée */
                	actualiserClientVehicule();
                }
            }
        };
        requete.send(null);
    }
}

function actualiserClientVehicule3()
{
    var listeVehicule = requete.responseText;
    var blocListe = document.getElementById('BlocClient3');
    blocListe.innerHTML = listeVehicule;
}

/**
 * Fonction publique appelée par la page affichée.
 * Cette fonction va initialiser la création de l'objet XHR puis appeler
 * le code serveur afin de récupérer les données à modifier dans la page.
 */
function getClientVehicule3(idr)
{
	//alert(idr);
    /* Si il n'y a pas d'identifiant de région, on fait disparaître la seconde liste au cas où elle serait affichée */
    if(idr == 'vide')
    {
        document.getElementById('BlocClient3').innerHTML = '';
    }
    else
    {
        /* À cet endroit précis, on peut faire apparaître un message d'attente */
        var blocListe = document.getElementById('BlocClient3');
        blocListe.innerHTML = "Traitement en cours, veuillez patienter...";
        /* On crée l'objet XHR */
        creerRequete();
        /* Définition du fichier de traitement */
        var url = './ChargerVehiculeClient3.php?idr='+ idr;
        /* Envoi de la requête à la page de traitement */
        requete.open('GET', url, true);
        /* On surveille le changement d'état de la requête qui va passer successivement de 1 à 4 */
        requete.onreadystatechange = function()
        {
            /* Lorsque l'état est à 4 */
            if(requete.readyState == 4)
            {
                /* Si on a un statut à 200 */
                if(requete.status == 200)
                {
                    /* Mise à jour de l'affichage, on appelle la fonction apropriée */
                	actualiserClientVehicule3();
                }
            }
        };
        requete.send(null);
    }
}

function actualiserPiece()
{
    var listePiece = requete.responseText;
    var blocListe = document.getElementById('blocPieces');
    blocListe.innerHTML = listePiece;
}

/**
 * Fonction publique appelée par la page affichée.
 * Cette fonction va initialiser la création de l'objet XHR puis appeler
 * le code serveur afin de récupérer les données à modifier dans la page.
 */
function getPieces(idr)
{
	//alert(idr);
    /* Si il n'y a pas d'identifiant de région, on fait disparaître la seconde liste au cas où elle serait affichée */
    if(idr == 'vide')
    {
        document.getElementById('blocPieces').innerHTML = '';
    }
    else
    {
        /* À cet endroit précis, on peut faire apparaître un message d'attente */
        var blocListe = document.getElementById('blocPieces');
        blocListe.innerHTML = "Traitement en cours, veuillez patienter...";
        /* On crée l'objet XHR */
        creerRequete();
        /* Définition du fichier de traitement */
        var url = './listePieces.php?idr='+ idr;
        /* Envoi de la requête à la page de traitement */
        requete.open('GET', url, true);
        /* On surveille le changement d'état de la requête qui va passer successivement de 1 à 4 */
        requete.onreadystatechange = function()
        {
            /* Lorsque l'état est à 4 */
            if(requete.readyState == 4)
            {
                /* Si on a un statut à 200 */
                if(requete.status == 200)
                {
                    /* Mise à jour de l'affichage, on appelle la fonction apropriée */
                	actualiserPiece();
                }
            }
        };
        requete.send(null);
    }
}


function actualiserFiltreVehicules()
{
    var listeVehicule = requete.responseText;
    var blocListe = document.getElementById('blocFiltreVehicules');
    blocListe.innerHTML = listeVehicule;
}

/**
 * Fonction publique appelée par la page affichée.
 * Cette fonction va initialiser la création de l'objet XHR puis appeler
 * le code serveur afin de récupérer les données à modifier dans la page.
 */
function getFiltreVehicules(idr)
{
	//alert(idr);
    /* Si il n'y a pas d'identifiant de région, on fait disparaître la seconde liste au cas où elle serait affichée */
    if(idr == 'vide')
    {
        document.getElementById('blocFiltreVehicules').innerHTML = '';
    }
    else
    {
        /* À cet endroit précis, on peut faire apparaître un message d'attente */
        var blocListe = document.getElementById('blocFiltreVehicules');
        blocListe.innerHTML = "Traitement en cours, veuillez patienter...";
        /* On crée l'objet XHR */
        creerRequete();
        /* Définition du fichier de traitement */
        var url = './filtreVehicules.php?idr='+ idr;
        /* Envoi de la requête à la page de traitement */
        requete.open('GET', url, true);
        /* On surveille le changement d'état de la requête qui va passer successivement de 1 à 4 */
        requete.onreadystatechange = function()
        {
            /* Lorsque l'état est à 4 */
            if(requete.readyState == 4)
            {
                /* Si on a un statut à 200 */
                if(requete.status == 200)
                {
                    /* Mise à jour de l'affichage, on appelle la fonction apropriée */
                	actualiserFiltreVehicules();
                }
            }
        };
        requete.send(null);
    }
}


