<?php
include("common.php");

$questionID=make_safe($_REQUEST['questionID']);
?>

<video id="animationVideo" width="1072" height="602" controls>
	<source src="/science/questions/<?php echo $questionID; ?>/animation/animation.mp4" type="video/mp4" />
</video>

<script>
$('#animationVideo')[0].addEventListener("ended", function(){
	$.getJSON("saveUserProgress.php?userID=1&questionID=" + <?php echo $questionID; ?> + "&activity=animation&score=0", function( result ){

		if(result)
		{
			console.log(result[0].theResult);
		}
		
		else
		{
			console.log('no result');
		}
	});
});
</script>
