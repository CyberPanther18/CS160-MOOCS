// JavaScript Document
$(document).ready(function(){
	"use strict";
	
	var $container = $("#content");
	$("body").on('click', "nav a.load", function(){
		var $this = $(this), target = $this.data('target');
		
		$container.fadeOut("fast", function(){
			$container.load("./" + target + '.php');
			$container.fadeIn("fast");
		});
		return false;
	});
	
});
