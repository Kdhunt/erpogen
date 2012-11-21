<?php
require_once("common.inc.php");
if(isset($_POST['addSelect'])){
	$subject = ereg_replace("[^A-Za-z0-9]", "", $_POST['addSelect']); //clean up post string
	$sql = "INSERT INTO `musefis_story`.`subject` (`ID`, `Subject_name`) VALUES (NULL, '%s')";
	$q = sprintf($sql,$subject);
//	$q = mysql_real_escape_string($q);
	$result = $db->run_query($q);
echo $result;
//	$id = $db->get_id;
	if (!$result) {
		die('Invalid query: ' . mysql_error());
	}else{
		echo $result;
	}
	exit;
}


if(isset($_POST['retrieve_word_list'])){
	$s = $_POST['s'];
	$p = $_POST['p'];
	$words = $db->fetch_array("SELECT word FROM words WHERE `subject_id` = $s AND `word_part_id` = $p order by word asc");
	$i=0;
	do{
		echo ($words[$i]['word'])."<br />";
		$i++;
	}while($i<count($words));
	exit;
}
?>
