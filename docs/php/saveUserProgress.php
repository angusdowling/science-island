<?php
	header("Content-Type: application/json");

	include("common.php");

	$questionID=make_safe($_REQUEST['questionID']);
	$userID=make_safe($_REQUEST['userID']);
	$activity=make_safe($_REQUEST['activity']);
	$score=make_safe($_REQUEST['score']);

	$link=dbConnect();

	$query="SELECT * FROM userProgress WHERE userID=$userID AND questionID=$questionID AND activity='$activity'";
	$result=mysql_query($query);

	if($result && mysql_num_rows($result) == 0)
	{
		$query = "INSERT INTO userProgress (userID, questionID, activity, score) VALUES ($userID, $questionID, '$activity', $score)";

		$result = mysql_query($query);

		if($result)
		{
			$query = "UPDATE users SET tokens = tokens + 25 WHERE id = $userID";
			$result = mysql_query($query);
			
			$theResult = "tokensAwarded";
			// Award tokens here
		}

		else
		{
			$theResult = "saveFailed";
		}
	}

	else
	{
		$theResult = "tokensAlreadyAwarded";
	}

	echo json_encode(array(array("theResult" => $theResult)));
?>