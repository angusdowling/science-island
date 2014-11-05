<?php
include("common.php");
$link=dbConnect();

	
	$query="SELECT * FROM realms ORDER BY id ASC";
	$result=mysql_query($query);
	if($result && mysql_num_rows($result)>0){
		$r="<realms>";

		while($row=mysql_fetch_array($result)){
			$id=$row['id'];
			$title=$row['title'];
			$description=$row['description'];
			$r.="<realm>";
			$r.="<id>" . $id . "</id>";
			$r.="<title>" . $title . "</title>";
			$r.="<description>" . $description . "</description>";
			$r.="</realm>";
	
			
		}
		$r.="</realms>";
		echo $r;
		mysql_close();
									 
									 
		

	
}else{
	echo "failed";
}


?>