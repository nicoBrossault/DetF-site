$(document).ready(function() {
	widthScreen=$(window).width();
	heightScreen=$(window).height();
	$('.menuLeft').show();
	$('.menuLeftOpen').show();
	$('.menuLeftClose').hide();
	
	$('.menuItems').click(function(){
		$(this).addClass('selectedItems');
	});
	
	
	if(widthScreen<400){
		$('.textHeader').css("font-size",'2em');
		$('.contentText').css('top',$('.textHeader').height()+100+"px");
		$('.footer').css('top', (heightScreen-$('.footer'))+'px');
	}else if(widthScreen<900){
		$('.textHeader').css("font-size",'4em');
		$('.contentText').css('top',$('.textHeader').height()+100+"px");
		$('.footer').css('top', (heightScreen-$('.footer'))+'px');
	}else{
		$('.contentText').css('top',$('.textHeader').height()+100+"px");
		$('.footer').css('top', (heightScreen-$('.footer'))+'px');
	}
	
	$(window).resize(function(){
		widthScreen=$(window).width();
		if(widthScreen<400){
			$('.textHeader').css("font-size",'2em');
			$('.contentText').css('top',$('.textHeader').height()+100+"px");
		}else if(widthScreen<800){
			$('.textHeader').css("font-size",'4em');
			$('.contentText').css('top',$('.textHeader').height()+100+"px");
		}else{
			$('.textHeader').css("font-size",'4em');
			$('.contentText').css('top',$('.textHeader').height()+100+"px");
		}
	});
	
	/* Test Nav Bar */
	$("#menu-toggle").click(function(e) {
	    e.preventDefault();
	    $("#wrapper").toggleClass("toggled");
	});
	
	$('.contentText').css('left','20%');
	
	$(".buttonAdd").click(function(){
		$(document).scrollTop(250);
	});
	$(".btnDelete").click(function(){
		$(document).scrollTop(250);
	});
	
	$(".annuler").click(function(){
		$(".formAdd").empty();
		$(".cache").css("visibility","hidden");
	});
	
	//Fonction Select
	$('select').material_select();
	
	//Fonction datePicker
	$('.datepicker').pickadate({
		selectMonths: true, // Creates a dropdown to control month
		selectYears: 15 // Creates a dropdown of 15 years to control year
	});
	
	//Fonction textarea
	$('.func').click(function(){
		var func=$(this).attr('id');
		var text=$(".materialize-textarea").val()+'<'+func+'></'+func+'>';
		$(".materialize-textarea").val(text);
	});
	$('.clearText').click(function(){
		var text='';
		$(".materialize-textarea").val(text);
	});
	
    //La fonction s'active sur l'évènement keydown dans la zone de texte
    $(".materialize-textarea").keydown(function(limit){
    	//Définir la limite à atteindre
    	var max="false";
    	var limit = "5";

    	//Récupérer le nombre de caractères dans la zone de texte
    	var currlength = $(this).val().length;

    	//Afficher un texte de légende en fonction du nombre de caractères
    	if(currlength >= limit){
    		$("#legende")
    		.removeClass("insuffisant")
    		.addClass("suffisant")       
    		.css('color','black');
    		$(".materialize-textarea").css('color','black');
    		$("#legende").html("Vous avez saisi " + currlength + " caractères");
    	}else{
    		$("#legende")
    		.removeClass("suffisant")
    		.addClass("insuffisant")
    		.html("Vous avez saisi " + currlength + " caractères sur " + limit + " minimum")
    		.css('color','red');
    		$(".materialize-textarea").css('color','red');
    	}
	});
	        
})