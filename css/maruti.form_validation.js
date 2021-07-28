
$(document).ready(function(){
	
	$('input[type=checkbox],input[type=radio],input[type=file]').uniform();
	
	$('select').select2();
	
	// Form Validation
    $("#basic_validate").validate({
		rules:{
			libelle:{
				required:true
			},
			email:{
				required:true,
				email: true
			},
			date:{
				required:true,
				date: true
			},
			numero:{
				required:true
				
			},
			nom:{
				required:true
				
			},
			telephone:{
				required:true
				
			},
			contact:{
				required:true
				
			},
			contacttel:{
				required:true
				
			},
			immatriculation:{
				required:true
				
			},
			chassis:{
				required:true,
				
			},
			kilometrage:{
				required:true,
				number:true
			},
			nummoteur:{
				required:true
				
			},
			numbc:{
				required:true
				
			},
			dmc:{
				required:true,
			},
			modele:{
				required:true
				
			},
			siglefiliale:{
				required:true
				
			},
			nomfiliale:{
				required:true
				
			},
			nbetapes:{
				required:true,
				number:true
			},
		},
		messages: {
            libelle: "Libelle obligatoire",
            nom: "Numero obligatoire",
            nom: "Nom obligatoire",
            email: "Email invalide",
            telephone: "Telephone obligatoire",
            contact: "Contact obligatoire",
            contacttel: "Telephone contact obligatoire",
			immatriculation: "Immatriculation obligatoire",
			chassis: "Chassis obligatoire",
			kilometrage: "Numero invalide",
			contacttel: "Tel contact obligatoire obligatoire",
			dmc: "DMC obligatoire",
			nbetapes: "Numero invalide"
			
            },
            
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});
	
	$("#number_validate").validate({
		rules:{
			min:{
				required: true,
				min:10
			},
			max:{
				required:true,
				max:24
			},
			number:{
				required:true,
				number:true
			}
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});
	
	$("#password_validate").validate({
		rules:{
			pwd:{
				required: true,
				minlength:3,
				maxlength:10
			},
			pwd2:{
				required:true,
				minlength:3,
				maxlength:10,
				equalTo:"#pwd"
			},
			email:{
				required:true,
				email: true
			},
			prenom:{
				required:true,
			},
			nom:{
				required:true
				
			},
			utilisateur:{
				required:true
				
			}
		},
		
		messages: {
            pwd: "Mot de passe trop court, au minimum 3 caracteres",
            pwd2: "Les mots de passe ne correspondent pas",
            nom: "Nom obligatoire",
            prenom: "Prenom obligatoire",
            email: "Format email invalide",
			utilisateur: "utilisateur obligatoire"
            },
		
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});
});
