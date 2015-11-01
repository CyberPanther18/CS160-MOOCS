// JavaScript Document
$("form input").focusout(function() {
	"use strict"
		var $value = $(this).val();
        if ($value === null || $value === ""){
			$(this).addClass("invalid");
		} else{
			if($(this).hasClass("invalid")){
				$(this).removeClass("invalid");
			}
			$(this).addClass("valid");
		}
    });
$("form").submit(function(event){
	"use strict";
	var validated = true;
	$("input").each(function(){
		if($(this).hasClass("invalid")){
				$(this).effect("shake");
				validated = false;
		}
	});
		
		if(validated){
			return;
		} else{
			event.preventDefault();
		}
});