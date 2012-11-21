<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Add Words</title>
<link rel="stylesheet" type="text/css" href="view.css" media="all">
<script type="text/javascript" src="general.js"></script>
<script type="text/javascript" src="view.js"></script>
<script type="text/javascript" src="formmanip.js"></script>
<script type="text/javascript" src="ajax.js"></script>
</head>
<?php
require_once('common.inc.php');

if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST['wordlist'])){
	$subj=(isset($_POST['subject']))?$_POST['subject']:'';
	$wordpt=(isset($_POST['wordpart']))?$_POST['wordpart']:'';
	$wordlist = preg_split("/([^A-Za-z0-9'-])/",$_POST['wordlist']);//explode("\r\n", $_POST['wordlist']);
	foreach ($wordlist as $word){
		if(!$poem->word_in_db($word, $subj, $wordpt)){
			$word = ereg_replace("[^A-Za-z0-9'-]", "", $word); //clean up post string
			//	pattern types, "rhyme", syllable, line
			$db->run_query("INSERT INTO `musefis_story`.`patterns` (`ID`, `pattern`, `pattern_type`) VALUES (NULL, '$pattern', '$ptype')");
		}
	}
}
?>
<body id="main_body" onLoad="load_words();">


	<div id="form_container" style="">
		<div  style="float:left;background:#fff;">
		<h1><a>Add Words</a></h1>
			<form id="add_pattern" class="appnitro"  method="post" action="">
						<div class="form_description">
				<h2>Add Pattern</h2>
				<p>Patterns are the meat of this app, they provide the structure for how a poem is structured as well as contains all the punctuation.<br />
				Please use any of the following codes when creating line patterns:<br />
				noun : 1 | noun | &n<br />
				pronoun : 2 | pronoun | &p<br />
				adjective : 3 | adj | adjective | &j<br />
				verb : 4 | verb | &v<br />
				adverb : 5 | adverb | &a<br />
				preposition: 6 | preposition | prep | &r<br />
				conjunction: 7 | confunction | conj | &c<br />
				interjection: 8 | interjection | int | &i<br />
				</p>
			</div>
				<ul >

						<li id="li_2" >
			<label class="description" for="subject">Subject </label>
			<div>
			<select class="element select medium" id="subject" name="subject" onchange="load_words();">
				<?php foreach($subjects as $subject){ ?>
					<option value='<?php echo $subject['ID'];?>' <?php echo ($subject['ID'] == $subj)?'selected':'';?>><?php echo $subject['Subject_name']; ?></option>
				<?php } ?>

			</select>
			</div><div id="test"></div>
			<div><input type="button" value="Add Subject" onclick="addSelectOption('subject', prompt('Enter a subject.'));"></div>
			</li>		<li id="li_3" >
			<label class="description" for="wordpart">Part of Speech </label>
			<div>
			<select class="element select medium" id="wordpart" name="wordpart" onchange="load_words();">
				<?php foreach($parts as $part){ ?>
					<option value='<?php echo $part['word_part_id'];?>' <?php echo ($part['word_part_id'] == $wordpt)?'selected':'';?>><?php echo $part['word_part']; ?></option>
				<?php } ?>
			</select>
			</div>
			</li>		<li id="li_1" >
			<label class="description" for="pattern">Pattern:</label>
			<div>
				<textarea id="pattern" name="pattern" class="element textarea small"></textarea>
			</div><p class="guidelines" id="guide_1">
			<small>
				
			</small></p>
			</li>

						<li class="buttons">
				    <input type="hidden" name="form_id" value="166785" />

					<input id="saveForm" class="button_text" type="submit" name="submit" value="Submit" />
			</li>
				</ul>
			</form>
		</div>
		<div style="float:left; width:200px; height:100%; scroll:auto; border: 4px green; display:block; position:absolute; top:0; right:0;">
		<h1><a>Words in List</a></h1>
		<div id="words"> </div>
		</div>
		<div id="footer" style="clear:both;">

		</div>
	</div>

	</body>
</html>