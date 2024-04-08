<?php 
	require("functions.php");
	session_start();
?>

<!DOCTYPE HTML>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Question</title>
  <link href="styles.css" rel="stylesheet">
</head>
<?php
	$questionid = explode(",", array_keys($_POST)[0]);
	$col = $questionid[0];
	$row = $questionid[1];
?>
	<body>
		<h1 id="title">JEOPARDY</h1>
		<h1 id="question"><?php echo $_SESSION["questions"][$col][$row]->get_question(); ?></h1>
		
		<br>
		<div class="qbox">
		<form action="question-submit.php" method="post">
		<p>
			What is 
			<input name="answer" type="text" class="Input">
			<?php echo '<input type="submit" name="' . $col . "," . $row . '" value="Submit" class="Question">'; ?>
		</p>
		</form>
	</div>

	</body>
</html>