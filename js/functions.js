// JavaScript Document
$(document).ready(function(){
	"use strict";
	
	var $slider = $("#slider");
	var $slidercontent = $("#slider #slidercontent");
	$("body").on('click', "nav a.load", function(){
		var $this = $(this), target = $this.data('target');
		$slider.show("slide", {direction: "right"});
		$slidercontent.load("./" + target + '.php');
		return false;
	});
	$("body").on('click', "#slider .close", function(){
		$(this).parent().hide("slide", {direction: "right"});
	});
	
});
