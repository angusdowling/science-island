"use strict";

var ua = window.navigator.userAgent;
var msie = ua.indexOf("MSIE ");


var app = {
	init: function(){
		app.handlers();
		// app.upgrade();
		app.initTabs();
	},

	handlers: function(){
		$('.ui.main.menu .link').on('click', function(e){
			app.dropdowns( $(this) );

			e.preventDefault();
		});

		$('.ui.navigate.toQuestions').on('click', function(e){
			app.switchToQuestions( $(this).attr('id') );

			e.preventDefault();
		});

		$('.ui.navigate.toRealm').on('click', function(e){
			app.switchToRealm();

			e.preventDefault();
		});

		// $('#closeiFrame').on('click', function(e){
		// 	CloseClicked();

		// 	e.preventDefault();
		// })
	},

	dropdowns: function( selector ){

		var dropdown = selector.next('.ui.dropdown');
		var alldds = $('.ui.dropdown');
		var flag = 0;
		
		if(dropdown.hasClass('open'))
		{
			dropdown.removeClass('open');

			ResizeUnity();

			$('#unityPlayer').removeClass('open');
		}

		else
		{
			if(alldds.hasClass('open'))
			{
				alldds.removeClass('open');
				dropdown.addClass('open');

				alldds.hide();
				dropdown.show();
			}

			else {
				dropdown.addClass('open');
				ResizeUnity();

				$('#unityPlayer').addClass('open');
			}
		}
	},

	initTabs: function(){
		if($( "#tabs")[0])
		{
			$( "#tabs" ).tabs();
		}
	},

	switchToQuestions: function( id ){
		var iframe = $(parent.document.getElementById('htmlContent'));
				
		iframe.html('<iframe id="realmContent" src="/science/docs/php/returnQuestion.php?questionID='+id+'"></iframe>');

		// $('.ui.layout.realm').hide();
		// $('.ui.questions.container').show();
	},

	switchToRealm: function(){
		$('.ui.questions.container').hide();
		$('.ui.layout.realm').show();
	}

	// upgrade: function()
	// {
	// 	if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))
	// 	{
	// 		$('#upgradeBrowser').show();
	// 	}
	// },
};

$(document).ready(function(){
	app.init();
})
