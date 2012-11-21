<?php

require_once("poem.class.php");
$words = (isset($_POST['wordlist']))?explode("\r\n",$_POST['wordlist']):array();
$poem = new poem($db);
foreach($words as $word){
	echo $word.": ";
	echo $poem->syllable_count($word);
	echo "<br \>";
	$synonyms = array();
	$count;
	$poem->get_synonyms($word, $synonyms, $count);
	echo $count;
	print_r($synonyms);

	$poem->get_thesaurus($word, $t_array, $t_count);
}


?>

<form method="post" action="poemgen.php">
Words:
<textarea name="wordlist"><?php echo $_POST['wordlist']; ?></textarea>
<input type="submit">
</form>
