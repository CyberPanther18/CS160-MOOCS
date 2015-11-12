// JavaScript Document
$(document).ready(function(){
	"use strict";
	
	var $slider = $("#slider");
	var $slidercontent = $("#slider #slidercontent");
	
	$("body").on('click', "nav a.load", function(){
		var $this = $(this), target = $this.data('target');
		$(".main").addClass("dim");
		$slider.show("slide", {direction: "up"});
		$slidercontent.load("./user/" + target + '.php');
		return false;
	});
	$("body").on('click', "#slider .close", function(){
		$slider.hide("slide", {direction: "up"});
		$(".main").removeClass("dim");
	});
});
