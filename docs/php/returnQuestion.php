<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Science Island</title>

	<!-- Styles -->
	<link href="/science/docs/css/normalize.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="http://w2ui.com/src/w2ui-1.4.1.min.css" />
	<link href="/science/docs/css/master.css" rel="stylesheet" type="text/css">
	<!-- /Styles -->
	
	<script src="/science/docs/js/jquery-1.11.1.js" type="text/javascript"></script>
	<script type='text/javascript' src='https://ssl-webplayer.unity3d.com/download_webplayer-3.x/3.0/uo/jquery.min.js'></script>
	<script type='text/javascript' src='http://webplayer.unity3d.com/download_webplayer-3.x/3.0/uo/UnityObject2.js'></script>

</head>

<!-- <body onload="parent.resizeIframe(document.body.scrollHeight)"> -->
<body>

	<?php
		error_reporting(0);
		//hard coding userID for now
		$userID=1;

		include("common.php");

		$questionID=make_safe($_REQUEST['questionID']);

		$link=dbConnect();

		$query="SELECT * FROM questions WHERE id=$questionID";
		$result=mysql_query($query);

		if($result && mysql_num_rows($result) == 1)
		{
			$row=mysql_fetch_array($result);
			$id=$row['id'];
			$title=$row['title'];
			$description=$row['description'];
	?>
	<script> var questionID = <?php echo $id; ?>;</script>

	<div class="ui questions container">
		<div class="ui constrained">
			<header>
				<h1><?php echo $title; ?></h1>
				<p><?php echo $description; ?></p>
			</header>
			<div id="tabs">
				<ul class="tabHeadings clearfix">
					<li class="item">
						<a id="gameTab" class="link" href="#tabGame">Game</a>
					</li>
					<li class="item">
						<a id="animationTab" class="link" href="#tabAnimation">Animation</a>
					</li>
					<li class="item">
						<a id="bookTab" class="link" href="#tabBook">Book</a>
					</li>
					<li class="item">
						<a id="quizTab" class="link" href="#tabQuiz">Quiz</a>
					</li>
				</ul>
			</div>
			<div id="questionContent"></div>
		</div>
		<a class="ui navigate toRealm" href="#">Back to realm</a>
	</div>

	<?php
		}
	?>

	<!-- Scripts -->
    <!-- main.js is required on all pages -->
    <script type='text/javascript' src='/science/docs/js/main.js'></script>
    <!-- /Scripts -->
</body>
</html>