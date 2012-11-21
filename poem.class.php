<?php

/**
 *
 *
 */
class poem{
	/**
	 * Constructor
	 */
	private $db; //local database connection passed by reference from
	function __construct(&$db){
		$this->db = $db;
	}
	public function syllable_count($word){
		//1. Count the vowels in the word.
		//2. Subtract any silent vowels, (like the silent e at the end of a word, or the second vowel when two vowels are together in a syllabl.e)
		//3. Subtract one vowel from every diphthong (diphthongs only count as one vowel sound.)
		//4. The number of vowels sounds left is the same as the number of syllables.
	//	echo $word;
		//$pattern= "/([aeiou].{1,3}e)$/";
		$pattern="/(aa|ai|ay|ee|(e((at|atu)[^(ato)]){1,3}|ea.$)|ie|oo|oa|oe|oi|oy|ou|ua|ue|ui|yo|tion$|tian$|ine$|pe$|phe$|le$|[aeiou]([\w][^(p|ph|l|a|e|i|o|u)]){1,2}e$|[aeiou].es$|you|([aeiouy]{1}))/U";
		preg_match_all($pattern, $word, $out,PREG_PATTERN_ORDER);
		print_r($out);
		return count($out[1]);
	}

	public function word_in_db($word,$subject,$part){
		return $this->db->get_value("select 1 from words where word = '$word' and subject_id = $subject and word_part_id = $part");
	}

	public function get_dictionary_request($word, $type, $site="thesaurus"){
		$uri =	"http://api-pub.dictionary.com/";
		$call = $uri . "v001?";
		$QueryData = array( "vid" => 's8qsk1x4wi2v6e8olr4xnc3l5afrk0dd935t53x2l0',
                               "q" => $word,
                               "type" => $type,
                               "site" => $site);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30); // 30 second timeout
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	//	echo $call . http_build_query($QueryData); //if you want to see the output query string
		curl_setopt($ch, CURLOPT_URL, $call . http_build_query($QueryData));

		$response = curl_exec($ch);

		curl_close($ch);
		return $response;
	}

	public function get_synonyms($word, &$results, &$result_count){
		$type = 'synonyms'; // need antonyms
		$word_xml = simplexml_load_string($this->get_dictionary_request($word, $type));
		foreach ($word_xml->headword as $result) {
    			$results[] = (string)$result;
		}
		$result_count = $word_xml['totalresults']; // access the 'totalresults' attribute
	}
	public function get_thesaurus($word, &$results, &$result_count){
		$type = 'antonyms'; // need antonyms
		$word_xml = simplexml_load_string($this->get_dictionary_request($word, $type));
		var_dump($word_xml);
		foreach ($word_xml->headword as $result) {
			$results[] = (string)$result;
		}
		$result_count = $word_xml['totalresults']; // access the 'totalresults' attribute
	}
}

?>
