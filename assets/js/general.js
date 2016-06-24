$(document).ready(function() {
	widthScreen=$(window).width();
	heightScreen=$(window).height();
	$('.sideNav').css('width',"200px");
	$('.sideNav').css('height',heightScreen+"px");
	$('.sideNav').css('margin-top',$('.textHeader').height()+20+"px");
	$('.menuLeft').show();
	$('.menuLeftOpen').show();
	$('.menuLeftClose').hide();
	
	$('.menuItems').click(function(){
		$(this).addClass('selectedItems');
	});
	
	if(widthScreen<400){
		$('.textHeader').css("font-size",'2em');
		$('.menuNav').css('height',heightScreen+"px");
		$('.contentText').css('top',$('.textHeader').height()+100+"px");
		$('.sideNav').css('margin-top',$('.textHeader').height()+20+"px");
		$('.footer').css('top',$('.contentText').position().top+$('.contentText').height()+'px');
	}else if(widthScreen<800){
		$('.textHeader').css("font-size",'4em');
		$('.menuNav').css('height',heightScreen+"px");
		$('.menuNav').css('margin-left','-250px');
		$('.contentText').css('top',$('.textHeader').height()+100+"px");
		$('.sideNav').css('margin-top',$('.textHeader').height()+20+"px");
		$('.footer').css('top',$('.contentText').position().top+$('.contentText').height()+'px');
	}else{
		$('.menuNav').css('height',heightScreen+"px");
		$('.menuNav').css('margin-left','0px');
		$('.contentText').css('top',$('.textHeader').height()+100+"px");
		$('.footer').css('top',$('.contentText').position().top+$('.contentText').height()+'px');
	}
	
	$(window).resize(function(){
		widthScreen=$(window).width();
		heightScreen=$(window).height();
		$('.sideNav').css('height',heightScreen+"px");
		if(widthScreen<=500){
			$('.textHeader').css("font-size",'2em');
			$('.contentText').css('top',$('.textHeader').height()+100+"px");
			$('.sideNav').css('margin-top',$('.textHeader').height()+20+"px");
			$('.footer').css('top',$('.contentText').position().top+$('.contentText').height()+'px');
		}else if(widthScreen>500 && widthScreen<800){
			$('.textHeader').css("font-size",'4em');
			$('.contentText').css('top',$('.textHeader').height()+100+"px");
			$('.sideNav').css('margin-top',$('.textHeader').height()+20+"px");
			$('.footer').css('top',$('.contentText').position().top+$('.contentText').height()+'px');
		}else{
			$('.textHeader').css("font-size",'8em');
			$('.contentText').css('top',$('.textHeader').height()+100+"px");
			$('.sideNav').css('margin-top',$('.textHeader').height()+20+"px");
			$('.footer').css('top',$('.contentText').position().top+$('.contentText').height()+'px');
		}
	});
	
	$(document).scroll(function(){
		if($(document).scrollTop() >= $(".headerNav").height()-100){
			$(".sideNav").css("margin-top","-8%");
		}else{
			$(".sideNav").css("margin-top",$('.textHeader').height()+20+"px");
		};
	});
	
	$('.contentText').css('left','20%');
	
	$('.menuLeftOpen').click(function(){
		$('.menuNav').animate({
			'margin-left':'0px',
		  }, 300, function() {
			  $('.menuLeftOpen').hide();
			  $('.menuLeftClose').show();
		  });
		$('.contentText').animate({
			  left:'20%'
		  },300, function(){});
	});
	$('.menuLeftClose').click(function(){
		$('.menuNav').animate({
			'margin-left':'-250px',
		  }, 300, function() {
			  $('.menuLeftClose').hide();
			  $('.menuLeftOpen').show();
		  });
		$('.contentText').animate({
			  left:'15%'
		  },300, function(){});
	});
	
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