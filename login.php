<!DOCTYPE HTML>

<?php 
	session_start();
	session_destroy();
	
	if(isset($_POST["name"])){
		setcookie("user", "", time() - 3600);
		setcookie("user", $_POST["name"], time() + (86400 * 30), "/");
		$name = $_POST["name"];
	
	$login = 0;
	
	if ($file = fopen("users.txt", "r")) {
		while(!feof($file)) {
			$line = fgets($file);
			if($line != ""){
				$line = explode(",", $line);
						
				if($name == $line[0]){
					$login = 1;
				}
			}
		}
		fclose($file);
	}
		if($login == 0){
			header("Location: login-error.php");
		}
	}else
		$name = $_COOKIE['user'];
	
	
?>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Jeopardy GSU</title>
  <link href="styles.css" rel="stylesheet">
</head>

<h1 id="title">JEOPARDY</h1>
<body>
	<?php
		$lboard = array("Name" => "Points" . PHP_EOL);
		if ($file = fopen("users.txt", "r")) {
				while(!feof($file)) {
					$line = fgets($file);
					if($line != ""){
						$line = explode(",", $line);
						
						if($name == $line[0]){
							$points = $line[1];
							$login = 1;
						}

						$lboard += array($line[0] => $line[1]);
					}
				}
				fclose($file);
		}
	?>
	
	<h1> Welcome, <?php echo $name;?>, to Jeopardy! </h1>
	
	<br>
	
	<form action="game.php" method="post">
	<fieldset>
		<legend>Play:</legend>
		<h3> Current points: <?php echo $points;?></h3>
		<br>
		<input name="reset" type="submit" value="Play Now">
	</fieldset>
	</form>
	
	<div>
		<fieldset>
			<legend>Leaderboard:</legend>
			<?php
				$count = 1;
				arsort($lboard);
				echo '<pre>';
				array_shift($lboard);
				foreach($lboard as $user => $points){
					echo $count . '. ' . $user . ': ' . $points;
					$count ++;
				}
				echo '</pre>';
			?>
		</fieldset>
	</div>
</body>
</body>
</html>