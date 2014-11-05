<script type="text/javascript">
<!--
	var config = {
		width: 1072, 
		height: 603,
		params: { enableDebugging:"1" }
		
	};
	var u = new UnityObject2(config);
	
	jQuery(function() {

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

		<?php
		include("common.php");

		$questionID=make_safe($_REQUEST['questionID']);
		?>

		u.initPlugin(jQuery("#unityPlayer")[0], "/science/questions/"+ <?php echo $questionID; ?> +"/game/game.unity3d");
	});
-->
</script>
<style type="text/css">
div.content {
	margin: auto;
	width: 1072px;
}
div.broken,
div.missing {
	margin: auto;
	position: relative;
	top: 50%;
	width: 193px;
}
div.broken a,
div.missing a {
	height: 63px;
	position: relative;
	top: -31px;
}
div.broken img,
div.missing img {
	border-width: 0px;
}
div.broken {
	display: none;
}
div#unityPlayer {
	cursor: default;
	height: 603px;
	width: 1072px;
}
</style>

<div class="content">
	<div id="unityPlayer">
		<div class="missing">
			<a href="http://unity3d.com/webplayer/" title="Unity Web Player. Install now!">
				<img alt="Unity Web Player. Install now!" src="http://webplayer.unity3d.com/installation/getunity.png" width="193" height="63" />
			</a>
		</div>
	</div>
</div>