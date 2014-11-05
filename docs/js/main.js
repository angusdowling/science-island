"use strict";

var ua = window.navigator.userAgent;
var msie = ua.indexOf("MSIE ");


var app = {
	init: function(){
		app.handlers();
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

		$('.tabHeadings .item .link').on('click', function(e){
			app.activityClick( $(this).attr('id'), questionID );

			e.preventDefault();
		})

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
			dropdown.stop().slideUp(function(){
				$(this).removeClass('open');
			});

			ResizeUnity();

			$('#unityPlayer').removeClass('open');
		}

		else
		{
			if(alldds.hasClass('open'))
			{
				alldds.removeClass('open');
				dropdown.addClass('open');
			}

			else {

				dropdown.stop().slideDown(function(){
					$(this).addClass('open');
				});
				
				ResizeUnity();

				$('#unityPlayer').addClass('open');
			}
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
	},

	activityClick: function( string, id ){
		var container = $('#questionContent');

		switch(string){
			case "gameTab":
				container.load('/science/docs/php/returnGame.php?questionID='+id);
				break;
			case "animationTab":
				container.load('/science/docs/php/returnAnimation.php?questionID='+id);
				break;
			case "bookTab":
				container.load('/science/docs/php/returnBook.php?questionID='+id);
				break;
			case "quizTab":
				container.load('/science/docs/php/returnQuiz.php?questionID='+id);
				break;
		}
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
