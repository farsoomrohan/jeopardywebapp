<?php
	require("functions.php");
	session_start();
		
	if(!isset($_SESSION["questions"])){
		$points = 0;
		$finished = 0;
		$cat1 = $cat2 = $cat3 = $cat4 = $cat5 = array();
		
		$cat1 = fillCat($cat1, "csquestions.txt");
		$cat2 = fillCat($cat2, "sciencequestions.txt");
		$cat3 = fillCat($cat3, "geoquestions.txt");
		$cat4 = fillCat($cat4, "authorquestions.txt");
		$cat5 = fillCat($cat5, "popquestions.txt");
	
		$_SESSION["questions"] = array($cat1, $cat2, $cat3, $cat4, $cat5);
		$_SESSION["player1points"] = 0;
		$_SESSION["player2points"] = 0;
		$_SESSION["currentPlayer"] = 1;
	}else{
		$temp = 1;
		
		foreach($_SESSION["questions"] as $cat){
			foreach($cat as $q){
				if($q->get_answered() == 0)
					$temp = 0;
			}
		}
		
		$finished = $temp;
	}
?>

<!doctype html>
<html lang="en">

    <head>
        <title> Homepage </title>
        <link href="styles.css" rel="stylesheet">
        <meta charset="UTF-8">
    </head>
    <body>
        <h1 id="title"> JEOPARDY </h1>
		<h2>
    		<?php 
        		if ($finished == 1) {
         		   echo "Game Finished!";
       			} else {
            		echo "Choose a Question, User " . $_SESSION["currentPlayer"];
        		} 
    		?>
		</h2>

        <div class="categories">
        <table>
            <tr>
				<th> Computer Science </th>
				<th> Science </th>
				<th> Geography </th>
				<th> Authors </th>
				<th> Pop Culture </th>
            </tr>
            <form action="question.php" method="post">

            <!-- Row 1 -->
			<tr>
                <td>
					<?php printQuestion("0,0", 100); ?>
				</td>
                <td>
					<?php printQuestion("1,0", 100); ?>
				</td>
                <td>
					<?php printQuestion("2,0", 100); ?>
				</td>
                <td>
					<?php printQuestion("3,0", 100); ?>
				</td>
                <td>
					<?php printQuestion("4,0", 100); ?>
				</td>
            </tr>

            <!-- Row 2 -->
            <tr>
				<td>
					<?php printQuestion("0,1", 200); ?>
				</td>
                <td>
					<?php printQuestion("1,1", 200); ?>
				</td>
                <td>
					<?php printQuestion("2,1", 200); ?>
				</td>
                <td>
					<?php printQuestion("3,1", 200); ?>
				</td>
                <td>
					<?php printQuestion("4,1", 200); ?>
				</td>
            </tr>

            <!-- Row 3 -->
            <tr>
				<td>
					<?php printQuestion("0,2", 300); ?>
				</td>
                <td>
					<?php printQuestion("1,2", 300); ?>
				</td>
                <td>
					<?php printQuestion("2,2", 300); ?>
				</td>
                <td>
					<?php printQuestion("3,2", 300); ?>
				</td>
                <td>
					<?php printQuestion("4,2", 300); ?>
				</td>
            </tr>

            <!-- Row 4 -->
            <tr>
				<td>
					<?php printQuestion("0,3", 400); ?>
				</td>
                <td>
					<?php printQuestion("1,3", 400); ?>
				</td>
                <td>
					<?php printQuestion("2,3", 400); ?>
				</td>
                <td>
					<?php printQuestion("3,3", 400); ?>
				</td>
                <td>
					<?php printQuestion("4,3", 400); ?>
				</td>
            </tr>

            <!-- Row 5 -->
            <tr>
				<td>
					<?php printQuestion("0,4", 500); ?>
				</td>
                <td>
					<?php printQuestion("1,4", 500); ?>
				</td>
                <td>
					<?php printQuestion("2,4", 500); ?>
				</td>
                <td>
					<?php printQuestion("3,4", 500); ?>
				</td>
                <td>
					<?php printQuestion("4,4", 500); ?>
				</td>
            </tr>

            <!-- Row 6 -->
            <tr>
				<td>
					<?php printQuestion("0,5", 600); ?>
				</td>
                <td>
					<?php printQuestion("1,5", 600); ?>
				</td>
                <td>
					<?php printQuestion("2,5", 600); ?>
				</td>
                <td>
					<?php printQuestion("3,5", 600); ?>
				</td>
                <td>
					<?php printQuestion("4,5", 600); ?>
				</td>
            </tr>

            <!-- Row 7 -->
            <tr>
				<td>
					<?php printQuestion("0,6", 700); ?>
				</td>
                <td>
					<?php printQuestion("1,6", 700); ?>
				</td>
                <td>
					<?php printQuestion("2,6", 700); ?>
				</td>
                <td>
					<?php printQuestion("3,6", 700); ?>
				</td>
                <td>
					<?php printQuestion("4,6", 700); ?>
				</td>
            </tr>

            <!-- Row 8 -->
            <tr>
				<td>
					<?php printQuestion("0,7", 800); ?>
				</td>
                <td>
					<?php printQuestion("1,7", 800); ?>
				</td>
                <td>
					<?php printQuestion("2,7", 800); ?>
				</td>
                <td>
					<?php printQuestion("3,7", 800); ?>
				</td>
                <td>
					<?php printQuestion("4,7", 800); ?>
				</td>
            </tr>

			</form>
        </table>
        </div>
		
		<?php
			if($finished == 1){
				echo '<h2>User 1 finished the game with $' . $_SESSION["player1points"] . '</h2>';
				echo '<h2>User 2 finished the game with $' . $_SESSION["player2points"] . '</h2>';
				echo '<a href="login.php">Return to the Leaderboard</a>';
				
				$newfile = array();
				
				if ($file = fopen("users.txt", "r")) {
					while(!feof($file)) {
						$line = fgets($file);
						$line = explode(",", $line);
						
						if($line[0] == $_COOKIE['user']){
							$old = implode(",", $line);
							$line[1] = intval($line[1]) + intval($_SESSION["player1points"]);
							$new = implode(",", $line);
						}
					}
					fclose($file);
				}
				
				$contents = file_get_contents("users.txt");
				$contents = str_replace($old, $new . PHP_EOL, $contents);
				file_put_contents("users.txt", $contents);
				
				session_unset();
				session_destroy();
			}else {
				echo "<h3>";
				echo "User 1's Score: $" . $_SESSION["player1points"];
				echo"<br>";
				echo "User 2's Score: $" . $_SESSION["player2points"];
				echo "</h3>";
			}
		?>
    </body>

</html>