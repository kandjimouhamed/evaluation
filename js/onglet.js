(function() {
    var afficherOnglet = function(a){
        var li =a.parentNode
        var div = a.parentNode.parentNode.parentNode
    if(li.classList.contains('active')){
        return false
    }
       //on retire la classe active de l'onglet actif
      
        div.querySelector('.tabs .active').classList.remove('active')
        
        //on retire la classe active de l'onglet actif
        li.classList.add('active')
        //on retire la classe active sur le contenu actif
        div.querySelector('.tab-containt.active').classList.remove('active')
         //on retire la classe active sur le contenu actif
         div.querySelector(a.getAttribute('href')).classList.add('active')
        
    }
    
    var tabs = document.querySelectorAll('.tabs a')
    
    for (var i= 0; i < tabs.length; i++) {
        tabs[i].addEventListener('click', function(e) {
            
            afficherOnglet(this)
        })
    }
        
    
     var hash = window.location.hash
    var a = document.querySelector('a[href="'+ hash +'"] ')
    if(a!== null && !a.classList.contains('active')){
        afficherOnglet(a)
          
    }
     
    
})()