<?php
	class qObject{
		public $question;
		public $answer;
		public $pointVal;
		public $answered = 0;
		
		function __construct($question, $answer, $pointVal){
			$this->question = $question;
			$this->answer = $answer;
			$this->pointVal = $pointVal;
		}
		
		function get_question(){
			return $this->question;
		}
		
		function get_answer(){
			return $this->answer;
		}
		
		function get_pointVal(){
			return $this->pointVal;
		}
		
		function get_answered(){
			return $this->answered;
		}
	}
	
	function fillCat($cat, $filename){
		if ($file = fopen($filename, "r")) {
			while(!feof($file)) {
				$line = fgets($file);
				$line = explode(",", $line);
			    $question = new qObject($line[0], $line[1], $line[2]);
				array_push($cat, $question);
			}
			fclose($file);
		}
		
		return $cat;
	}
	
	function printQuestion($questionid, $questionpoints){
   		$questionid = explode(",", $questionid);

    	$col = $questionid[0];
    	$row = $questionid[1];
    
    	if(isset($_SESSION["questions"][$col][$row]) && $_SESSION["questions"][$col][$row]->get_answered() == 0)
        echo '<input type="submit" name="' . $col . "," . $row . '" value="$' . $questionpoints . '" class="Question">';
    	else
        	echo "‎";
	}
?>