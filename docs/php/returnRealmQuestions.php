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
	<script type="text/javascript" src="http://w2ui.com/src/w2ui-1.4.1.min.js"></script>
	<script src="/science/docs/js/jquery-ui.min.js" type="text/javascript"></script>

</head>

<body onload="parent.resizeIframe(document.body.scrollHeight)">
	<div class="ui layout realm">
		<div class='ui questionContainer'>
			<div class='ui grid constrained'>
				<div class='row'>

					<?php
						//hard coding userID for now
						$userID=1;

						include("common.php");

						$realmID=make_safe($_REQUEST['realmID']);

						if($realmID!='')
						{
							$link=dbConnect();
							$query="SELECT * FROM realms WHERE id=$realmID";
							$result=mysql_query($query);

							if($result && mysql_num_rows($result)==1)
							{
								$row=mysql_fetch_array($result);
								$title=$row['title'];
								$description=$row['description'];

								echo "<h1>$title</h1>";
								echo "<p>$description</p>";
								
								$query="SELECT * FROM questions WHERE realmID=$realmID ORDER BY id ASC";
								$result=mysql_query($query);

								

								if($result && mysql_num_rows($result)>0)
								{
									while($row=mysql_fetch_array($result))
									{
										$id=$row['id'];
										$title=$row['title'];
										$description=$row['description'];
					?>

					<div class='ui column one third wide'>
						<section class='ui question component'>
							<a class="ui navigate toQuestions" href="#" id="<?php echo $id; ?>">
								<img src='/science/docs/questions/2/images/icon.png' />
								<h2><?php echo $title ?></h2>
								<p><?php echo $description ?></p>

								<?php
									//look in file structure to see if there is an animation, game, book, quiz.  This info will be used to work out which icons to show and to calculate percent complete for this question
									//hard code for now

									$numActivities = 0;
									$completedActivities = 0;
									$pathToRoot = dirname(__FILE__) . "/../../";
									
									if(file_exists($pathToRoot . "questions/$id/game/game.unity3d"))
									{
										$hasGame=true;
										$numActivities++;
										//check if it has been completed
									}

									else
									{
										$hasGame=false;
									}

									if(file_exists($pathToRoot . "questions/$id/animation/animation.mp4"))
									{
										$hasAnimation=true;
										$numActivities++;
										//check if it has been completed
									}

									else
									{
										$hasAnimation=false;
									}

									if(file_exists($pathToRoot . "questions/$id/book/book.mp4"))
									{
										$hasBook=true;
										$numActivities++;
										//check if it has been completed
									}

									else
									{
										$hasBook=false;
									}

									if(file_exists($pathToRoot . "questions/$id/quiz/quiz.mp4"))
									{
										$hasQuiz=true;
										$numActivities++;
										//check if it has been completed
									}

									else
									{
										$hasQuiz=false;
									}

									$completedGame=false;
									$completedAnimation=false;
									$completedBook=false;
									$completedQuiz=false;
									
									//get progress
									$query="SELECT * FROM userProgress WHERE questionID=$id AND userID=$userID";
									$resultProgress=mysql_query($query);

									if($resultProgress && mysql_num_rows($resultProgress)>0)
									{
										while($rowProgress=mysql_fetch_array($resultProgress))
										{
											$activity=$rowProgress['activity'];
											if($activity=='game')
											{
												$completedGame=true;
												$completedActivities++;
											}

											else if($activity=='animation')
											{
												$completedAnimation=true;
												$completedActivities++;
											}

											else if($activity=='book')
											{
												$completedBook=true;
												$completedActivities++;
											}

											else if($activity=='quiz')
											{
												$completedQuiz=true;
												$completedActivities++;									
											}
										}
									}

									$percentPerActivity = ($numActivities) ? 100 / $numActivities : 0;
									$percentComplete = $percentPerActivity * $completedActivities;

									echo $percentComplete;
								?>
								<?php
									if($hasGame)
									{
								?>

								<div class='activity'>

									
									<img src='/science/docs/images/question-activity-icon-bg.png' />

									<img src='/science/docs/images/game-icon.png' />
									
										
									<?php
										if($completedGame){
									?>

									<img src="/science/docs/images/completed.png"> <!--  completed icon -->

									<?php
										} else {
									?>

									<img src="/science/docs/images/not-completed.png">  <!-- not-completed icon -->

									<?php
										}
									?>							

								</div>

								<?php
								}

								if($hasAnimation){
								?>
								<div class='activity'>
									<img src='/science/docs/images/question-activity-icon-bg.png' />
									<img src='/science/docs/images/ani-icon.png' />

								<?php
									if($completedAnimation){
								?>

									<img src="/science/docs/images/completed.png"> <!-- completed icon -->

								<?php
									} else {
								?>

									<img src="/science/docs/images/not-completed.png"> <!-- not-completed icon -->

								<?php
									}
								?>

								</div>

								<?php
								}
								

								if($hasBook){
								?>
								<div class='activity'>
									<img src='/science/docs/images/question-activity-icon-bg.png' />
									<img src='/science/docs/images/book-icon.png' />
								<?php
									if($completedBook){
								?>
									<img src="/science/docs/images/completed.png">  <!-- completed icon -->

								<?php
									} else {
								?>

									<img src="/science/docs/images/not-completed.png"> <!-- not-completed icon -->

								<?php
									}
								?>

								</div>

								<?php
								}

								if($hasQuiz){
								?>
								<div class='activity'>
									<img src='/science/docs/images/question-activity-icon-bg.png' />
									<img src='/science/docs/images/quiz-icon.png' />

								<?php
									if($completedQuiz){
								?>

									<img src="/science/docs/images/completed.png">  <!-- completed icon -->

								<?php
									} else {
								?>

									<img src="/science/docs/images/not-completed.png"> <!-- not-completed icon -->

								<?php
									}
								?>

								</div>

								<?php
								}
								?>
							</a>

						</section> <!-- Close "ui question component" -->
					</div> <!-- Close "column" -->

					<?php	
							}
						}
					?>

				</div><!-- // Close "row" -->
			</div><!-- // Close "ui question component" -->
		</div><!-- // Close "questionContainer" -->

		<?php
				}
				mysql_close();
			}
		?>

		<!-- <p><a href="javascript:CloseClicked()">Close</a></p> -->
	</div>

	
	<!-- Scripts -->
    <!-- main.js is required on all pages -->
    <script type='text/javascript' src='/science/docs/js/main.js'></script>
    <!-- /Scripts -->
</body>
</html>
	