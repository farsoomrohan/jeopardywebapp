<!DOCTYPE HTML>

<?php setcookie("user", $_POST["name"], time() + (86400 * 30), "/");?>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Welcome!</title>
  <link href="styles.css" rel="stylesheet">
</head>

<body>
	<h1 id="title">JEOPARDY</h1>
	<?php 
		$continue = true;
		
		if ($file = fopen("users.txt", "r")) {
			while(!feof($file)) {
				$line = fgets($file);
			    if (explode(",", $line)[0] == $_POST["name"])
					$continue = false;
			}
			fclose($file);
		}

		if ($continue){
			print '<h1>Thank you for joining, ' . $_POST["name"] . '!</h1>';
			file_put_contents("users.txt",$_POST["name"] . ",0" . PHP_EOL, FILE_APPEND);
		}else
			print '<h1>You are already signed up, ' . $_POST["name"] . '!</h1>';

	?>
	
	<p id="return"><img id= "main_icon" src="main-icon.png" style="height: 30px; width: 30px;"> <a href="mainpage.php">Main Page</a></p>
</body>
</html>