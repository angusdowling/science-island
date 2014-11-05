var unityObjectUrl = "http://webplayer.unity3d.com/download_webplayer-3.x/3.0/uo/UnityObject2.js";

if (document.location.protocol == 'https:'){
	unityObjectUrl = unityObjectUrl.replace("http://", "https://ssl-");
}
	
document.write('<script type="text\/javascript" src="' + unityObjectUrl + '"><\/script>');

var unityPlayerObject;
var minWidth = 1072; 
var minHeight = 603;
var winWidth;
var winHeight;

jQuery(function() {

	var config = {
		width: 1072, 
		height: 603,
		params: { enableDebugging:"0" }
	};

	config.params["disableContextMenu"] = true;

	var u = new UnityObject2(config);
	var $missingScreen = jQuery("#unityPlayer").find(".missing");
	var $brokenScreen = jQuery("#unityPlayer").find(".broken");

	$missingScreen.hide();
	$brokenScreen.hide();

	u.observeProgress(function (progress) {
		switch(progress.pluginStatus) {
			case "broken":
			$brokenScreen.find("a").click(function (e) {
				e.stopPropagation();
				e.preventDefault();
				u.installPlugin();
				return false;
			});
			$brokenScreen.show();
			break;
			case "missing":
			$missingScreen.find("a").click(function (e) {
				e.stopPropagation();
				e.preventDefault();
				u.installPlugin();
				return false;
			});
			$missingScreen.show();
			break;
			case "installed":
			$missingScreen.remove();
			break;
			case "first":
			break;
		}
	});

	u.initPlugin(jQuery("#unityPlayer")[0], "ScienceIsland.unity3d");
	unityPlayerObject = u;
	ResizeUnity();
});

function ResizeUnity()
{
	GetWindowSize();

	var unity = unityPlayerObject.getUnity();
	if(unity != null)
	{
		unity.style.width = winWidth + "px";
		unity.style.height = winHeight + "px";
	}
}

function GetWindowSize()
{
	///Non-IE or IE 8+
	// if(typeof(window.innerWidth) == 'number')
	// {
	// 	winWidth = window.innerWidth;
	// 	winHeight = window.innerHeight;
	// }

	// else
	// {
	// 	//IE 6+ in "Standards Compliant Mode"
	// 	if(document.documentElement && 
	// 		(document.documentElement.clientWidth || document.documentElement.clientHeight))
	// 	{
	// 		winWidth = document.documentElement.clientWidth;
	// 		winHeight = document.documentElement.clientHeight;
	// 	}

	// 	else
	// 	{
	// 		//IE 4 compatible
	// 		if(document.body && (document.body.clientWidth || document.body.clientHeight))
	// 		{
	// 			winWidth = document.body.clientWidth;
	// 			myHeight = document.body.clientHeight;
	// 		}
	// 	}
	// }

	winWidth = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
	winHeight = window.innerHeight || document.body.offsetHeight || document.documentElement.clientHeight || $(window).height();
	winHeight = winHeight - ( $('.ui.masthead').outerHeight() );

	if(winWidth < minWidth)
	{
		winWidth = minWidth;
	}

	if(winHeight < minHeight)
	{
		winHeight = minHeight;
	}
}

// show the message
function RealmClicked( id )
{
   // document.getElementById('htmlContent').style.display= 'block' ;

   // $("#htmlContent").load("/science/docs/php/returnRealmQuestions.php?realmID="+id);
   
   $("#htmlContent").html( "<iframe id='realmContent' src='/science/docs/php/returnRealmQuestions.php?realmID="+id+"+'></iframe><p><a id='closeiFrame' href='javascript:CloseClicked()''>Close</a></p>" );

   $("#htmlContent").slideDown(600);

}

function CloseClicked()
{   
	var unity = unityPlayerObject.getUnity();

	unity.SendMessage("WholeIsland", "CloseClicked","");
	//document.getElementById('htmlContent').style.display= 'none' ;

	$("#htmlContent").slideUp(600);
}

function FinishedLoading()
{
	ResizeUnity();
}

function EventHandlers()
{
	$(window).resize(function(){
		ResizeUnity();
	});
}

EventHandlers();